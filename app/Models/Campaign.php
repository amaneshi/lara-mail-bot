<?php

namespace App\Models;

use App\Traits\Boot;
use App\Traits\Owned;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    use Boot;
    use Owned;
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'bunch_id', 'template_id'];


    public static function boot()
    {
        parent::boot();

        self::booting();
    }

    public function bunch()
    {
        return $this->belongsTo(Bunch::class);
    }

    public function template()
    {
        return $this->belongsTo(Template::class);
    }
}
