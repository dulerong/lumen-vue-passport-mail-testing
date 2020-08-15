<?php

namespace App\Http\Controllers;

use App\Traits\SendsPasswordResetEmails;

// Laravel standard password reset, did not use

class RequestPasswordController extends Controller
{
  use SendsPasswordResetEmails;
  
  public function __construct()
  {
      $this->broker = 'users';
  }
}