<?php

namespace App\Console\Commands;

use App\Jobs\JobEmailSessionOpenToMembers;
use App\Models\Book;
use App\Models\ClassM;
use App\Models\Notification;
use App\Models\Session;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SessionsNotificationsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'junk:sessionsnotifictions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {

            $books = Book::where('status', 'Pending')->get();
            $classes = ClassM::all();
            $users = User::all();
            $sessions = Session::all();
            $notiflist = [];
            $emailslist = [];
            foreach ($books as $key => $book) {
                // send notifications/emails for users before 2 days or current day
                if ($book->status == "Pending") {
                    $diffindays = Carbon::parse($book->bookdate)->diffInDays(today()->toDateString());
                    if ($diffindays == 2) {
                        $classname = $classes->where('id', $book->class_id)->pluck('name')->first();
                        $useremail =  $users->where('id', $book->member_id)->pluck('email')->first();
                        $username =  $users->where('id', $book->member_id)->first()->username();
                        $starttime = $sessions->where('id', $book->session_id)->pluck('start_time')->first();
                        $endtime = $sessions->where('id', $book->session_id)->pluck('end_time')->first();
                        $opendate = today()->addDays(2)->toDateString();
                        $notiflist[] = ['member_id' => $book->member_id, 'notification_type' => 'Open session', 'message' => "Dear member $username session  $classname  will open at $opendate, start time is $starttime and it will remain till $endtime"];
                        $emailslist[] = ['classname' => $classname, 'opendate' => $opendate, 'email' => $useremail, 'username' =>  $username, 'starttime' => $starttime, 'endtime' => $endtime];
                    } else if ($diffindays == 0) {
                        $classname = $classes->where('id', $book->class_id)->pluck('name')->first();
                        $useremail =  $users->where('id', $book->member_id)->pluck('email')->first();
                        $username =  $users->where('id', $book->member_id)->first()->username();
                        $starttime = $sessions->where('id', $book->session_id)->pluck('start_time')->first();
                        $endtime = $sessions->where('id', $book->session_id)->pluck('end_time')->first();
                        $opendate = today()->toDateString();
                        $notiflist[] = ['member_id' => $book->member_id, 'notification_type' => 'Open session', 'message' => "Dear member $username session  $classname  will open today $opendate, start time is $starttime and it will remain till $endtime"];
                        $emailslist[] = ['classname' => $classname, 'opendate' => $opendate, 'email' => $useremail, 'username' =>  $username, 'starttime' => $starttime, 'endtime' => $endtime];
                    }
                }
            }

            Notification::insert($notiflist);
            JobEmailSessionOpenToMembers::dispatch($emailslist);

        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
}
