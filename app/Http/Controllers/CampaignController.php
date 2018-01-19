<?php

namespace App\Http\Controllers;

use App\Http\Requests\CampaignRequest;
use App\Mail\SendCampaign;
use App\Models\Campaign;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CampaignController extends Controller
{
    /**
     * CampaignController constructor.
     */
    public function __construct()
    {
        $this->authorizeResource(Campaign::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Campaign $campaign
     * @return \Illuminate\Http\Response
     */
    public function index(Campaign $campaign)
    {
        $campaigns = $campaign->owned()->orderBy('id', 'asc')->get();
        return view('campaign.index', compact('campaigns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('campaign.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Models\Campaign $campaign
     * @param  \App\Http\Requests\CampaignRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Campaign $campaign, CampaignRequest $request)
    {
        $campaign->create($request->all());
        return redirect()->route('campaign.index')->with('message', 'Campaign has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Campaign $campaign
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign $campaign)
    {
        return view('campaign.show', compact('campaign'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Campaign $campaign
     * @return \Illuminate\Http\Response
     */
    public function edit(Campaign $campaign)
    {
        return view('campaign.edit', compact('campaign'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Campaign $campaign
     * @param   \App\Http\Requests\CampaignRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(Campaign $campaign, CampaignRequest $request)
    {
        $campaign->update($request->all());
        return redirect()->route('campaign.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Campaign $campaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campaign $campaign)
    {
        $campaign->delete();

        return redirect()->route('campaign.index');
    }

    /**
     * Display the specified campaign preview.
     *
     * @param  \App\Models\Campaign $campaign
     * @return \Illuminate\Http\Response
     */
    public function preview(Campaign $campaign)
    {
        //$this->authorize('preview', $campaign);
        $message = view('emails.send-campaign', compact('campaign'));
        return view('campaign.preview', compact(['campaign', 'message']));
    }

    /**
     * Send email.
     *
     * @param  \App\Models\Campaign $campaign
     * @return \Illuminate\Http\Response
     */
    public function send(Campaign $campaign)
    {
        $remaining_daily_mail_limit = Report::remainingDailyLimit();
        if ($remaining_daily_mail_limit - $campaign->bunch->subscribers->count() >= 0) {

            $report = Report::init($campaign);

            foreach ($campaign->bunch->subscribers->chunk(25) as $index => $sublist)
                foreach ($sublist as $subscriber)
                    Mail::to($subscriber)->later(now()->addMinutes($index), (new SendCampaign($report, $subscriber))->onQueue('emails'));


            return redirect()->route('report.index')->with('message', 'Campaign has been sent');
        } else {
            return redirect()->route('campaign.index')->with('message', "Campaign not sent. Subscribers in bunch exceeds limit 300 mail per day (left {$remaining_daily_mail_limit})");
        }
    }
}
