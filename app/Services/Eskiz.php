<?php

namespace App\Services;

/**
 * Class Eskiz
 */

class Eskiz
{
    public static function getToken(): array
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "notify.eskiz.uz/api/auth/login",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => array('email' => "irmatovsh95@mail.ru",'password' => "b1yjsP7i17JiY4veSNg5ebI65TlCF4weFz4GK5K2"),
        ));
        $response = json_decode(curl_exec($curl),true);
        curl_close($curl);
        if($response['message'] == "token_generated"){
            $token = $response['data']['token'];
            return [
                'status'=>true,
                'token'=>$token
            ];
        }else{
            return [
                'status'=>false,
            ];
        }
    }
    /**
     * @param null $phone - length phone number sample: 998991234567
     * @param null $text - text
     * @return float
     */
    public static function sendSms($phone = null, $text,$token) : bool
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "notify.eskiz.uz/api/message/sms/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => array('mobile_phone' => $phone,'message' => $text,'from' => '4546'),
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $token"
            ),
        ));
        $response = json_decode(curl_exec($curl),true);
        curl_close($curl);
        //dd($response);
        if($response['status'] == "waiting"){
            return true;
        }
    }
}
