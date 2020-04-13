<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Events\DiseaseWasCreatedEvent;
use Mail;

use App\Models\HealthInstitution;

class SendDiseaseCreatedNotification
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
     * @param  DiseaseWasCreatedEvent  $event
     * @return void
     */
    public function handle(DiseaseWasCreatedEvent $event)
    {
        $disease = $event->disease;
        $health_institution_id = $disease->health_institution_id;

        $institution_emailArr = HealthInstitution::IsHead(0)->whereHas('health_institution_profile', function($query) use ($health_institution_id) {
            $query->where('head_health_institution_id', $health_institution_id);
        })->pluck('email')->toArray();

        if(count($institution_emailArr) > 0){
            $info = array(
                'to' => $institution_emailArr,
                'from' => env('MAIL_FROM_ADDRESS', 'no-reply@edemic.com'),
                'subject' => 'New Disease Added | e-Demic',
                'template' => 'emails.disease_create',
                'data' => [
                    'disease_name' =>  $disease->name,
                    'disease_code' =>  $disease->diseaseCode,
                    'risk_level' => $disease->riskLevel,
                ]
            );

            Mail::send($info['template'], ["data"=> $info['data']], function ($message) use ($info) {
                $message->bcc($info['to']);
                $message->from($info['from']);
                $message->subject($info['subject']);
            });
        }
    }
}
