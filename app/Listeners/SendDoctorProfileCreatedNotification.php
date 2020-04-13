<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Events\DoctorProfileWasCreatedEvent;
use Mail;

use App\Models\HealthInstitution;

class SendDoctorProfileCreatedNotification
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
     * @param  DoctorProfileWasCreatedEvent  $event
     * @return void
     */
    public function handle(DoctorProfileWasCreatedEvent $event)
    {
        $doctor = $event->doctor;

        $info = array(
            'to' => $doctor->email,
            'from' => env('MAIL_FROM_ADDRESS', 'no-reply@edemic.com'),
            'subject' => 'Doctor Registration Successful | e-Demic',
            'template' => 'emails.doctor_create',
            'data' => [
                'doctor_name' => $doctor->name,
                'parent_institution' => HealthInstitution::find($doctor->health_institution_id)->name,
                'profile_qrcode' => asset($doctor->profileQrCode)
            ]
        );

        Mail::send($info['template'], ["data"=> $info['data']], function ($message) use ($info) {
            $message->to($info['to']);
            $message->from($info['from']);
            $message->subject($info['subject']);
        });
    }
}
