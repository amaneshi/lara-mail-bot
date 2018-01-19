<?php

namespace App\Models;

use App\Traits\Owned;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SentMail extends Model
{
    use Owned;
    use SoftDeletes;

    protected $fillable =
        [
            'first_name',
            'last_name',
            'email',
            'report_id',
            'mail_opened',
            'mail_unsubscribed',
            'mail_unsubscribe_reason'
            ];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public function subscriber()
    {
        return $this->belongsTo(Subscriber::class);
    }

}
