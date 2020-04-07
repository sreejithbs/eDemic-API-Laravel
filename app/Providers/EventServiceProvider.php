<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use App\Events\HealthInstitutionWasCreatedEvent;
use App\Listeners\SendHealthInstitutionCreatedNotification;
use App\Events\DoctorProfileWasCreatedEvent;
use App\Listeners\SendDoctorProfileCreatedNotification;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        HealthInstitutionWasCreatedEvent::class => [
            SendHealthInstitutionCreatedNotification::class,
        ],
        DoctorProfileWasCreatedEvent::class => [
            SendDoctorProfileCreatedNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
