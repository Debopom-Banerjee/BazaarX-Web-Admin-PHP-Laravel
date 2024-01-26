<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Code;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Order;
use App\Models\Portfolio;
use App\Models\CaseWorkstream;
use App\Models\CaseWorkstreamMessage;
use App\User;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        try {
            $page = $request->has('page') ? $request->get('page') : 1;
            $limit = $request->has('limit') ? $request->get('limit') : $this->resultLimit;

            $orders = Order::query();
            if ($request->get('status')) {
                $orders->where('status', $request->get('status'));
            }
            $orders->where('user_id', auth()->id());
            $orders = $orders->whereNotIn('status', [Order::STATUS_CANCELLED, Order::STATUS_COMPLETED, Order::STATUS_INACTIVE,Order::STATUS_APPROVED])
                ->where('payment_status',[Order::PAYMENT_STATUS_PAID])
                ->with('case_workstream')
                ->with(['service' => function ($q) {
                        $q->select(['id', 'title', 'banner']);
                }])
                ->with(['partner'=>function($q1){
                    $q1->select(['id','phone']);
                }])
                ->latest()
                ->limit($limit)->offset(($page - 1) * $limit)
                ->get()
                ->makehidden(['deleted_at', 'type', 'from', 'to', 'service_data', 'remarks']);

            return $this->success($orders);

        } catch (\Exception | \Error $e) {
            return $this->error('No Chats Yet!');
        }
    }

    public function show(Request $request, $id)
    {
        try {
            $page = $request->has('page') ? $request->get('page') : 1;
            $limit = $request->has('limit') ? $request->get('limit') : $this->resultLimit;

            $case = CaseWorkstream::where('case_id', $id)->first();

            $messages = CaseWorkstreamMessage::where('workstream_id', $case->id)
                ->limit($limit)->offset(($page - 1) * $limit)
                ->with('user',function($q){
                    $q->select('id','name','last_name');
                })
                ->latest()
                ->get();

            return $this->success($messages);
        } catch (\Exception | \Error $e) {
            return $this->error('No Chats Yet!' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $caseWorkStreamMessage = CaseWorkstreamMessage::create([
                'user_id' => \Auth::id(),
                'message' => $request->get('message'),
                'workstream_id' => $request->get('workstream_id'),
                'type' => $request->get('type'),
            ]);
            return $this->successMessage('Success!');
        } catch (\Exception | \Error $e) {
            return $this->error('Something went wrong!');
        }
    }
}
