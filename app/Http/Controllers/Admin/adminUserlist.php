<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class adminUserlist extends Controller
{
    public function adminUserList(){
        $admin_list = User::select('id','name','nickname','phone','address','role')->where('role', 'admin')->orWhere('role', 'superAdmin')->get();

        return view('admin.adminUserList', compact('admin_list'));
    }
}
