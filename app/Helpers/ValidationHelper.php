<?php
/**
 * Created by PhpStorm.
 * User: Роман
 * Date: 08.08.2018
 * Time: 21:53
 */

namespace App\Helpers;


class ValidationHelper
{
    public static function messages()
    {
        return [
            'required' => ':attribute is required',
            'zip.exists' => 'City with this zip not found',
            'category_id.exists' => 'Category not found',
        ];
    }
}