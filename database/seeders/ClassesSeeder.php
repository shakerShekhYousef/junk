<?php

namespace Database\Seeders;

use App\Models\ClassM;
use Illuminate\Database\Seeder;

class ClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1
        ClassM::updateOrCreate([
            'name' => 'reCycle',
            'type' => 'Rave'
        ], [
            'name' => 'reCycle',
            'description' => 'Our JUNK version of cycling is the only rave without a comedown. Our instructors will take you through a energetic, sensory journey giving you full-body workout as you tackle a series of powerful sprints and quad burning climbs.',
            'type' => 'Rave',
            'image'=> 'classes/re-cycle.jpg',
            'class_icon'=> 'icons/bike-recycle.png'
        ]);

        // 2
        ClassM::updateOrCreate([
            'name' => 'Dance',
            'type' => 'House'
        ], [
            'name' => 'Dance',
            'description' => 'We WANT you on our “dance” floor. This addictive fitness class is designed with FUN in mind. Our Dance MC will lead you through this FUN, calorie-burning, mood enhancing, electrifying workout.',
            'type' => 'House',
            'image'=> 'classes/dance.jpg',
            'image'=> 'classes/dance.jpg',
            'class_icon'=> 'icons/dancer.png'
        ]);

        // 3
        ClassM::updateOrCreate([
            'name' => 'reBoot',
            'type' => '90sClassics'
        ], [
            'name' => 'reBoot',
            'description' => 'JUNK bootcamp provides you with high-intensity, total body conditioning exercises, using both bodyweight and equipment, designed to strengthen and leave you with a lasting burn. Tighten those abs, burn fat and get rid of the junk in your trunk.',
            'type' => '90sClassics',
            'image'=> 'classes/re-boot.jpg',
            'class_icon'=> 'icons/truck-wheel.png'
        ]);

        // 4
        ClassM::updateOrCreate([
            'name' => 'Yoga',
            'type' => 'Cheesy pop'
        ], [
            'name' => 'Yoga',
            'description' => 'JUNK Yoga will take you through a series of poses and salutations designed to relieve stress, improve posture, increase flexibility and to strengthen and tone the body. Channel the zen from within with our hypnotic- meditative yoga or join us for a blood pumping, body sculpting- high intensity power yoga.',
            'type' => 'Cheesy pop',
            'image'=> 'classes/yoga.jpg',
            'class_icon'=> 'icons/yoga.png'
        ]);

        // 5
        ClassM::updateOrCreate([
            'name' => 'BeatBox',
            'type' => 'r&Beat'
        ], [
            'name' => 'BeatBox',
            'description' => 'The JUNK fitness class that packs a punch! Let your body mimic the beat as you take on this high energy box fit class – high knees, powerful jabs and stealthy movements come together to create a full body workout, improving both stamina and coordination.',
            'type' => 'r&Beat',
            'image'=> 'classes/beatbox.jpg',
            'class_icon'=> 'icons/boxing-glove.png'
        ]);
    }
}
