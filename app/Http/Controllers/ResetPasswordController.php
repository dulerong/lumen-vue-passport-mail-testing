<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Traits\ResetsPasswords;

// Laravel standard password reset, did not use

class ResetPasswordController extends Controller
{
    use ResetsPasswords;
}