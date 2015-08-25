<?php
namespace App\Events;

use App\User;

use Illuminate\Support\Facades\Event;
use Illuminate\Queue\SerializesModels;

/**
 * Created by PhpStorm.
 * User: Lawrence
 * Date: 8/19/15
 * Time: 11:29 AM
 */
class UserRegistration extends Event
{


//    use SerializesModels;

    public $user;


    public function __construct(User $user)
    {

        $this->user = $user;

    }

}