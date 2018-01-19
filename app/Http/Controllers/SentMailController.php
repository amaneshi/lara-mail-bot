<?php

namespace App\Http\Controllers;

use App\Models\SentMail;
use App\Models\Report;
use App\Http\Requests\SentMailRequest;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class SentMailController extends Controller
{
    /**
     * SubscriberController constructor.
     */
    public function __construct()
    {
        $this->authorizeResource(SentMail::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Report $report
     * @return \Illuminate\Http\Response
     */
    public function index(Report $report)
    {

        $sentMails = $report->sentMails()->orderBy('id', 'asc')->get();
        return view('sentMail.index', compact(['sentMails', 'report']));
    }


//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param  \App\Models\Report $report
//     * @param  \App\Models\SentMail $sentMail
//     * @return \Illuminate\Http\Response
//     */
//    public function store(Report $report, SentMail $sentMail)
//    {
//        //$sentMail->create(array_add($request->all(), 'bunch_id', $bunch->id));;
//        return redirect()->route('sentMail.index', compact('report'))->with('message', 'Sent Mail has been added');
//    }
//
//    /**
//     * Display the specified resource.
//     *
//     * @param  \App\Models\Report $report
//     * @param  \App\Models\SentMail $sentMail
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function show(Report $report, SentMail $sentMail)
//    {
//        return redirect()->route('sentMail.index', compact('report'))->with('message', 'Sent Mail has been updated');
//    }
//
//
//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \App\Models\Report $report
//     * @param  \App\Models\SentMail $sentMail
//     * @return \Illuminate\Http\Response
//     */
//    public function update(Report $report, SentMail $sentMail)
//    {
//        //$subscriber->update(array_add($request->all(), 'bunch_id', $bunch->id));;
//        return redirect()->route('sentMail.index', compact('report'));
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  \App\Models\SentMail $sentMail
//     * @return \Illuminate\Http\Response
//     */
//    public function destroy(Report $report, SentMail $sentMail)
//    {
//        $sentMail->delete();
//
//        return redirect()->route('sentMail.index', compact('report'));
//    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function unsubscribeBefore(Request $request)
    {
        $sentMail = SentMail::find($request->query('mailId'));
        if ($sentMail != null && !$sentMail->mail_unsubscribed)
            return view('sentMail.unsubscribe', compact('sentMail'));
        else
            return redirect()->route('profile');
    }

    /**
     * @param   \App\Http\Requests\SentMailRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function unsubscribeAfter(SentMailRequest $request)
    {
        $sentMail = SentMail::find($request->query('mailId'));
        $sentMail->mail_unsubscribe_reason = $request->reason;
        $sentMail->mail_unsubscribed = true;
        $sentMail->report->mail_unsubscribed += 1;
        $sentMail->subscriber->delete();
        $sentMail->push();
        return redirect()->route('profile');
    }

}
