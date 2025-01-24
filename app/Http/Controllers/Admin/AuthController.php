<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //change password
    public function change(){
        return view('admin.password.changePassword');
    }
}


