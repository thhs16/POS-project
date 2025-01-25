<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class profileController extends Controller
{
    public function profileDetails(){
        return view('admin.profile.details');
    }

    // update
    public function profileDetailsUpdate(Request $request){
        $valitator = $request->validate([
            ''
        ])
    }
}
