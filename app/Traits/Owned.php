<?php
/**
 * Created by PhpStorm.
 * User: MaximuS
 * Date: 04.01.2018
 * Time: 21:32
 */

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait Owned
{
    public function scopeOwned($query)
    {
        return $query->where('created_by', Auth::id());
    }
}