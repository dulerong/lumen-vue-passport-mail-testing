<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;
use Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'username'=>'required|string|email|max:255',
            'password'=>'required|string|max:255'
        ]);

        $http = new \GuzzleHttp\Client;

        try {
            $response = $http->post(env('PASSPORT_LOGIN_ENDPOINT'), [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id'  => env('PASSPORT_CLIENT_ID'),
                    'client_secret' => env('PASSPORT_CLIENT_SECRET'),
                    'username' => $request->username,
                    'password' => $request->password,
                ]
            ]);
            return $response->getBody();
        } 
        catch(\GuzzleHttp\Exception\BadResponseException $err) {
            if($err->getCode() === 400){
                return response()->json('Invalid login credentials', $err->getCode());
            }
            else if($err->getCode() === 401){
                return response()->json('Incorrect credentials. Please try again', $err->getCode());
            }
            
            return response()->json('Something went wrong on the server', $err->getCode());
        }
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:3|max:255',
            'email'=> 'required|string|email|max:255|unique:users',
            'password'=>'required|confirmed|string|min:6'
        ]);

        if(User::where('email', $request->email)->exists()){ 
            return response()->json(['code' => 409, 'message' => 'Email already exist!'], 409);
        }

        return User::create([
            'name' => $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password)
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens->each(function ($token, $key){
            $token->delete();
        });

        return response()->json('Logged out successfully', 200);
    }

    public function showUserName()
    {
        $username = Auth::user()->name;
        return response()->json($username);
    }
}
