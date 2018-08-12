<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';
    protected $fillable = ['zip', 'name'];

    public static function findByZip($zip)
    {
        return self::where('zip', $zip)->first();
    }
}
