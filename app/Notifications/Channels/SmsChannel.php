<?php


namespace App\Notifications\Channels;


class SmsChannel
{
    public function send($notifiable , Notification $notification){
        $data = $notification->toSmsChannel($notifiable);
        $username = "paseban120";
        $password = 'pas120pas';
        $from = "+983000505";
        $pattern_code = "vytm8tma8n";
        $to = array( $data['number']);
        $input_data = array("verification-code" =>$data['text']);
        $url = "https://ippanel.com/patterns/pattern?username=" . $username . "&password=" . urlencode($password) . "&from=$from&to=" . json_encode($to) . "&input_data=" . urlencode(json_encode($input_data)) . "&pattern_code=$pattern_code";
        $handler = curl_init($url);
        curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($handler, CURLOPT_POSTFIELDS, $input_data);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
        curl_exec($handler);
    }
}
