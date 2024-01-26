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

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\UserLog;
use App\Models\UserKyc;
use App\Models\Service;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\UserInviter;
use App\Models\MailSmsTemplate;
use App\Models\BankDetail;
use App\Models\Transaction;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DataTables;
use Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $length = 10;
        if(request()->get('length')){
            $length = $request->get('length');
        }
        $roles = Role::whereIn('id', [3,2])->get()->pluck('name', 'id');
        $users = User::query();
        $users->notRole(['Super Admin'])->where('id', '!=', auth()->id());
        if($request->get('role')){
            $users->role($request->get('role'));
        }
        if($request->get('search')){
            $users->where('name','like','%'.$request->get('search').'%')
                ->orWhere('email','like','%'.$request->get('search').'%')
                ->orWhere('phone','like','%'.$request->get('search').'%');
        }
        
        if($request->get('from') && $request->get('to')) {
            $users->whereBetween('created_at', [\Carbon\carbon::parse($request->from)->format('Y-m-d'),\Carbon\Carbon::parse($request->to)->format('Y-m-d')]);
        }
        $users= $users->latest()->paginate($length);
        if ($request->ajax()) {
            return view('user.load', ['users' => $users])->render();  
        }
        return view('user.index', compact('roles','users'));  

        return view('user.users', compact('roles'));
    }
    public function print(Request $request){
        $users = collect($request->records['data']);
        return view('user.print', ['users' => $users])->render();  
    }

  
    public function userShow(Request $request, $id)
    {
        $roleCheck = \DB::table('model_has_roles')->where('model_id',$id)->first();
        if(!$roleCheck){
            \DB::table('model_has_roles')->insert(['model_id'=>$id,'model_type'=>'App\User','role_id'=>3]);
        }
        $length = 10;
        if(request()->get('length')){
            $length = $request->get('length');
        }
        if(UserRole($id) == 'Partner'){
            $order_count = Order::where('partner_id',$id)->count();
            $orders = Order::where('partner_id',$id)->latest()->paginate($length);
        }else{
            $order_count = Order::where('user_id',$id)->count();
            $orders = Order::where('user_id',$id)->latest()->paginate($length);
        }
        $eKyc = UserKyc::where('user_id',$id)->first();
        $referrals = UserInviter::where('user_id',$id)->paginate($length);
        $referrals_count = UserInviter::where('user_id',$id)->count();
        $user = User::whereId($id)->first();
        $bank_detail = BankDetail::whereUserId($id)->first();
        $user_kyc = UserKyc::whereUserId($id)->first();
        if ($request->ajax()) {
            if($request->showtype == ''){
                return '';  
            }
            if($request->showtype == 'Service'){
                return view('user.include.service', ['orders' => $orders,'user'=>$user])->render();  
            }
            if($request->showtype == 'Referral'){
                return view('user.include.referral', ['referrals' => $referrals,'user'=>$user])->render();  
            }
        }
        return view('user.users-show', compact('id','user','user_kyc','orders','referrals','referrals_count','order_count','bank_detail'));
    }


    public function create()
    {
        try {
            $roles = Role::where('id','!=',1)->pluck('name', 'id');
            return view('user.create-user', compact('roles'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }
    
    public function userlog($u_id = null, $role=null)
    {
        try {
            $roles = Role::whereIn('id', [3,10])->get()->pluck('name', 'id');
            if ($role == null) {
                $userIds  = User::notRole(['Super Admin','Admin'])->pluck('id');
                $user_log = UserLog::where('user_id', $u_id)->get();
            } else {
                $userIds  = User::Role($role)->pluck('id');
                $user_log = UserLog::whereIn('user_id', $userIds)->get();
            }
            return view('user.user-logs', compact('user_log', 'roles'));
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        // if(Session::has('last_pay_attempt')){
        //     $last_attempt = Session::get('last_pay_attempt');
        //     $difference = $last_attempt->diffInMinutes(\Carbon\Carbon::now());
        //     $seconds = 120-$last_attempt->diffInSeconds(\Carbon\Carbon::now());
        //     if($difference < 2){
        //         return redirect()->back()->with('error', "Hold on, Please try after $seconds seconds.")->withInput($request->all());
        //     }
        // }
        // Session::put('last_pay_attempt', \Carbon\Carbon::now());
        // create user
        $validator = Validator::make($request->all(), [
            'fname'     => 'required | string ',
            'lname'     => 'required | string ',
            'email'    => 'required | email | unique:users',
            'password' => 'required',
            'role'     => 'required'
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }
        
        try {
            // store user information
            $user = User::create([
                'name'     => $request->fname,
                'last_name'     => $request->lname,
                'email'    => $request->email,
                'country'    => $request->country,
                'state'    => $request->state,
                'city'    => $request->city,
                'pincode'    => $request->pincode,
                'address'    => $request->address,
                'phone'    => $request->phone,
                'status'    => $request->status,
                'commission'    => $request->commission,
                'password' => Hash::make($request->password),
            ]);

            // assign new role to the user
            $user->syncRoles($request->role);
            $role = $user->roles[0]->name ?? '';
            return redirect()->route('panel.users.index','?role='.$role)->with('success','Record Created Successfully!');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function edit($id)
    {
        try {
            $user  = User::with('roles', 'permissions')->find($id);
            if ($user) {
                $user_role = $user->roles->first();
                $roles     = Role::where('id','!=',1)->pluck('name', 'id');
                return view('user.user-edit', compact('user', 'user_role', 'roles'));
            } else {
                return redirect('404');
            }
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'     => 'required | string ',
            'email'    => 'required | email',
        ]);
        $user = User::whereId($id)->first();
        $chk_email = User::where('email',$request->email)->first();
        if($chk_email){
            return back()->with('error','Email already exist');
        }
        try {
            $user->name=$request->name;
            $user->last_name=$request->lastname;
            $user->email=$request->email;
            $user->dob=$request->dob;
            $user->gender=$request->gender;
            $user->country=$request->country;
            $user->state=$request->state;
            $user->city=$request->city;
            $user->pincode=$request->pincode;
            $user->address=$request->address;
            $user->commission=$request->commission;
            $user->save();
            $user->syncRoles($request->role);
            $role = $user->roles[0]->name ?? '';
            return redirect()->route('panel.users.index','?role='.$role)->with('success', 'User information updated succesfully!');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function profile()
    {
        $user = auth()->user();
        $eKyc = UserKyc::where('user_id',$user->id)->first();
        if($eKyc){
            $eKyc_details = json_decode($eKyc->details);
        }else{
            $eKyc_details = [];
        }
        return view('user.profile', compact('user','eKyc_details'));
    }

    public function updateProfile(Request $request, $id)
    {
        $this->validate($request, [
            'name'     => 'required | string ',
        ]);
  
        $user = User::whereId($id)->first();
        try {
            if(!isset($request->email)){
                $request->email = $user->email;
            }
            $user->name=$request->name;
            $user->last_name=$request->lastname;
            $user->email=$request->email;
            $user->timezone=$request->timezone;
            $user->language=$request->language;
            $user->dob=$request->dob;
            $user->gender=$request->gender;
            $user->country=$request->country;
            $user->phone=$request->phone;
            $user->state=$request->state;
            $user->city=$request->city;
            $user->pincode=$request->pincode;
            $user->address=$request->address;
            $user->commission=$request->commission;
            $user->email_verified_at=now();
            $user->is_verified=$request->is_verified;
            $user->save();

            return redirect()->back()->with('success', 'User information updated successfully!');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function updateProfileImage(Request $request, $id)
    {
        $user = User::findOrFail($id);

        try {
            if ($request->hasFile('avatar')) {
                if ($user->avatar != null) {
                    unlinkfile(storage_path() . '/app/public/backend/users', $user->avatar);
                }
                $image = $request->file('avatar');
                $path = storage_path() . '/app/public/backend/users/';
                $imageName = 'profile_image_' . $user->id.rand(000, 999).'.' . $image->getClientOriginalExtension();
                $image->move($path, $imageName);
                $user->avatar=$imageName;
            } else {
                return back()->with('error', 'Please select an image to upload!');
            }
            $user->update(['avatar' => $imageName]);
            return back()->with('success', 'Profile image updated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
    }
    
    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required | confirmed ',
            'password' => ' required | min:6',
        ]);

        if ($request->password !== $request->confirm_password) {
            return back()->with('error', 'Password and confirm password don\'t match !');
        }
        try {
            User::find($id)->update([
                'password' => Hash::make($request->password),
            ]);
            return back()->with('success', 'Your password updated successfully !');
        } catch (\Exception $e) {
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
    }

    public function loginAs($id)
    {
        try {
            if ($id == auth()->id()) {
                return back()->with('error', 'Do not try to login as yourself.');
            } else {
                $user   = User::find($id);

                
                session(['admin_user_id' => auth()->id()]);
                session(['temp_user_id' => $user->id]);
                auth()->logout();
                
                // Login.
                auth()->loginUsingId($user->id);
    
                // Redirect.
                return redirect(route('panel.dashboard'));
            }
        } catch (\Exception $e) {
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
    }
    public function status($id, $s)
    {
        try {
            $user   = User::find($id);
            $user->update(['status' => $s]);
            $role = $user->roles[0]->name ?? '';
            return redirect()->route('panel.users.index','?role='.$role)->with('success', 'User status Updated!');
        } catch (\Exception $e) {
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
    }

    public function updateEkycStatus(Request $request)
    {   
            $user = UserKyc::whereUserId($request->user_id)->firstOrFail();
           $ekyc_info = json_decode($user->details,true);

        if(is_null($ekyc_info)){
            abort(404);
        }
        $new_ekyc_info = [
            'document_type' => $ekyc_info['document_type'],
            'document_number' => $ekyc_info['document_number'],
            'document_front' => $ekyc_info['document_front'],
            'document_back' => $ekyc_info['document_back'],
            'admin_remark' => $request['remark'],
        ];   

        $new_ekyc_info = json_encode($new_ekyc_info);
        if($user->status == 1){
            $mailcontent_data = MailSmsTemplate::where('code','=',"Verified-KYC")->first();
            if($mailcontent_data){
            $arr=[
                '{id}'=> $user->id,
                '{name}'=>NameById( $user->id),
                ];
            $action_button = null;
            TemplateMail($user->name,$mailcontent_data,$user->email,$mailcontent_data->type, $arr, $mailcontent_data, $chk_data = null ,$mail_footer = null, $action_button);
            }
            $onsite_notification['user_id'] =  $user->id;
            $onsite_notification['title'] = "Your eKYC has been verified succesfully!";
            $onsite_notification['link'] = route('customer.dashboard')."?active=account";
            pushOnSiteNotification($onsite_notification);

        }

        if($user->status == 2){
            $mailcontent_data = MailSmsTemplate::where('code','=',"Rejected-KYC")->first();
            if($mailcontent_data){
            $arr=[
                '{id}'=> $user->id,
                '{name}'=>NameById( $user->id),
                ];
            $action_button = null;
            TemplateMail($user->name,$mailcontent_data,$user->email,$mailcontent_data->type, $arr, $mailcontent_data, $chk_data = null ,$mail_footer = null, $action_button);
            }
          $onsite_notification['user_id'] =  $user->id;
            $onsite_notification['title'] = "Your eKYC has been rejected because of some reason please try again later.";
            if(UserRole($user->id) == 'Partner'){
                $onsite_notification['link'] = route('panel.dashboard');
            }else{
                $onsite_notification['link'] = route('customer.dashboard')."?active=account";
            }
            pushOnSiteNotification($onsite_notification);

        }
        
        $user->update([
           'details' =>$new_ekyc_info,
           'status' => $request->status,
        ]);

        return redirect()->back()->with('success','eKYC update successfully!');
    }

    public function delete($id)
    {
        $user   = User::whereId($id)->first();

        if ($user) {
            $role = $user->roles[0]->name ?? '';
            $user->delete();
            return redirect()->route('panel.users.index','?role='.$role)->with('success', 'User removed!');
        } else {
            return redirect()->route('panel.users.index','?role='.$role)->with('error', 'User not found');
        }
    }
    public function editAccountDetail(Request $request)

    {
        try {
            $bank_detail = BankDetail::whereId($request->id)->first();
            $bank_detail->update([
                'user_id' => $request->user_id,
                'name' => $request->name,
                'ifscCode' => $request->ifscCode,
                'accountNumber' => $request->accountNumber,
                'fundAccountId' => $bank_detail->fundAccountId,
                'contactInfoId' => $bank_detail->contactInfoId,
            ]);
            return back()->with('success', 'Account Detail Updated!');
        } catch (\Exception $e) {
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
    }
    public function deleteAccountDetail($id)
    {
        $bank_detail   = BankDetail::whereId($id)->first();
        if ($bank_detail) {
            $bank_detail->delete();
            return back()->with('success', 'Account Detail Removed!');
        } else {
            return back()->with('error', 'Detail not found');
        }
    }

    public function getPartners(Request $request)
    {
        $input = $request->all();
        $users = User::query();
        $users->select(['id','name','last_name','email','phone','commission']);
        if($request->has('query') && !empty($input['query'])){
            $users->where("name","like",'%'.$input['query'].'%')
                ->orWhere("last_name", "like",'%'.$input['query'].'%')
                ->orWhere("email", "like",'%'.$input['query'].'%')
                ->orWhere("phone", "like",'%'.$input['query'].'%');
        }
        $users = $users->role('Partner')->latest()->limit(15)->get();
        return response()->json($users);
    }

    public function ekycUpdate(Request $request)
    {

    return $request->all();
    }

    
    public function balance(Request $request)
    {
        $length = 10;
        if(request()->get('length')){
            $length = $request->get('length');
        }
        
        $roles = Role::whereIn('id', [3,2])->get()->pluck('name', 'id');

        $query = Transaction::select('transactions.*', 'users.name', 'users.last_name', 'users.id as user_id', 'services.title' )
            ->addSelect(['affiliated_by'=>function ($query0){
            $query0->select('name')
                    ->from('users')
                    ->whereColumn('id', 'transactions.affiliated_id');
            }])
            ->join('users', 'users.id', '=', 'transactions.user_id')
            ->leftjoin('services', 'services.id', '=', 'transactions.service_id' );

        
        
        if($request->get('search')){
            $query = $query->where('name','LIKE','%'.$request->get('search').'%')
                    ->orWhere('amount','LIKE','%'.$request->get('search').'%');
        }
        
        if ($request->get('asc')) {
            $query= $query->orderBy($request->get('asc'), 'asc');
        }
        
        if ($request->get('desc')) {
            $query= $query->orderBy($request->get('desc'), 'desc');
        }
        $users= $query->latest()->paginate($length);
        if ($request->ajax()) {
            return view('user.load-balance', ['users' => $users])->render();
        }
        
        return view('user.balance', compact('roles','users'));
        
        return view('user.users', compact('roles'));
    }
    
    public function transactions(Request $request){
        
        $users = collect($request->records['data']);
        return view('user.print-balance', ['users' => $users])->render();
    }
}
