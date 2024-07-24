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
    // public static function sendNotif($targetNumber, $message){
    //     $url = 'https://gateway.buku-tamu.com/send-message'; // Ganti dengan URL yang sesuai
    //     $data = array(
    //         'api_key' => 'oiKsUZ2ivo80bnqlkswiOFacC4FJhuYT',
    //         'sender' => '6283873757064',
    //         'number' => $targetNumber,
    //         'message' => $message,
    //     );

    //     $payload = json_encode($data);

    //     $ch = curl_init($url);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //     $result = curl_exec($ch);

    //     if ($result == true) {
    //         return response()->json(['message' => 'berhasil',]);
    //     }else{
    //         return response()->json(['message' => 'gagal']);
    //     }
    // }
}
