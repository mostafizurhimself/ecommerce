<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\User;
use App\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\ApiResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AdminProfileRequest;

class ProfileController extends Controller
{
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        return new ApiResource(auth()->user());
    }

    /**
     * Update authenticate user profile
     *
     * @param \App\Http\Requests\AdminProfileRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProfile(AdminProfileRequest $request)
    {
        // Update the user
        $user = User::find(auth()->user()->id);
        DB::transaction(function () use ($request, $user) {
            $user->update([
                'name'  => $request->name,
                'email' => $request->email
            ]);

            if ($request->photo) {
                $user->addMediaFromBase64($request->photo)->toMediaCollection('profile-photo');
            }
        });
        return Response::success('Profile updated successfully', ['user' => $user]);
    }

    /**
     * Reset password for auth user
     */
    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'oldPassword' => 'required|string|min:6',
            'password'    => 'required|string|confirmed|min:6',
        ]);
        if (Hash::check($request->oldPassword, auth()->user()->password)) {
            auth()->user()->update(['password' => Hash::make($request->password)]);
            return Response::success("Password updated successfully.");
        }
        return Response::error("Old password doesn't matched.");
    }
}