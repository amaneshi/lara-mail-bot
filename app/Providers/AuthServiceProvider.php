<?php

namespace App\Providers;

use App\Models\Bunch;
use App\Models\Campaign;
use App\Models\Report;
use App\Models\SentMail;
use App\Models\Subscriber;
use App\Models\Template;
use App\Policies\GeneralPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        Bunch::class => GeneralPolicy::class,
        Campaign::class => GeneralPolicy::class,
        Subscriber::class => GeneralPolicy::class,
        Template::class => GeneralPolicy::class,
        Report::class => GeneralPolicy::class,
        SentMail::class => GeneralPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
