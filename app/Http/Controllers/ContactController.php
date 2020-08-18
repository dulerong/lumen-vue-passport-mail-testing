<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordResetMailable;
use Illuminate\Support\Str;
use App\User;

class ContactController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function email(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if($user){ 
            $token = Str::random(32);

            $username = $user->name;
            $email    = $user->email;

            \DB::table('password_resets')->updateOrInsert(
                ['email' => $user->email],
                ['email' => $user->email, 'token' => $token]
            );

            $url = env('APP_URL') . '/password/verifytoken?token=' . $token . '&email=' . $email;

            Mail::to([$user->email])->send(new PasswordResetMailable($token, $username, $url));

            return response()->json(['status' => 'success', 'message' => 'New token issued to user']);
        }
        else{return response()->json(['status' => 'fail', 'message' => 'Email is not registered in database!']);}
    }

    public function verifytoken(Request $request)
    {
        $this->validate($request, [
            'token' => 'required|string',
            'email' => 'required|email|string',
        ]);

        $user = \DB::table('password_resets')->where('email', $request->email)->first();

        if($user){
            if($user->token === $request->token){
                return view('PasswordResetForm')->with(['token' => $request->token, 'email' => $request->email]);
            }
            else{
                return response()->json(['status' => 'fail', 'message' => 'Token is invalid']);
            } 
        }
        else{
            return response()->json(['status' => 'fail', 'message' => 'No such user exist']); 
        }
    }

    public function reset(Request $request)
    {
        $this->validate($request, [
            'token' => 'required|string',
            'email' => 'required|email|string|max:255',
            'password' => 'required|confirmed|string|min:6',
        ]);

        $user = User::where('email', $request->email)->first();
        $user -> update(['password' => Hash::make($request->password)]);
            
        \DB::table('password_resets')->where('token', $request->token)->delete();

        return view('PasswordResetSuccessful')->with(['username' => $user->name]);       
    }

    public function redirect()
    {
        return view('PasswordResetSuccessful')->with(['username' => 'Guest']);
    }

    public function test()
    {
        return view('PasswordResetForm')->with(['token' => 'test', 'email' => 'test']);
    }
}
