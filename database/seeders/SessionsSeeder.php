<?php

namespace Database\Seeders;

use App\Models\Session;
use Illuminate\Database\Seeder;

class SessionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // coaches
        //    3  Ellie
        //    4  Rasha
        //    5  Steve
        //    6  Anthony
        //    7  Beeman
        //    8  Lucy
        //    9  Jenny
        //    10 Sharon

        // musics
        //    1 90’S CLASSIC
        //    2 CHEESY POP
        //    3 R & BEAT
        //    4 RAVE
        //    5 HOUSE
        //    6 OWN

        // classes
        //    1 reCycle
        //    2 Dance
        //    3 reBoot
        //    4 Yoga
        //    5 BeatBox

        // 1
        $session = Session::updateOrCreate([
            'class_id' => 1,
            'start_time' => "06:30 AM",
            'end_time' => "07:15 AM",
            'coach_id' => 3
        ], [
            'class_id' => 1,
            'start_time' => "06:30 AM",
            'end_time' => "07:15 AM",
            'coach_id' => 3,
            'music_id' => 1,
            'capacity' => 20,
            'status' => 'Pending',
            'recurring_type' => 'Weekly',
            'recuring_interval' => json_encode([2, 6]),
            'session_total_count' => 1,
            'minimum_open_type' => 'Date',
            'minimum_open_value' => ''
        ]);

        // 2
        $session = Session::updateOrCreate([
            'class_id' => 4,
            'start_time' => "06:30 AM",
            'end_time' => "07:15 AM",
            'coach_id' => 3
        ], [
            'class_id' => 4,
            'start_time' => "06:30 AM",
            'end_time' => "07:15 AM",
            'coach_id' => 3,
            'music_id' => 6,
            'capacity' => 20,
            'status' => 'Pending',
            'recurring_type' => 'Weekly',
            'recuring_interval' => json_encode([3, 5]),
            'session_total_count' => 1,
            'minimum_open_type' => 'Date',
            'minimum_open_value' => ''
        ]);

        // 3
        $session = Session::updateOrCreate([
            'class_id' => 3,
            'start_time' => "06:30 AM",
            'end_time' => "07:15 AM",
            'coach_id' => 5
        ], [
            'class_id' => 3,
            'start_time' => "06:30 AM",
            'end_time' => "07:15 AM",
            'coach_id' => 5,
            'music_id' => 1,
            'capacity' => 20,
            'status' => 'Pending',
            'recurring_type' => 'Weekly',
            'recuring_interval' => json_encode([4]),
            'session_total_count' => 1,
            'minimum_open_type' => 'Date',
            'minimum_open_value' => ''
        ]);

        // 4
        $session = Session::updateOrCreate([
            'class_id' => 1,
            'start_time' => "07:45 AM",
            'end_time' => "08:30 AM",
            'coach_id' => 3
        ], [
            'class_id' => 1,
            'start_time' => "07:45 AM",
            'end_time' => "08:30 AM",
            'coach_id' => 3,
            // 'music_id' => 3,
            'capacity' => 20,
            'status' => 'Pending',
            'recurring_type' => 'Weekly',
            'recuring_interval' => json_encode([2, 6]),
            'session_total_count' => 1,
            'minimum_open_type' => 'Date',
            'minimum_open_value' => ''
        ]);

        // 5    re-Boot Anthony H
        $session = Session::updateOrCreate([
            'class_id' => 3,
            'start_time' => "07:45 AM",
            'end_time' => "08:30 AM",
            'coach_id' => 5
        ], [
            'class_id' => 3,
            'start_time' => "07:45 AM",
            'end_time' => "08:30 AM",
            'coach_id' => 5,
            'music_id' => 2,
            'capacity' => 20,
            'status' => 'Pending',
            'recurring_type' => 'Weekly',
            'recuring_interval' => json_encode([3, 4, 5]),
            'session_total_count' => 1,
            'minimum_open_type' => 'Date',
            'minimum_open_value' => ''
        ]);

        // 6    re-Boot Anthony H
        $session = Session::updateOrCreate([
            'class_id' => 3,
            'start_time' => "09:00 AM",
            'end_time' => "09:45 AM",
            'coach_id' => 6
        ], [
            'class_id' => 3,
            'start_time' => "09:00 AM",
            'end_time' => "09:45 AM",
            'coach_id' => 6,
            'music_id' => 5,
            'capacity' => 20,
            'status' => 'Pending',
            'recurring_type' => 'Weekly',
            'recuring_interval' => json_encode([2,6]),
            'session_total_count' => 1,
            'minimum_open_type' => 'Date',
            'minimum_open_value' => ''
        ]);

        // 7    re-cycle Sharon RV
        $session = Session::updateOrCreate([
            'class_id' => 1,
            'start_time' => "09:00 AM",
            'end_time' => "09:45 AM",
            'coach_id' => 10
        ], [
            'class_id' => 1,
            'start_time' => "09:00 AM",
            'end_time' => "09:45 AM",
            'coach_id' => 10,
            'music_id' => 4,
            'capacity' => 20,
            'status' => 'Pending',
            'recurring_type' => 'Weekly',
            'recuring_interval' => json_encode([1,3,5]),
            'session_total_count' => 1,
            'minimum_open_type' => 'Date',
            'minimum_open_value' => ''
        ]);

        // 8    re-Boot Anthony RV
        $session = Session::updateOrCreate([
            'class_id' => 3,
            'start_time' => "09:00 AM",
            'end_time' => "09:45 AM",
            'coach_id' => 6
        ], [
            'class_id' => 3,
            'start_time' => "09:00 AM",
            'end_time' => "09:45 AM",
            'coach_id' => 6,
            'music_id' => 4,
            'capacity' => 20,
            'status' => 'Pending',
            'recurring_type' => 'Weekly',
            'recuring_interval' => json_encode([4]),
            'session_total_count' => 1,
            'minimum_open_type' => 'Date',
            'minimum_open_value' => ''
        ]);

        // 9    re-Boot Ellie  R&B
        $session = Session::updateOrCreate([
            'class_id' => 3,
            'start_time' => "09:00 AM",
            'end_time' => "09:45 AM",
            'coach_id' => 3
        ], [
            'class_id' => 3,
            'start_time' => "09:00 AM",
            'end_time' => "09:45 AM",
            'coach_id' => 3,
            // 'music_id' => 3,
            'capacity' => 20,
            'status' => 'Pending',
            'recurring_type' => 'Weekly',
            'recuring_interval' => json_encode([7]),
            'session_total_count' => 1,
            'minimum_open_type' => 'Date',
            'minimum_open_value' => ''
        ]);

        // 10    re-Boot Anthony H
        $session = Session::updateOrCreate([
            'class_id' => 3,
            'start_time' => "10:15 AM",
            'end_time' => "11:00 AM",
            'coach_id' => 6
        ], [
            'class_id' => 3,
            'start_time' => "10:15 AM",
            'end_time' => "11:00 AM",
            'coach_id' => 6,
            'music_id' => 5,
            'capacity' => 20,
            'status' => 'Pending',
            'recurring_type' => 'Weekly',
            'recuring_interval' => json_encode([2,6]),
            'session_total_count' => 1,
            'minimum_open_type' => 'Date',
            'minimum_open_value' => ''
        ]);

        // 11    re-cycle  Sharon RV
        $session = Session::updateOrCreate([
            'class_id' => 1,
            'start_time' => "10:15 AM",
            'end_time' => "11:00 AM",
            'coach_id' => 10
        ], [
            'class_id' => 1,
            'start_time' => "10:15 AM",
            'end_time' => "11:00 AM",
            'coach_id' => 10,
            'music_id' => 4,
            'capacity' => 20,
            'status' => 'Pending',
            'recurring_type' => 'Weekly',
            'recuring_interval' => json_encode([3,5]),
            'session_total_count' => 1,
            'minimum_open_type' => 'Date',
            'minimum_open_value' => ''
        ]);
        
        // 12    beatbox JENNY R&B
        $session = Session::updateOrCreate([
            'class_id' => 5,
            'start_time' => "10:15 AM",
            'end_time' => "11:00 AM",
            'coach_id' => 9
        ], [
            'class_id' => 5,
            'start_time' => "10:15 AM",
            'end_time' => "11:00 AM",
            'coach_id' => 9,
            // 'music_id' => 3,
            'capacity' => 20,
            'status' => 'Pending',
            'recurring_type' => 'Weekly',
            'recuring_interval' => json_encode([4]),
            'session_total_count' => 1,
            'minimum_open_type' => 'Date',
            'minimum_open_value' => ''
        ]);
                
        // 13    re-cycle Ellie RAVE
        $session = Session::updateOrCreate([
            'class_id' => 1,
            'start_time' => "10:15 AM",
            'end_time' => "11:00 AM",
            'coach_id' => 3
        ], [
            'class_id' => 1,
            'start_time' => "10:15 AM",
            'end_time' => "11:00 AM",
            'coach_id' => 3,
            'music_id' => 4,
            'capacity' => 20,
            'status' => 'Pending',
            'recurring_type' => 'Weekly',
            'recuring_interval' => json_encode([7]),
            'session_total_count' => 1,
            'minimum_open_type' => 'Date',
            'minimum_open_value' => ''
        ]);
                        
        // 14    re-Boot SHARON RV
        $session = Session::updateOrCreate([
            'class_id' => 3,
            'start_time' => "10:15 AM",
            'end_time' => "11:00 AM",
            'coach_id' => 10
        ], [
            'class_id' => 3,
            'start_time' => "10:15 AM",
            'end_time' => "11:00 AM",
            'coach_id' => 10,
            'music_id' => 4,
            'capacity' => 20,
            'status' => 'Pending',
            'recurring_type' => 'Weekly',
            'recuring_interval' => json_encode([1]),
            'session_total_count' => 1,
            'minimum_open_type' => 'Date',
            'minimum_open_value' => ''
        ]);
                                
        // 15    re-Boot BEEMAN  POP
        $session = Session::updateOrCreate([
            'class_id' => 3,
            'start_time' => "11:30 AM",
            'end_time' => "12:15 PM",
            'coach_id' => 7
        ], [
            'class_id' => 3,
            'start_time' => "11:30 AM",
            'end_time' => "12:15 PM",
            'coach_id' => 7,
            'music_id' => 2,
            'capacity' => 20,
            'status' => 'Pending',
            'recurring_type' => 'Weekly',
            'recuring_interval' => json_encode([2,6]),
            'session_total_count' => 1,
            'minimum_open_type' => 'Date',
            'minimum_open_value' => ''
        ]);
                                
        // 16    re-Boot Anthony 90
        $session = Session::updateOrCreate([
            'class_id' => 3,
            'start_time' => "11:30 AM",
            'end_time' => "12:15 PM",
            'coach_id' => 6
        ], [
            'class_id' => 3,
            'start_time' => "11:30 AM",
            'end_time' => "12:15 PM",
            'coach_id' => 6,
            'music_id' => 1,
            'capacity' => 20,
            'status' => 'Pending',
            'recurring_type' => 'Weekly',
            'recuring_interval' => json_encode([3,5]),
            'session_total_count' => 1,
            'minimum_open_type' => 'Date',
            'minimum_open_value' => ''
        ]);
                                        
        // 17    BEATBOX LUCY  R&B
        $session = Session::updateOrCreate([
            'class_id' => 5,
            'start_time' => "11:30 AM",
            'end_time' => "12:15 PM",
            'coach_id' => 8
        ], [
            'class_id' => 5,
            'start_time' => "11:30 AM",
            'end_time' => "12:15 PM",
            'coach_id' => 8,
            // 'music_id' => 3,
            'capacity' => 20,
            'status' => 'Pending',
            'recurring_type' => 'Weekly',
            'recuring_interval' => json_encode([1,7]),
            'session_total_count' => 1,
            'minimum_open_type' => 'Date',
            'minimum_open_value' => ''
        ]);
                                                
        // 18    re-Boot BEEMAN  90
        $session = Session::updateOrCreate([
            'class_id' => 3,
            'start_time' => "12:45 PM",
            'end_time' => "01:15 PM",
            'coach_id' => 7
        ], [
            'class_id' => 3,
            'start_time' => "12:45 PM",
            'end_time' => "01:15 PM",
            'coach_id' => 7,
            'music_id' => 1,
            'capacity' => 20,
            'status' => 'Pending',
            'recurring_type' => 'Weekly',
            'recuring_interval' => json_encode([2,6]),
            'session_total_count' => 1,
            'minimum_open_type' => 'Date',
            'minimum_open_value' => ''
        ]);
                                                        
        // 19    re-Boot Anthony H
        $session = Session::updateOrCreate([
            'class_id' => 3,
            'start_time' => "12:45 PM",
            'end_time' => "01:15 PM",
            'coach_id' => 6
        ], [
            'class_id' => 3,
            'start_time' => "12:45 PM",
            'end_time' => "01:15 PM",
            'coach_id' => 6,
            'music_id' => 5,
            'capacity' => 20,
            'status' => 'Pending',
            'recurring_type' => 'Weekly',
            'recuring_interval' => json_encode([3,5]),
            'session_total_count' => 1,
            'minimum_open_type' => 'Date',
            'minimum_open_value' => ''
        ]);
                                                                
        // 20     RE-CYCLE SHARON RV
        $session = Session::updateOrCreate([
            'class_id' => 1,
            'start_time' => "12:45 PM",
            'end_time' => "01:15 PM",
            'coach_id' => 10
        ], [
            'class_id' => 1,
            'start_time' => "12:45 PM",
            'end_time' => "01:15 PM",
            'coach_id' => 10,
            'music_id' => 4,
            'capacity' => 20,
            'status' => 'Pending',
            'recurring_type' => 'Weekly',
            'recuring_interval' => json_encode([4]),
            'session_total_count' => 1,
            'minimum_open_type' => 'Date',
            'minimum_open_value' => ''
        ]);
                                                                        
        // 21     DANCE LUCY  H
        $session = Session::updateOrCreate([
            'class_id' => 2,
            'start_time' => "12:45 PM",
            'end_time' => "01:15 PM",
            'coach_id' => 8
        ], [
            'class_id' => 2,
            'start_time' => "12:45 PM",
            'end_time' => "01:15 PM",
            'coach_id' => 8,
            'music_id' => 5,
            'capacity' => 20,
            'status' => 'Pending',
            'recurring_type' => 'Weekly',
            'recuring_interval' => json_encode([1,7]),
            'session_total_count' => 1,
            'minimum_open_type' => 'Date',
            'minimum_open_value' => ''
        ]);
                                                                                
        // 22     YOGA Z  RASHA OWN
        $session = Session::updateOrCreate([
            'class_id' => 4,
            'start_time' => "01:45 PM",
            'end_time' => "02:15 PM",
            'coach_id' => 4
        ], [
            'class_id' => 4,
            'start_time' => "01:45 PM",
            'end_time' => "02:15 PM",
            'coach_id' => 4,
            'music_id' => 6,
            'capacity' => 20,
            'status' => 'Pending',
            'recurring_type' => 'Weekly',
            'recuring_interval' => json_encode([1,7]),
            'session_total_count' => 1,
            'minimum_open_type' => 'Date',
            'minimum_open_value' => ''
        ]);
                                                                                        
        // 23     re-cycle Ellie  RAVE
        $session = Session::updateOrCreate([
            'class_id' => 1,
            'start_time' => "04:30 PM",
            'end_time' => "05:15 PM",
            'coach_id' => 3
        ], [
            'class_id' => 1,
            'start_time' => "04:30 PM",
            'end_time' => "05:15 PM",
            'coach_id' => 3,
            'music_id' => 4,
            'capacity' => 20,
            'status' => 'Pending',
            'recurring_type' => 'Weekly',
            'recuring_interval' => json_encode([2,3,5,6]),
            'session_total_count' => 1,
            'minimum_open_type' => 'Date',
            'minimum_open_value' => ''
        ]);
                                                                                                
        // 24     re-Boot BEEMAN    H
        $session = Session::updateOrCreate([
            'class_id' => 3,
            'start_time' => "04:30 PM",
            'end_time' => "05:15 PM",
            'coach_id' => 7
        ], [
            'class_id' => 3,
            'start_time' => "04:30 PM",
            'end_time' => "05:15 PM",
            'coach_id' => 7,
            'music_id' => 5,
            'capacity' => 20,
            'status' => 'Pending',
            'recurring_type' => 'Weekly',
            'recuring_interval' => json_encode([4]),
            'session_total_count' => 1,
            'minimum_open_type' => 'Date',
            'minimum_open_value' => ''
        ]);
                                                                                                        
        // 25     re-Boot JENNY H
        $session = Session::updateOrCreate([
            'class_id' => 3,
            'start_time' => "05:45 PM",
            'end_time' => "06:30 PM",
            'coach_id' => 9
        ], [
            'class_id' => 3,
            'start_time' => "01:45 PM",
            'end_time' => "02:15 PM",
            'coach_id' => 7,
            'music_id' => 5,
            'capacity' => 20,
            'status' => 'Pending',
            'recurring_type' => 'Weekly',
            'recuring_interval' => json_encode([2,3,5,6]),
            'session_total_count' => 1,
            'minimum_open_type' => 'Date',
            'minimum_open_value' => ''
        ]);
                                                                                                                
        // 26      RE-CYCLE SHARON RV
        $session = Session::updateOrCreate([
            'class_id' => 1,
            'start_time' => "05:45 PM",
            'end_time' => "06:30 PM",
            'coach_id' => 10
        ], [
            'class_id' => 1,
            'start_time' => "05:45 PM",
            'end_time' => "06:30 PM",
            'coach_id' => 10,
            'music_id' => 4,
            'capacity' => 20,
            'status' => 'Pending',
            'recurring_type' => 'Weekly',
            'recuring_interval' => json_encode([4]),
            'session_total_count' => 1,
            'minimum_open_type' => 'Date',
            'minimum_open_value' => ''
        ]);
                                                                                                                        
        // 27      beatbox JENNY R&B
        $session = Session::updateOrCreate([
            'class_id' => 5,
            'start_time' => "07:00 PM",
            'end_time' => "07:45 PM",
            'coach_id' => 9
        ], [
            'class_id' => 5,
            'start_time' => "07:00 PM",
            'end_time' => "07:45 PM",
            'coach_id' => 9,
            // 'music_id' => 3,
            'capacity' => 20,
            'status' => 'Pending',
            'recurring_type' => 'Weekly',
            'recuring_interval' => json_encode([2,6]),
            'session_total_count' => 1,
            'minimum_open_type' => 'Date',
            'minimum_open_value' => ''
        ]);
                                                                                                                         
        // 28      YOGA - P RASHA OWN
        $session = Session::updateOrCreate([
            'class_id' => 4,
            'start_time' => "07:00 PM",
            'end_time' => "07:45 PM",
            'coach_id' => 4
        ], [
            'class_id' => 4,
            'start_time' => "07:00 PM",
            'end_time' => "07:45 PM",
            'coach_id' => 4,
            'music_id' => 6,
            'capacity' => 20,
            'status' => 'Pending',
            'recurring_type' => 'Weekly',
            'recuring_interval' => json_encode([3,5]),
            'session_total_count' => 1,
            'minimum_open_type' => 'Date',
            'minimum_open_value' => ''
        ]);
                                                                                                                                 
        // 29       RE-CYCLE SHARON RV
        $session = Session::updateOrCreate([
            'class_id' => 1,
            'start_time' => "07:00 PM",
            'end_time' => "07:45 PM",
            'coach_id' => 10
        ], [
            'class_id' => 1,
            'start_time' => "07:00 PM",
            'end_time' => "07:45 PM",
            'coach_id' => 10,
            'music_id' => 4,
            'capacity' => 20,
            'status' => 'Pending',
            'recurring_type' => 'Weekly',
            'recuring_interval' => json_encode([4]),
            'session_total_count' => 1,
            'minimum_open_type' => 'Date',
            'minimum_open_value' => ''
        ]);
                                                                                                                                         
        // 30       YOGA - Z RASHA OWN
        $session = Session::updateOrCreate([
            'class_id' => 4,
            'start_time' => "08:15 PM",
            'end_time' => "09:00 PM",
            'coach_id' => 4
        ], [
            'class_id' => 4,
            'start_time' => "08:15 PM",
            'end_time' => "09:00 PM",
            'coach_id' => 4,
            'music_id' => 6,
            'capacity' => 20,
            'status' => 'Pending',
            'recurring_type' => 'Weekly',
            'recuring_interval' => json_encode([2,4]),
            'session_total_count' => 1,
            'minimum_open_type' => 'Date',
            'minimum_open_value' => ''
        ]);
                                                                                                                                                 
        // 31       beatbox LUCY  R&B
        $session = Session::updateOrCreate([
            'class_id' => 5,
            'start_time' => "08:15 PM",
            'end_time' => "09:00 PM",
            'coach_id' => 8
        ], [
            'class_id' => 5,
            'start_time' => "08:15 PM",
            'end_time' => "09:00 PM",
            'coach_id' => 8,
            // 'music_id' => 3,
            'capacity' => 20,
            'status' => 'Pending',
            'recurring_type' => 'Weekly',
            'recuring_interval' => json_encode([3,5]),
            'session_total_count' => 1,
            'minimum_open_type' => 'Date',
            'minimum_open_value' => ''
        ]);
                                                                                                                                                         
        // 32       DANCE LUCY  H
        $session = Session::updateOrCreate([
            'class_id' => 2,
            'start_time' => "08:15 PM",
            'end_time' => "09:00 PM",
            'coach_id' => 8
        ], [
            'class_id' => 2,
            'start_time' => "08:15 PM",
            'end_time' => "09:00 PM",
            'coach_id' => 8,
            'music_id' => 5,
            'capacity' => 20,
            'status' => 'Pending',
            'recurring_type' => 'Weekly',
            'recuring_interval' => json_encode([6]),
            'session_total_count' => 1,
            'minimum_open_type' => 'Date',
            'minimum_open_value' => ''
        ]);
    }
}
