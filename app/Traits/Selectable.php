<?php
/**
 * Created by PhpStorm.
 * User: MaximuS
 * Date: 04.01.2018
 * Time: 21:32
 */

namespace App\Traits;

trait Selectable
{
    public static function getSelectList($value = 'name', $key = 'id'){
        return static::latest()->owned()->pluck($value, $key);
    }
}