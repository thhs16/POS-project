<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminDashboardController;

class AdminDashboardController extends Controller
{
    // direct admin page
    public function index(){
        return view('admin/home');
    }
}
