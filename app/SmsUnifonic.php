<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmsUnifonic  // extends Model
{

    public static function send($phone,$body)
    {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "http://api.unifonic.com/rest/Messages/Send");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_POST, TRUE);

        // curl_setopt($ch, CURLOPT_POSTFIELDS, 'AppSid=GHSykPqclLWs34xQhwXQKKkbVTATs0&Recipient=962781466060&Body=Test');
        curl_setopt($ch, CURLOPT_POSTFIELDS, "AppSid=GHSykPqclLWs34xQhwXQKKkbVTATs0&Recipient=$phone&Body=$body");

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
          "Content-Type: application/x-www-form-urlencoded"
        ));

        $response = curl_exec($ch);
        curl_close($ch);
          return ($response);
    }

}
