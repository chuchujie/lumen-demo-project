<?php
namespace App\Http\Controllers;

use App\Events\UserRegistration;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Event;

/**
 * Created by PhpStorm.
 * User: Lawrence
 * Date: 8/19/15
 * Time: 9:35 AM
 */
class UserController extends Controller
{


    /**
     * Store user's initial details i.e. last_name, first_name and phone_no
     * @param Request $request
     */
    public function registrationStepOne(Request $request)
    {

        $v = Validator::make($request->all(), [
            'phone_no' => 'unique:users'
        ]);

        if ($v->fails()) {
            return response()->json($v->errors());
        }

        $user = new User();

        $user->last_name = $request->last_name;
        $user->first_name = $request->first_name;
        $user->phone_no = $request->phone_no;

        $user->save();


        Event::fire(new UserRegistration($user));

    }

    /**
     * @param Request $request
     * @param $user_id
     */
    public function registrationStepTwo(Request $request)
    {

        /**
         * Update the details of the user
         */


        $v = Validator::make($request->all(), [
            'email' => 'unique:users',
            'id' => 'exists:users',
        ]);

        if ($v->fails()) {
            return response()->json($v->errors());
        }

        $usermodel = User::findOrFail($request->id);


        $usermodel->email = $request->email;
        $usermodel->address = $request->address;
        $usermodel->password = Hash::make($request->password);

        if ($usermodel->save()) {

        };


    }

}