<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Order;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $order = Order::where('id',$request->order_id)->first();
        $review = Review::where('type',Order::class)->where('type_id',$order->id)->where('user_id',auth()->id())->first();
        if($review){
            return response(['data' => $review, 'success' => 1 ,'message' => 'Review Found']);
        }
            return $this->error('Review Not Found !');
    }
    public function store(Request $request)
    {
        $order = Order::where('id',$request->order_id)->first();
        $user = auth()->user();
       if ($order) {
            Review::create([
                'user_id' => $user->id,
                'type' => Order::class,
                'type_id' => $order->id,
                'name' => $user->name,
                'email' => $user->email,
                'rating' => $request->rating,
                'description' => $request->description,
            ]);
            return $this->success('Review Created !');
        }
        return $this->error('Please Provide Order Id !');
    }
}
