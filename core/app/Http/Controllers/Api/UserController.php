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
use App\Models\Faq;
use App\Models\Media;
use App\Models\UserAdvisory;
use App\Models\UserReward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Slider;
use App\Models\Service;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CaseWorkstream;
use App\Models\CaseWorkstreamMessage;
use App\User;
use App\Models\Category;
use Auth;

class UserController extends Controller
{
    public function list(Request $request)
    {
        return response([
            'users' => User::all(),
            'success' => 1
        ]);
    }

    public function home(Request $request)
    {
        // try {
             $sliders = Slider::where('slider_type_id', 2)
                ->where('status', 1)
                ->inRandomOrder()
                ->take(6)
                ->get(['id', 'title', 'image','link']);

            $ongoing_services = Order::where('user_id',auth()->id())
                ->where('payment_status',2)
                ->whereNotIn('status',[Order::STATUS_CANCELLED,Order::STATUS_COMPLETED])
                ->with(['service'=>function($q){
                    $q->select(['id','title','banner','service_duration']);
                }, 'case_workstream'])->latest()->get()->take(10);

            $services = Service::where('is_publish', 1)
                ->withCount('orders')
                ->orderBy("orders_count", 'DESC')
                ->limit(9)
                ->get(['id', 'title', 'banner']);
            
            foreach ($ongoing_services as $key => $service) {
                if (is_array($service->document)) {
                    $service->document = collect(Category::select('id','name')->whereIn('id', $service->document)->pluck('name')->toArray())->join(', ');
                }else{
                    $service->document = null;
                }
            }
            foreach ($services as $key => $service) {
                if (is_array($service->document)) {
                    $service->document = collect(Category::select('id','name')->whereIn('id', $service->document)->pluck('name')->toArray())->join(', ');
                }else{
                    $service->document = null;
                }
            }

            $search = Service::where('is_publish', 1)->inRandomOrder()->get(['id', 'title', 'banner']);
            $faqs = Faq::where('category_id', 44)->get();


            $order_ids = Order::where('user_id',auth()->id())->whereNotIn('status', [Order::STATUS_CANCELLED, Order::STATUS_COMPLETED])->where('payment_status',Order::PAYMENT_STATUS_PAID)->pluck('id');

            $caseWorkstream_ids = CaseWorkstream::whereIn('case_id',$order_ids)->pluck('id');
            $workstreamMessage = CaseWorkstreamMessage::whereIn('workstream_id',$caseWorkstream_ids)->latest()->first();
            $is_readed = 1;
            if($workstreamMessage){
                if($workstreamMessage->user_id != auth()->id()){
                    $is_readed = 0;
                }else{
                    $is_readed = 1;
                }
            }
            $contact = [
                'email' => getSetting('frontend_footer_email'),
                'phone' => getSetting('frontend_footer_phone'),
                'address' => getSetting('frontend_footer_address'),
            ];

            $data = [
                'sliders' => $sliders,
                'ongoing_services' => $ongoing_services,
                'services' => $services,
                'search' => $search,
                'contact' => (object)$contact,
                'faqs' => $faqs,
                'is_readed' => $is_readed,
            ];
            return $this->success($data);
        // } catch (Exception $e) {
        //     return $this->error("Error: Something went wrong!");
        // }
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required | string ',
            'email'    => 'required | email | unique:users',
            'password' => 'required | confirmed',
            'role'     => 'required'
        ]);

        // store user information
        $user = User::create([
                    'name'     => $request->name,
                    'email'    => $request->email,
                    'password' => Hash::make($request->password)
                ]);

        // assign new role to the user
        $role = $user->assignRole($request->role);

        if($user){
            return response([
                'message' => 'User created succesfully!',
                'user'    => $user,
                'success' => 1
            ]);
        }

        return response([
                'message' => 'Sorry! Failed to create user!',
                'success' => 0
            ]);
    }

    public function profile($id, Request $request)
    {
        $user = User::find($id);
        if($user)
            return response(['user' => $user,'success' => 1]);
        else
            return response(['message' => 'Sorry! Not found!','success' => 0]);
    }


    public function delete($id, Request $request)
    {
        $user = User::find($id);

        if($user){
            $user->delete();
            return response(['message' => 'User has been deleted','success' => 1]);
        }
        else
            return response(['message' => 'Sorry! Not found!','success' => 0]);
    }


    public function changeRole($id,Request $request)
    {
        $request->validate([
            'roles'     => 'required'
        ]);

        // update user roles
        $user = User::find($id);
        if($user){
            // assign role to user
            $user->syncRoles($request->roles);
            return response([
                'message' => 'Roles changed successfully!',
                'success' => 1
            ]);
        }

        return response([
                'message' => 'Sorry! User not found',
                'success' => 0
            ]);
    }
    public function myRewards()
    {
        try {
            $rewards = UserReward::where('user_id', auth()->id())
            ->with('code')
            ->get();
            foreach ($rewards as $reward) {
                $used_promocodes = Order::where('promo_code',$reward['code']['code'])
                ->where('user_id',auth()->id())->count() ?? 0;
                $reward['code']['used_promocode'] = $used_promocodes;
            }
            return $this->success($rewards);
        } catch (\Exception | \Error $e) {
            return $this->error('Something went wrong!' . $e->getMessage());
        }

    }

    public function userDelete(){
        if(AuthRole()  != 'Admin'){
            $user = User::whereId(auth()->id())->first();
                $user->update([
                    'email' => 'deleted-'.rand(0000,9999).'-'.auth()->user()->email, 
                    'phone' => rand(0000,9999).auth()->user()->phone, 
                ]);
                $user = auth()->user()->token();
                auth()->user()->update([
                    'fcm_token' => null,
                ]);
                $user->revoke();

                return response([
                    'message' => 'User has been deleted',
                    'success' => 1
                ]);
        }else{
            return response([
                'message' => 'Sorry! User not found',
                'success' => 0
            ]);
        }
    
    }
    public function placeCallMask(Request $request){
        if($request->from_number == null){
            return response()->json([
                'message' => 'Please provide from number',
                'status' => 'success',
            ]);
        }
        if($request->mobile_number == null){
            return response()->json([
                'message' => 'Please provide user phone number',
                'status' => 'success',
            ]);
        }
        $phone = callMasking($request->from_number,$request->mobile_number);
        return response()->json([
            'message' => 'Phone number found',
            'status' => 'success',
            'phone' =>$phone
        ]);
    
    }

}
