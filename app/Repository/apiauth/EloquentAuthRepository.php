<?php

namespace App\Repository\apiauth;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class EloquentAuthRepository implements AuthRepository
{

    public function saveUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            $response = ['status' => false, 'message' => $error];
            return response($response, 500);
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $token = Str::random(80);
        // $token = $user->createToken('my-app-token')->plainTextToken;
        $user->remember_token = $token;
        $save = $user->save();

        if ($save) {
            $response = ['status' => true, 'message' => 'Please Login to Continue'];
            return response($response, 200);
        } else {
            $response = ['status' => false, 'message' => 'Something went wrong, try again later'];
            return response($response, 500);
        }
    }

    public function checkLogin(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5|max:25',
        ]);

        $userinfo = User::where('email', '=', $request->email)->first();
        if (!$userinfo) {
            $response = ['status' => false, 'message' => 'Oops! Given email does not exist'];
            return response($response, 401);
        } else {
            if (Hash::check($request->password, $userinfo->password)) {
                $token = $userinfo->createToken('my-app-token')->plainTextToken;
                $userinfo->remember_token = $token;
                $userinfo->save();

                $response = ['status' => true, 'token' => $token];
                return response($response, 200);
            } else {
                $response = ['status' => false, 'message' => 'Incorrect Password'];
                return response($response, 401);
            }
        }
    }
}