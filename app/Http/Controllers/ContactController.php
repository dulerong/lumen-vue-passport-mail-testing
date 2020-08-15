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
        $user = User::where('email', $request->email)->first();
        if($user){ 
            $token = Str::random(32);

            $username = $user->name;

            \DB::table('password_resets')->updateOrInsert(
                ['email' => $user->email],
                ['email' => $user->email, 'token' => $token]
            );

            Mail::to([$user->email])->send(new PasswordResetMailable($token, $username));

            return response()->json(['status' => 'success', 'message' => 'New token issued to user']);
        }
        else{return response()->json(['status' => 'fail', 'message' => 'Email is not registered in database!']);}
    }

    public function verifytoken(Request $request)
    {
        $this->validate($request, [
            'token' => 'required',
            'password_new' => 'required',
            'password_confirm' => 'required'
        ]);

        $password_new = $request->password_new;
        $password_confirm = $request->password_confirm;

        if($password_new !== $password_confirm){ 
            return response()->json(['status' => 'fail', 'message' => 'Different passwords entered']);
        }

        $tokenStored = \DB::table('password_resets')->where('token', $request->token)->first();

        if($tokenStored){ 
            User::where('email', $tokenStored->email)->update(['password' => Hash::make($password_new)]);
            
            \DB::table('password_resets')->where('token', $request->token)->delete();
            
            return response()->json(['status' => 'success', 'message' => 'Token verified, password updated!']); 
        }
        else{ return response()->json(['status' => 'fail', 'message' => 'Token is invalid!']); }


    }
}
