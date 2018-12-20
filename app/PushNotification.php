<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;

class PushNotification //extends Model
{

        public static function chat( $token, $type,$admin_name,$message )
        {
             $data = [
               'title' => $message,
               'who' => 'buyer',
               'admin_name' => 'admin',
               'message' => $message,
               'type' => 2,
             ];

            self::send_the_notification($token,$data);
        }

        public static function send_the_notification($tokens,$data)
        {
              $fields = array
              (
                  "registration_ids" => $tokens,
                  "priority" => 10,
                  'data' => $data,
                  'notification' => $data,
                  'vibrate' => 1,
                  'sound' => 1
              );
              $headers = array
                  (
                  'accept: application/json',
                  'Content-Type: application/json',
                  'Authorization: key=' .
                  // 'AIzaSyDMeSqZgUzQaPeVEm-KsTusRUVGFiRbW80'
                  'AAAAyq9OKaY:APA91bHBZNo6l1-Y6q5q65s44Ayxdpt0OwbtQygi5w2D4zt9Z5VPfPuxkoEVpr4t_sswaIIuLupKs_RkiIogv4OAvM5-CeMlwnDLx8E7Shj6qogKhW3hQx3fBYaDnAuQvWvE66Y9V9_HYzFO1zPpSWrYYgM2NOTN-w'

              );
              $ch = curl_init();
              curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
              curl_setopt($ch, CURLOPT_POST, true);
              curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
              curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
              curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
              $result = curl_exec($ch);
              //  var_dump($result);
              if ($result === FALSE) {
                  die('Curl failed: ' . curl_error($ch));
              }
              curl_close($ch);
              return $result;

        }
}
