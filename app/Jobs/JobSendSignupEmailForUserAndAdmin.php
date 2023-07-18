<?php

namespace App\Jobs;

use App\Mail\EmailSignupToAdmin;
use App\Mail\EmailSignupToUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class JobSendSignupEmailForUserAndAdmin extends basejob
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
            Mail::to(config('app.adminemail'))->send(new EmailSignupToAdmin($this->data));
            Mail::to($this->data['memberemail'])->send(new EmailSignupToUser($this->data));
        } catch (\Throwable $th) {
            $this->errorLog("JobSendSignupEmailForUserAndAdmin", $th->getMessage());
        }
    }
}
