<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->has('page') ? $request->get('page') : 1;
        $limit = $request->has('limit') ? $request->get('limit') : $this->resultLimit;

        $notifications = Notification::where('user_id', auth()->id())
            ->limit($limit)->offset(($page - 1) * $limit)
            ->get();

        return $this->success($notifications);
    }
}
