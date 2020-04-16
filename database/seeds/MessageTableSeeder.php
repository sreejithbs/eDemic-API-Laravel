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
        $messages = array(
            array('title' => 'India To Deploy Rapid Test Kits To Speed Up Covid-19 Screening', 'content' => 'Central Govt to begin Rapid Test against Covid-19. The serological antibody blood test, which deliver results in 15 minutes, work on blood samples instead of nasal swabs'),
            array('title' => 'Protecting the Future of Medicine During the COVID-19 Pandemic', 'content' => 'The American Heart Association believes that prematurely allowing medical trainees to provide patient care during the COVID-19 pandemic could put the next generation of medical professionals at serious risk'),
            array('title' => 'How to Prevent Domestic Violence During COVID-19', 'content' => 'During COVID-19, access to trusted and security internet-based domestic violence services is even more important for survivors and concerned friends and family members who are trying to find ways to keep themselves safe while many states are on "stay-at-home" orders'),
            array('title' => 'Blue-light Technology Improves Identification of Bladder Cancer', 'content' => 'Blue-light cystoscopy has previously been available at some institutions, including UT Southwestern, for use in the operating room, but it wasn’t available in a flexible scope until now'),
            array('title' => 'Spanish flu: The deadliest pandemic in history', 'content' => 'In 1918, a strain of influenza known as Spanish flu caused a global pandemic, spreading rapidly and killing indiscriminately. Young, old, sick and otherwise-healthy people all became infected, and at least 10% of patients died'),
            array('title' => 'Urgent studies needed into mental health impact of coronavirus', 'content' => 'Rapid and rigorous research into the impact of Covid-19 on mental health is needed to limit the impact of the pandemic, researchers have said'),
            array('title' => 'Can Clothes and Shoes Track COVID-19 into Your House?', 'content' => 'Transfer of the coronavirus via clothing is unlikely, but experts agree there are a few scenarios in which immediate laundering is a good idea'),
            array('title' => 'Why a Virtual Visit to the Doctor May Be the Safest, Most Affordable Option', 'content' => 'Telehealth options are making a big difference for people seeking medical help during the COVID-19 pandemic — especially older adults'),
            array('title' => 'Why COVID-19 is Hitting Men Harder Than Women', 'content' => 'Experts say biology and behavior are among the reasons more men than women are dying from COVID-19'),
            array('title' => 'The Best Materials to Make a Homemade Face Mask', 'content' => 'Health officials have reversed course and now recommend that people use face masks to prevent transmission of the new coronavirus'),
            array('title' => 'It’s Too Early to Know If Hydroxychloroquine Will Help Treat People with COVID-19', 'content' => 'Until we have results from larger, well-designed trials — which are currently underway — hydroxychloroquine and chloroquine should only be used rarely'),
            array('title' => 'Are Ventilators Helping or Harming COVID-19 Patients?', 'content' => 'Mechanical ventilators have become a symbol of the COVID-19 pandemic, representing the last best hope to survive for people who can no longer draw a life-sustaining breath'),
            array('title' => 'Don’t Rely on Supplements to Treat or Prevent COVID-19', 'content' => 'Doctors warn that relying on supplements — and taking too much of them — may do more harm than good when trying to combat the COVID-19 outbreak'),
        );

        foreach ($messages as $msg) {
            $message = new Message();
            $message->title = $msg['title'];
            $message->content = $msg['content'];
            $message->health_institution_id = 2;
            $message->isPosted = 1;
            $message->save();
        }
    }
}