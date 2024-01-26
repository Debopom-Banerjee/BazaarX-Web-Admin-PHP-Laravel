<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class ProfileController extends Controller
{
    public function getDetails()
    {
        try {
            return $this->success(auth()->user());
        } catch (\Exception | \Error $e) {
            info($e->getMessage());
            return $this->error('Something went wrong!');
        }
    }

    public function getAddress()
    {
        try {
            return $this->success(auth()->user()->only([
                'address',
                'pincode',
                'city',
                'state',
                'district',
            ]));
        } catch (\Exception $e) {
            info($e->getMessage());
            return $this->error('Something went wrong!');
        } 

    }

    public function postDetails(Request $request)
    {
        // try {
            $request->validate([
                'first_name' => 'required|string',
                'email' => 'required',
                'phone' => 'required|numeric',
                'dob' => 'required',
                'gender' => 'required',
            ]);

            $user = User::find(auth()->id());

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

            if ($request->has('avatar') && $request->hasFile('avatar')) {
                if ($user->avatar !== null && file_exists(storage_path() . '/app/public/backend/users' . $user->avatar)) {
                    unlinkfile(storage_path() . '/app/public/backend/users', $user->avatar);
                }
                $image = $request->file('avatar');
                $path = storage_path() . '/app/public/backend/users/';
                $imageName = 'profile_image_' . $user->id . rand(0000, 9999) . '.' . $image->getClientOriginalExtension();
                $image->move($path, $imageName);
                $image = $imageName;
            } else {
                $image = $user->getAttributes()['avatar'];
            }

            $user->update([
                'name' => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                'phone' => $request->get('phone'),
                'dob' => $request->get('dob'),
                'gender' => $request->get('gender'),
                'avatar' => $image,
                'email' => $request->get('email')
            ]);

            return $this->successMessage("User data updated successfully!");

        // } catch (\Exception $e) {
        //     info($e->getMessage());
        //     return $this->error('Something went wrong!'.$e->getMessage(), 200);
        // } 


    }

    public function postAddress(Request $request)
    {
        try {
            $request->validate([
                'address' => 'required|string',
                'pincode' => 'required|numeric',
                'city' => 'required|string',
                'state' => 'required|numeric',
                'district' => 'required|string',
                'country' => 'required|numeric',
            ]);
            auth()->user()->update([
                "address" => $request->get('address'),
                "pincode" => $request->get('pincode'),
                "city" => $request->get('city'),
                "state" => $request->get('state'),
                "district" => $request->get('district'),
                "country" => $request->get('country'),
            ]);

            return $this->successMessage("Address updated successfully!");
        } catch (\Exception | \Error $e) {
            return $this->error("Something went wrong!");
        }

    }


}
