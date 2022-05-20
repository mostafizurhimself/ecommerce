<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\ApiResource;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    /**
     * Initiate the class
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('assign.guard:users');
        $this->middleware('jwt.auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(auth()->user()->id);
        return ApiResource::collection($user->notifications);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function markAsRead($id)
    {
        // Get the notification
        $notification  = auth()->user()->notifications()->where('id', $id)->first();
        // Mark as read
        $notification->markAsRead();
        // Return the notification
        return new ApiResource($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function markAllAsRead()
    {
        // Get the notifications
        $notifications  = auth()->user()->unreadNotifications;
        // Mark all as read
        foreach ($notifications as $notification) {
            $notification->markAsRead();
        }
        // Return the notifications
        return ApiResource::collection(auth()->user()->notifications);
    }

    /**
     * Remove all notification of the user
     *
     * @return \Illuminate\Http\Response
     */
    public function clearAll()
    {
        return auth()->user()->notifications()->delete();
    }
}