<?php

use Illuminate\Database\Seeder;

use App\Models\Message;

class MessageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $message = new Message();
        $message->title = 'India To Deploy Rapid Test Kits To Speed Up Covid-19 Screening';
        $message->content = 'Central Govt to begin Rapid Test against Covid-19. The serological antibody blood test, which deliver results in 15 minutes, work on blood samples instead of nasal swabs';
        $message->health_institution_id = 2;
        $message->isPosted = 1;
        $message->save();

        $message = new Message();
        $message->title = 'Protecting the Future of Medicine During the COVID-19 Pandemic';
        $message->content = 'The American Heart Association believes that prematurely allowing medical trainees to provide patient care during the COVID-19 pandemic could put the next generation of medical professionals at serious risk.';
        $message->health_institution_id = 2;
        $message->isPosted = 1;
        $message->save();

        $message = new Message();
        $message->title = 'How to Prevent Domestic Violence During COVID-19';
        $message->content = 'During COVID-19, access to trusted and security internet-based domestic violence services is even more important for survivors and concerned friends and family members who are trying to find ways to keep themselves safe while many states are on "stay-at-home" orders.';
        $message->health_institution_id = 2;
        $message->isPosted = 1;
        $message->save();

        $message = new Message();
        $message->title = 'Blue-light Technology Improves Identification of Bladder Cancer';
        $message->content = 'Blue-light cystoscopy has previously been available at some institutions, including UT Southwestern, for use in the operating room, but it wasn’t available in a flexible scope until now.';
        $message->health_institution_id = 2;
        $message->isPosted = 1;
        $message->save();

        $message = new Message();
        $message->title = 'Spanish flu: The deadliest pandemic in history';
        $message->content = 'In 1918, a strain of influenza known as Spanish flu caused a global pandemic, spreading rapidly and killing indiscriminately. Young, old, sick and otherwise-healthy people all became infected, and at least 10% of patients died.';
        $message->health_institution_id = 2;
        $message->isPosted = 1;
        $message->save();
    }
}