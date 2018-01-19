<?php

namespace App\Models;

use App\Traits\Boot;
use App\Traits\Selectable;
use App\Traits\Owned;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bunch extends Model
{
    use Boot;
    use Owned;
    use Selectable;
    use SoftDeletes;

    protected $fillable = ['name', 'description'];

    public static function boot()
    {
        parent::boot();

        self::booting();
    }

    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }

    public function subscribers()
    {
        return $this->hasMany(Subscriber::class);
    }
}
