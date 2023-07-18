<?php

namespace App\Jobs;

use App\Mail\EmailForOpenSession;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class JobEmailSessionOpenToMembers extends basejob
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            foreach ($this->data as $key => $item) {
                $notifdata = ['classname' => $item['classname'], 'opendate' => $item['opendate'], 'username' => $item['username'], 'starttime' => $item['starttime'], 'endtime' => $item['endtime']];
                Mail::to($item['email'])->send(new EmailForOpenSession($notifdata));
            }
        } catch (\Throwable $th) {
            $this->errorLog("JobEmailSessionOpenToMembers", $th->getMessage());
        }
    }
}
