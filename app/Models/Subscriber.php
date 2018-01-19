<?php

namespace App\Models;

use App\Traits\Boot;
use App\Traits\Owned;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscriber extends Model
{
    use Boot;
    use Owned;
    use SoftDeletes;

    protected $fillable = ['first_name', 'last_name', 'email', 'bunch_id'];


    public static function boot()
    {
        parent::boot();

        self::booting();
    }

    public function bunch()
    {
        return $this->belongsTo(Bunch::class);
    }
}
