<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Events\HealthInstitutionWasCreatedEvent;
use Mail;

use App\Models\HealthInstitution;

class SendHealthInstitutionCreatedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  HealthInstitutionWasCreatedEvent  $event
     * @return void
     */
    public function handle(HealthInstitutionWasCreatedEvent $event)
    {
        $institution = $event->institution;

        $info = array(
            'to' => $institution->email,
            'from' => env('MAIL_FROM_ADDRESS', 'no-reply@edemic.com'),
            'data' => [
                'institution_name' =>  $institution->name,
                'institution_code' =>  $institution->institutionCode,
                'email' => $institution->email,
                'password' => $event->password,
                'login_url' => url('/')
            ]
        );

        if($institution->isHead == 0){
            $info['subject'] = 'Health Institution Registration Successful | e-Demic';
            $info['template'] = 'emails.institution_create';
            $info['data']['parent_institution'] = HealthInstitution::find($institution->health_institution_profile->head_health_institution_id)->name;
        } else{
            $info['subject'] = 'Health Head Registration Successful | e-Demic';
            $info['template'] = 'emails.health_head_create';
        }

        Mail::send($info['template'], ["data"=> $info['data']], function ($message) use ($info) {
            $message->to($info['to']);
            $message->from($info['from']);
            $message->subject($info['subject']);
        });
    }
}
