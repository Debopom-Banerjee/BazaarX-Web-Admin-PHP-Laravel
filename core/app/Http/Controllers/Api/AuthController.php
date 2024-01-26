<?php
/**
 *
 * @category zStarter
 *
 * @ref zCURD
 * @author  Defenzelite <hq@defenzelite.com>
 * @license https://www.defenzelite.com Defenzelite Private Limited
 * @version <zStarter: 1.1.0>
 * @link    https://www.defenzelite.com
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MailSmsTemplate;
use Illuminate\Http\Request;
use App\Traits\CanSendSMS;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\State;
use App\Models\City;
use App\Models\UserInviter;
use App\User;
use Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    use CanSendSMS;
    public function login(Request $request)
    {
        $validData = $request->validate([
            'email' => 'required|email|string',
            'password' => 'required|string'
        ]);


        if (!auth()->attempt($validData)) {
            return $this->error('Invalid credentials!', 200);
        }

        if(auth()->user()->status == 0){
            auth()->logout();
            return $this->error('Your account is inactive!');
        }

        $accessToken = Auth::user()->createToken('authToken')->accessToken;
        return $this->success([
            'user' => Auth::user(),
            'token' => $accessToken,
        ]);
    }

    public function sendPhoneOtp(Request $request)
    {
        $validData = $request->validate([
            'fcm_token' => 'sometimes',
            'phone' => 'required',
        ]);

        $chk = User::where('phone', $request->phone)->first();
        // Check if user exists
        if($chk){
            $otp = rand(1000,9999);

            // Send OTP
            $this->sms()
            ->to($chk->phone)
            ->template('1707164507719278973')
            ->setMessage("Dear $chk->full_name, Your OTP is $otp - GoFinx.com")
            ->send();

            $chk->temp_otp = $otp;
            $chk->fcm_token = $request->fcm_token ?? null;
            $chk->save();

            return $this->success([
                'otp' => $otp,
            ]);
        }else{
        //    Create new user
            User::create([
                'name' => "Guest",
                'email' => $request->phone."@user.gofinx.com",
                'phone' => $request->phone,
                'password' => Hash::make(rand(1000, 9999)),
                'referal_code' => strtoupper(Str::random(7)),
            ]);
            $user = User::whereEmail($request->phone."@user.gofinx.com")->first();
            $user->syncRoles(3);
            return $this->sendPhoneOtp($request);
        }

    }

    public function loginWithOtp(Request $request)
    {
        $validData = $request->validate([
            'phone' => 'required',
            'otp' => 'required'
        ]);

        $chk = User::where('phone', $request->phone)->where('temp_otp', $request->otp)->first();
        if($chk){
            $accessToken = $chk->createToken('authToken')->accessToken;
            return $this->success([
                'user' => $chk,
                'token' => $accessToken,
            ]);
        }else{
            return $this->error('Invalid OTP!');
        }

    }

    public function getStates()
    {
        $states = State::where('country_id', 101)->get(['id', 'name']);
        if ($states->count() > 0) {
            return $this->success($states);
        } else {
            return $this->error('No States Found!', 200);
        }
    }

    public function getCities(Request $request)
    {
        $cities = City::where('state_id', $request->state_id)->get(['id', 'name']);
        if ($cities->count() > 0) {
            return $this->success($cities);
        } else {
            return $this->error('No City Found!', 200);
        }
    }

    public function register(Request $request)
    {
        $validData = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|string|unique:users,email',
            'password' => 'required',
            'phone' => 'required|numeric',
            'state' => 'required|numeric',
            'referral_code' => 'sometimes',
        ]);

        $ref_user = null;
        if ($request->has('referral_code') && $request->get('referral_code') != null) {
            $ref_user = User::where('referal_code', $request->get('referral_code'))->first();
            if (!$ref_user) {
                return $this->error('Invalid Referral Code!');
            }
        }
        $user = User::create([
            'name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'country' => 101,
            'state' => $request->state,
            'referal_code' => strtoupper(Str::random(7)),
        ]);
        $user = User::whereEmail($request->email)->first();
        $user->syncRoles(3);
        /* mail start  user*/
        $mail_data = MailSmsTemplate::where('code', 'Welcome')->first();
        $arr = [
            '{name}' => $user->name,
            '{id}' => $user->id,
        ];
        customMail($user->name, $user->email, $mail_data, $arr);
        if ($ref_user) {
            UserInviter::create([
                'user_id' => $user->id,
                'inviter_id' => $ref_user->id,
            ]);
        }

        if ($user) {
            return $this->successMessage("User Registered Successfully!");
        } else {
            return $this->error("Something went wrong", 200);
        }
    }

    public function resetPassword(Request $request)
    {
        $validData = $request->validate([
            'email' => 'required|email|string',
        ]);

        $user = User::where('email', $request->get('email'))->first();
        if (!$user) {
            return $this->error('User not found!', 200);
        }
        $otp = rand(1000, 9999);
        $user->temp_otp = $otp;
        $user->save();
        $body = "To reset your password, please use the following One Time Password (OTP):" . $otp . "<br> Thank you for using." . config('app.name');
        StaticMail($user->name, $user->email, "Reset Password in" . config('app.name'), $body, $mail_footer = null);
        return $this->successMessage("OTP Sent Successfully!");
    }

    public function verifyOtp(Request $request)
    {
        $validData = $request->validate([
            'email' => 'required|email|string',
            'otp' => 'required|numeric',
        ]);

        $user = User::where('email', $request->get('email'))->first();
        if (!$user) {
            return $this->error('User not found!', 200);
        }
        if ($user->temp_otp == $request->get('otp')) {

            return $this->successMessage("OTP Verified Successfully!");
        } else {
            return $this->error("Invalid OTP!", 200);
        }
    }

    public function changeResetPassword(Request $request)
    {
        $validData = $request->validate([
            'email' => 'required|email|string',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->get('email'))->first();
        if (!$user) {
            return $this->error('User not found!', 200);
        }
        $user->temp_otp = null;
        $user->password = Hash::make($request->password);
        $user->save();
        return $this->successMessage("Password updated successfully!");
    }


    public function profile(Request $request)
    {
        return $this->success(auth()->user());
    }


    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required|string',
            'password' => 'required|string|confirmed'
        ]);

        // match old password
        if (Hash::check($request->old_password, Auth::user()->password)) {

            User::find(auth()->user()->id)
                ->update([
                    'password' => Hash::make($request->password)
                ]);


            return $this->successMessage("Password has been changed!");


        }
        return $this->error("Password not matched!");

    }


    public function updateProfile(Request $request)
    {
        $validData = $request->validate([
            'name' => 'required|string',
        ]);

        $user = Auth::user();
        // check unique email except this user
        if (isset($request->email)) {
            $check = User::where('email', $request->email)
                ->where('id','!=',$user->id)
                ->count();
            if ($check > 0) {
                return response([
                    'message' => 'The email address is already used!',
                    'success' => 0
                ]);
            }
        }
        $user->update($validData);
        return response([
            'message' => 'Profile updated successfully!',
            'status' => 1
        ]);
    }


    public function logout(Request $request)
    {
        $user = auth()->user()->token();

        auth()->user()->update([
            'fcm_token' => null,
        ]);
        $user->revoke();

        return $this->successMessage('Logged out successfully!');
    }

    public function myReferrals(Request $request)
    {
         
        $page = $request->has('page') ? $request->get('page') : 1;
        $limit = $request->has('limit') ? $request->get('limit') : $this->resultLimit;

        $userIds = UserInviter::where('inviter_id', auth()->id())->pluck('user_id')->toArray();
        $referrals = User::query();

        $referrals = $referrals->whereIn('id', $userIds)
            ->limit($limit)->offset(($page - 1) * $limit)->get();
        return $this->success($referrals);
    }

    public function updateDeviceToken(Request $request)
    {
        auth()->user()->update([
            'fcm_token' => $request->get('fcm_token'),
        ]);

        return $this->successMessage('Updated');
    }
    public function socialLogin(Request $request)
    {
        $validData = $request->validate([
            'email' => 'required|email|string',
        ]);

        $user = User::where('email', $request->get('email'))->first();
        if($user){
            auth()->loginUsingId($user->id);
        } else {
            return $this->error('Email account not found please register a new account.');
        }


        if(auth()->user()->status == 0){
            auth()->logout();
            return $this->error('Your account is inactive!');
        }

        $accessToken = Auth::user()->createToken('authToken')->accessToken;
        return $this->success([
            'user' => Auth::user(),
            'token' => $accessToken,
        ]);
    }

    public function googleSignUp(Request $request)
    {
        $user = User::where('email', $request->get('email'))->exists();
        return $this->success($user);
    }
}
