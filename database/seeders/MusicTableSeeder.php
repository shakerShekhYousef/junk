<?php

namespace Database\Seeders;

use App\Models\Music;
use Illuminate\Database\Seeder;

class MusicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Music::updateOrCreate([
            'title' => '90’S CLASSIC',
        ], [
            'title' => '90’S CLASSIC',
            'body' => 'Reee-wind. We’re taking you right back to the old school
            with our 90’s classics classes.
            Relive the euphoric sound
            of your youth – expect a special mix of thunderous club
            classics from N-Trance to angsty Britpop.',
            'image' => 'front/img/90’S%20CLASSIC.png'
        ]);

        Music::updateOrCreate([
            'title' => 'CHEESY POP',
        ], [
            'title' => 'CHEESY POP',
            'body' => 'It’s Britney,b*tch! Get some pep in your step at a class
             where anything goes. Just like the boybands, you’ll be
             miming along to those clean cut autotuned bangers
             throughout your workout. Don’t come here to be cool,
             come here to have fun, to let it all go!',
            'image' => 'front/img/CHEESY%20POP.png'
        ]);

        // Music::updateOrCreate([
        //     'title' => 'R & BEAT',
        // ], [
        //     'title' => 'R & BEAT',
        //     'body' => 'Is it getting hot in herrrrrreee…..or is that just us?
        //     Get your grind on to our vibey mix of modern and classic
        //     R&B and hip hop and set those calories on fire as we get
        //     your body moving and grooving.',
        //     'image' => 'front/img/RandBeat.jpg'
        // ]);

        Music::updateOrCreate([
            'title' => 'RAVE',
        ], [
            'title' => 'RAVE',
            'body' => 'It’s clubland, but not as you know it. Fast paced and jam
            packed full of energy, you’ll be challenging yourself to
            keep up with the beat of this up-tempo class. Get that
            heart rate up to electro pop remixes, and hardcore trance hits – this genre is guaranteed to leave you on a
            ravers high!',
            'image' => 'front/img/rave.jpg'
        ]);

        Music::updateOrCreate([
            'title' => 'HOUSE',
        ], [
            'title' => 'HOUSE',
            'body' => 'We don’t like house music…..we LOVE it! From jungle to
            funk, dubstep to tropical house, we’re bringing you the
            hottest dance tracks from all time to take you through an
            explosive workout. When the beat drops – welcome to
            our HOUSE!',
            'image' => 'front/img/Dancelogoforclasses1.png'
        ]);

        Music::updateOrCreate([
            'title' => 'Yoga',
        ], [
            'title' => 'Yoga',
            'body' => '',
            'image' => ''
        ]);
    }
}
