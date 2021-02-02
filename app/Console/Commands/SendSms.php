<?php

namespace App\Console\Commands;

use App\Models\Notification;
use Illuminate\Console\Command;

class SendSms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sms:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        for ($i = 0; $i < 3; $i++) {
            $notifications = Notification::whereStatus('0')->limit(20)->get();
            foreach ($notifications as $notification) {
                $this->send($notification->code, $notification->mobile);
                $notification->status = 1;
                $notification->save();
            }
        sleep(10);
        }
    }

    public function send($code, $mobile)
    {
        $username = "paseban120";
        $password = 'pas120pas';
        $from = "+983000505";
        $pattern_code = "vytm8tma8n";
        $to = array($mobile);
        $input_data = array("verification-code" => $code);
        $url = "https://ippanel.com/patterns/pattern?username=" . $username . "&password=" . urlencode($password) . "&from=$from&to=" . json_encode($to) . "&input_data=" . urlencode(json_encode($input_data)) . "&pattern_code=$pattern_code";
        $handler = curl_init($url);
        curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($handler, CURLOPT_POSTFIELDS, $input_data);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
        curl_exec($handler);
    }
}
