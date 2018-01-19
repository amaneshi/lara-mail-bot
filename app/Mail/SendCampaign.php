<?php

namespace App\Mail;

use App\Models\Campaign;
use App\Models\Report;
use App\Models\SentMail;
use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SendCampaign extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The campaign instance.
     *
     * @var Campaign
     */
    public $campaign;

    public $report;

    public $subscriber;

    public $recipient_data;

    public $sentMail;

    /**
     * Create a new message instance.
     *
     * @param \App\Models\Report $report
     * @param Subscriber $subscriber
     * @return void
     */
    public function __construct(Report $report, Subscriber $subscriber)
    {
        $this->report = $report;
        $this->campaign = $report->campaign;
        $this->subscriber = $subscriber;
        $this->subject($this->campaign->name);
        $this->from(Auth::user()->email, Auth::user()->name);
        $this->replyTo(Auth::user()->email, Auth::user()->name);
        //dd($subscriber);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $this->withSwiftMessage(function ($message) {
            $message->getHeaders()->addTextHeader('X-Mailgun-Tag', $this->report->send_campaign_id);
            $this->recipient_data[$this->subscriber->email] = [
                '{FNAME}' => $this->subscriber->first_name,
                '{LNAME}' => $this->subscriber->last_name,
                '{UNSUBSCRIBE}' => "<a href=\"" . route('sentMail.unsubscribeBefore',
                        ['mailId' => $this->createSentMail($this->report, $this->subscriber, $message->getId())]) . "\">Unsubscribe</a>"
            ];

            $decorator = new \Swift_Plugins_DecoratorPlugin($this->recipient_data);
            Mail::getSwiftMailer()->registerPlugin($decorator);
        });

        return $this->view('emails.send-campaign');
    }


    protected function createSentMail($report, $subscriber, $messageId)
    {
        $this->sentMail = new SentMail;
        $this->sentMail->report()->associate($report);
        $this->sentMail->subscriber()->associate($subscriber);
        $this->sentMail->message_id = $messageId;
        $this->sentMail->save();
        return $this->sentMail->id;
    }
}
