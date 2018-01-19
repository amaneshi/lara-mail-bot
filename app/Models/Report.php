<?php

namespace App\Models;

use App\Traits\Boot;
use App\Traits\Owned;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Report extends Model
{
    use Boot;
    use Owned;
    use SoftDeletes;

    protected $fillable = [
        'send_campaign_id',
        'campaign_id',
        'bunch_id',
        'template_id',
        'mail_all',
        'mail_sent',
        'mail_queued',
        'mail_accepted',
        'mail_rejected',
        'mail_delivered',
        'mail_failed',
        'mail_opened',
        'mail_unsubscribed'
    ];

    public $report_id;

    public $sentMail_id;

    public static function boot()
    {
        parent::boot();

        self::booting();
    }

    public static function init(Campaign $campaign)
    {
        $report = new Report;
        $report->report_id = Report::latest()->first()->id + 1;
        $report->campaign()->associate($campaign);
        $report->template()->associate($campaign->template);
        $report->bunch()->associate($campaign->bunch);
        $report->mail_all = $campaign->bunch->subscribers->count();
        $report->send_campaign_id = self::generateReportId($report);
        $report->save();

        return $report;
    }

    public function sentMails()
    {
        return $this->hasMany(SentMail::class);
    }

    public function bunch()
    {
        return $this->belongsTo(Bunch::class);
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    public static function remainingDailyLimit()
    {
        return 300 - intval(DB::table('reports')->whereDate('created_at', now()->toDateString())->sum('mail_all'));
    }

    protected static function generateReportId(Report $report)
    {
        return 'Camp-' . $report->campaign->id . '-Temp-' . $report->template->id .
            '-Bunch-' . $report->bunch->id . '-User-' . Auth::id() .
            '-RepID-' . $report->report_id;
    }

    public function asPercent($value)
    {
        return is_int($value) ? '<strong>'.($value / $this->mail_all * 100) . '% <br>(' . $value . ')</strong>' : null;
    }
}
