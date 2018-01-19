<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Bogardo\Mailgun\Facades\Mailgun;

class ReportController extends Controller
{
    /**
     * BunchController constructor.
     */
    public function __construct()
    {
        $this->authorizeResource(Report::class);
    }


    /**
     * Display a listing of the resource.
     *
     * @param \App\Models\Report $report
     * @return \Illuminate\Http\Response
     */
    public function index(Report $report)
    {
        $reports = $report->owned()->orderBy('id', 'desc')->get();
        return view('report.index', compact('reports'));
    }


//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param \App\Models\Report $report
//     * @return \Illuminate\Http\Response
//     */
//    public function store(Report $report)
//    {
//        //$report->create($request->all());
//        return redirect()->route('report.index')->with('message', 'Report has been added');
//    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Report $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        $sent_mails = $report->sentMails()->where('message_id', '<>', null)->get();
        $report->mail_sent = $sent_mails->count();
        $report->mail_queued = $report->mail_all - $report->mail_sent;
        $report->mail_accepted = 0;
        $report->mail_rejected = 0;
        $report->mail_delivered = 0;
        $report->mail_failed = 0;

        foreach ($sent_mails as $sent_mail) {
            $result = Mailgun::api()->get("events", ['tags' => $report->send_campaign_id, 'recipient' => $sent_mail->subscriber()->withTrashed()->first()->email]);
            if ($result->http_response_code == 200) {
                $collection = collect($result->http_response_body->items);
//                dd($collection);
                if ($collection->contains('event','accepted'))
                    $report->mail_accepted++;
                if ($collection->contains('event','rejected'))
                    $report->mail_rejected++;
                if ($collection->contains('event','delivered'))
                    $report->mail_delivered++;
                if ($collection->contains('event','failed'))
                    $report->mail_failed++;

                if ($collection->contains('event','opened')){
                    $sent_mail->mail_opened = 1;
                    $sent_mail->save();
                }
            }
        }
        $report->mail_opened = $report->sentMails()->where('mail_opened', 1)->count();
        $report->mail_unsubscribed = $report->sentMails()->where('mail_unsubscribed', 1)->count();

        $report->save();
        return redirect()->route('report.index')->with('message', 'Report has been updated');
    }


//    /**
//     * Update the specified resource in storage.
//     *
//     * @param \App\Models\Report $report
//     * @return \Illuminate\Http\Response
//     */
//    public function update(Report $report)
//    {
////        $report->update($request->all());
//        return redirect()->route('report.index');
//    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Report $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        $report->delete();

        return redirect()->route('report.index');
    }
}
