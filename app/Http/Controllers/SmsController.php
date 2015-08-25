<?php namespace App\Http\Controllers;

use App\Http\Requests;

use App\SmsLogs;

use \AfricasTalkingGateway;

class SmsController extends Controller
{



    public function sendSms($recipients, $message, $user_id)
    {



        $username = "lawrence615";
        $apikey = "7b6d751a45a78908a32d7744008c334ba9e9e7b7a975bf16586f09fecf3239fd";


        // Create a new instance of our awesome gateway class
        $gateway = new AfricasTalkingGateway($username, $apikey);


        try {
            // Thats it, hit send and we'll take care of the rest.
            $results = $gateway->sendMessage($recipients, $message);

            foreach ($results as $result) {

                SmsLogs::create(
                    [
                        'status' => ($result->status == 'Success') ? 1 : 0,
                        'user_id' => $user_id
                    ]
                );
            }
        } catch (AfricasTalkingGatewayException $e) {
            echo "Encountered an error while sending: " . $e->getMessage();
        }


    }

}
