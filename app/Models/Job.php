<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'jobs';
    protected $fillable = ['city_id', 'title', 'category_id', 'description',
        'execution_date_id'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function executionDate()
    {
        return $this->belongsTo(ExecutionDate::class);
    }
}
