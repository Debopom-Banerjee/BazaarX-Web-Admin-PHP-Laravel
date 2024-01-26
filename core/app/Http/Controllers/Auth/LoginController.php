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

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Traits\CanSendSMS;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;

class LoginController extends Controller
{
    use CanSendSMS;
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login(Request $request)
    {
        $this->validateLogin($request);
        
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            
            return $this->sendLockoutResponse($request);
        }
        // return $request->all();

        if ($this->guard()->validate($this->credentials($request))) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 3])) {
                // return redirect()->intended('dashboard');
                $this->incrementLoginAttempts($request);
                return response()->json([
                    'error' => 'This account is not activated.'
                ], 401);
            } elseif (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1])) {
                return redirect('/panel/dashboard');
            } elseif (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 2])) {
                return redirect('/panel/dashboard');
            }
        } else {
            // dd('ok');
            $this->incrementLoginAttempts($request);
            return redirect()->back()->with('error','Credentials do not match our database.');
            // return response()->json([
            //     'error' => 'Credentials do not match our database.'
            // ], 401);
        }
    }
    public function getOtp(Request $request){
        try{
            $this->validate($request, [
                'phone'     => 'required|digits:10|numeric',
            ]);
            $chk = User::where('phone',$request->phone)->first();
            if($chk){
                $otp = rand(1000,9999);
                // Send OTP
                $this->sms()
                ->to($chk->phone)
                ->template('1707164507719278973')
                ->setMessage("Dear $chk->full_name, Your OTP is $otp - GoFinx.com")
                ->send();
                session()->put('phone',$request->phone);
                $chk->temp_otp = $otp;
                $chk->save();
                return response()->json(['status'=> 'success','message'=>'OTP send successfully']);
            }
            return response()->json(['status'=> 'error','message'=>'There is no registered user with this number.']);
        }catch(Exception $e){            
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
    }
    public function loginWithOtp(Request $request)
    {
        try{
            $otp = implode('',$request->otp);
            $chk = User::where('phone',session()->get('phone'))->where('temp_otp', $otp)->first();
            if($chk){
                auth()->loginUsingId($chk->id);
                session()->forget('phone');
                return response()->json(['status'=> 'success','message'=>'User logged in successfully!']);
            }else{
                return response()->json(['status'=> 'error','message'=>'Invalid OTP!']);
            }
        }catch(Exception $e){            
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
    }

    protected function validateLogin(Request $request)
    {
        if(getSetting('recaptcha') == 0){
            $validate = 'recaptcha|sometimes';
        }else{
            $validate = 'recaptcha|required';
        }
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
            'g-recaptcha-response' => $validate,
        ]);
    }
    // custom logout function
    // redirect to login page
    public function logout(Request $request)
    {
        //Make Log
        makeLog($activity = "Logout", $ip = $request->ip());
        if (authRole() == 'Admin') {
            $redirect = '/';
        } else {
            $redirect = '/';
        }
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new Response('', 204)
            : redirect($redirect);
    }
}
