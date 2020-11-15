<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sendSms($name, $phone, $message)
    {
        $phone = '233' . substr($phone, -9);

        $sms_url = "https://api.nalosolutions.com/bulksms/?" . "username=" . $this->sms_username . "&password=" . urlencode($this->sms_pass) . "&" .
            "type=0&dlr=1&destination=$phone" . "&source=" . urlencode('moafrica') . "&message=" . urlencode($message);

        //kokrokoad
        $response = file_get_contents($sms_url);
    }
}
