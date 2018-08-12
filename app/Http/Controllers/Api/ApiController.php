<?php

namespace App\Http\Controllers\Api;

use App\ApiResponse;
use App\Helpers\ValidationHelper;
use App\Models\Category;
use App\Models\City;
use App\Models\ExecutionDate;
use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function executionDates(Request $request)
    {
        $executionDates = ExecutionDate::all();

        return ApiResponse::success('execution_dates', $executionDates);
    }

    public function categories(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'parent_id' => 'nullable|exists:categories,id',
        ], ValidationHelper::messages());

        if ($validator->fails()) {
            return ApiResponse::errors($validator->messages());
        }

        $categories = Category::all();
        if ($parent_id = $request->parent_id) {
            $categories = Category::find($parent_id)->children;
        }

        return ApiResponse::success('categories', $categories);
    }

    public function city(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'zip' => 'required|exists:cities,zip',
        ], ValidationHelper::messages());

        if ($validator->fails()) {
            return ApiResponse::errors($validator->messages());
        }

        $city = City::findByZip($request->zip);

        return ApiResponse::success('city', $city);
    }

    public function storeJob(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'city_id' => 'required|exists:cities,id',
            'title' => 'required|min:5|max:50',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|max:255',
            'execution_date_id' => 'required|exists:execution_dates,id',
        ], ValidationHelper::messages());

        if ($validator->fails()) {
            return ApiResponse::errors($validator->messages());
        }

        Job::create($request->all());

        return ApiResponse::successful();
    }
}
