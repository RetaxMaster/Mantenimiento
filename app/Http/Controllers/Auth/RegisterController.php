<?php
namespace App\Http\Controllers\Auth;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller {

    protected function register() {

        $data = Validator::make(request()->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'rol' => 'required|numeric'
        ]);

        if($data->fails()) {
            $response["status"] = "false";
            $response["responseText"] = $data->errors()->toArray();
        }
        else {
            $user = User::create([
                'name' => request("name"),
                "username" => request("username"),
                'email' => request("email"),
                'rol' => request("rol"),
                'email_verified_at' => now(),
                'password' => Hash::make(request("password"))
            ]);

            $response["status"] = "true";
            $response["user"] = $user;
        }

        return json_encode($response);
        
    }

}