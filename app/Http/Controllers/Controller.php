<?php

namespace App\Http\Controllers;

use App\Models\ErrorLog;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function errorLog($source, $body)
    {
        $data = ErrorLog::create([
            'source' => $source,
            'body' => $body
        ]);
        return $data->id;
    }
}
