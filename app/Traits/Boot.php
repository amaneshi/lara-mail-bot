<?php
/**
 * Created by PhpStorm.
 * User: MaximuS
 * Date: 05.01.2018
 * Time: 0:04
 */

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait Boot
{
    public static function  booting()
    {
        static::updating(function ($table) {
            $table->updated_by = Auth::id();
        });

        static::creating(function ($table) {
            $table->created_by = Auth::id();
            $table->updated_by = Auth::id();
        });
    }
}