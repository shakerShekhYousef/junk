<?php

namespace App\Jobs;

use App\Models\ErrorLog;
use Illuminate\Support\Facades\Mail;

class basejob
{
    public function errorLog($source, $body)
    {
        $data = ErrorLog::create([
            'source' => $source,
            'body' => $body
        ]);
        return $data->id;
    }
}
