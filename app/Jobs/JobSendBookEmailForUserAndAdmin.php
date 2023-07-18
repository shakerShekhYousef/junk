<?php

namespace App\Jobs;

use App\Mail\EmailBookToAdmin;
use App\Mail\EmailBookToUser;
use App\Models\ErrorLog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class JobSendBookEmailForUserAndAdmin extends basejob
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
            Mail::to(config('app.adminemail'))->send(new EmailBookToAdmin($this->data));
            Mail::to($this->data['memberemail'])->send(new EmailBookToUser($this->data));
        } catch (\Throwable $th) {
            $this->errorLog("JobSendBookEmailForUserAndAdmin", $th->getMessage());
        }
    }
}
