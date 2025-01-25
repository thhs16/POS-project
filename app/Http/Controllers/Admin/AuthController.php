<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //change password
    public function changePg(){
        return view('admin.password.changePassword');
    }

    // change password
    public function change(Request $request){
        $validator = $request->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required',
            'confirmPassword' => 'required|same:newPassword',
        ]);

        $db_hash_Password = User::select('password')->where('id', Auth::user()->id) ->first();
        // dd($db_hash_Password->toArray());

        // Bcrypt error because of the array
        $db_hash_Password = $db_hash_Password['password'];

        $userOldPassword = $request->oldPassword;
        // dd($userOldPassword);

        // dd($userOldPassword == $db_hash_Password);
        // dd(Hash::check($userOldPassword, $db_hash_Password));

        // Hash password = Facades
        if(Hash::check($userOldPassword, $db_hash_Password)){
            $data = [
                'password' => Hash::make($request->newPassword)
            ];

            User::where('id', Auth::user()->id)->update($data);
            return back()->with('message',"Password Updated Successfully");

        }

        return back()->with('Error message',"Old password do not match. Try again!");

    }
}


