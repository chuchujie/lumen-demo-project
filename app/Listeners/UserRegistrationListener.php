<?php

namespace App\Listeners;

/**
 * Created by PhpStorm.
 * User: Lawrence
 * Date: 8/19/15
 * Time: 11:32 AM
 */
use App\Events\UserRegistration;

use App\Http\Controllers\SmsController;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRegistrationListener implements ShouldQueue
{

    protected $user;

    public function __construct()
    {

    }

    public function handle(UserRegistration $event)
    {

        $this->user = $event->user;


        $sms = new SmsController();

        $sms->sendSms($this->user->phone_no, '567423', $this->user->id);
    }


}