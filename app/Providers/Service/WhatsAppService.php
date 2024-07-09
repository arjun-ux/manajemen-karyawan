<?php

namespace App\Providers\Service;

use Illuminate\Support\ServiceProvider;

class WhatsAppService extends ServiceProvider
{
    // send notif
    public static function sendNotif($targetNumber, $message){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.fonnte.com/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
        'target' => $targetNumber,
        'message' => $message   ,
        'countryCode' => '62', //optional
        ),
        CURLOPT_HTTPHEADER => array(
            'Authorization: FJZdrn93tyGKUbHEfABG' //change TOKEN to your actual token
        ),
        ));

        $response = curl_exec($curl);
        if ($response == true) {
            return response()->json(['message' => 'berhasil',]);
        }else{
            return response()->json(['message' => 'gagal']);
        }
    }
}
