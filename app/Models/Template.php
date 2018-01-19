<?php

namespace App\Models;

use App\Traits\Boot;
use App\Traits\Selectable;
use App\Traits\Owned;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Template extends Model
{
    use Boot;
    use Owned;
    use Selectable;
    use SoftDeletes;

    protected $fillable = ['name', 'content'];


    public static function boot()
    {
        parent::boot();

        self::booting();
    }

    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }
}
