<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class profileController extends Controller
{
    // admin details UI
    public function profileDetails(){
        return view('admin.profile.details');
    }

    // update
    public function profileDetailsUpdate(Request $request){

        if (Auth::user()->providerName != 'simple'){
            $valitator = $request->validate([
                'image' => 'mimes:jpg,jpeg,png|file',
            ]);
        }else{
            $valitator = $request->validate([
                'name' => 'required',
                // 'phone' => 'required',
                // 'address' => 'required',
                'image' => 'mimes:jpg,jpeg,png|file',
            ]);
        }



        // [0 => $data , 1 => $condition]
        $returnData = $this->validationCheckAdminDetails($request);

        // the value has to be the same

        // dd($returnData[1]);
        // dd($returnData);
        if( $returnData[1] ){
            // DB
            // github can update its name but google cannot.
            User::where('id', Auth::user()->id)->update($returnData[0]);
            return back()->with('message',"Updated Successfully");
        }



        return back()->with('Error message',"No changes");
    }

    public function createAdminAccPg(){
        return view('admin.profile.createAdminAccPg');
    }

    public function createAdminAcc(Request $request){
        // validation
        $validator = $request->validate([
                'adminName' => 'required|string|max:255', // Required, must be a string, and up to 255 characters
                'email' => 'required|email|max:255|unique:users,email', // Required, valid email, max 255 characters, must be unique in the 'users' table
                'pw' => [
                    'required',
                    'string',
                    'min:8', // At least 8 characters
                    'regex:/[a-z]/', // At least one lowercase letter
                    'regex:/[A-Z]/', // At least one uppercase letter
                    'regex:/[0-9]/', // At least one digit
                    'regex:/[@$!%*?&#]/' // At least one special character
                ],
                'confirmPassword' => 'required|same:pw', // Must match the 'password' field
            ]);

        $data = [
            'name' => $request->adminName,
            'password' => Hash::make($request->pw),
            'email' => $request->email,
            'role' => 'admin'
        ];

        User::create($data);
        // dd('hello');
        return back()->with('message',"Created the Admin Account Successfully");

    }

    private function validationCheckAdminDetails($request){

            $data = [];
            $user = Auth::user();

            if(Auth::user()->providerName == 'simple'){

                $data['name'] = $request->name;
                // *one of the above has to be different values from db data
                $condition = $request->name != Auth::user()->name | $request->phone != $user->phone | $request->address != $user->address | $request->hasFile('image') ;
            }else{

                $data['nickname'] = $request->name;
                // *one of the above has to be different values from db data
                $condition = $request->name != Auth::user()->nickname | $request->phone != $user->phone | $request->address != $user->address | $request->hasFile('image') ;
            }

            $data['phone'] = $request->phone;
            $data['address'] = $request->address;

            // image
            if($request->hasFile('image')){

                // a new | does not have to delete the image
                // an old | have to delete
                // how we can know whether it is new or old => with src image??? Sayar Advice??? old image has to be null??? The thing is to know what is the null.

                if(Auth::user()->profile != null){
                    // delete old image
                    unlink( public_path('profileImages/'.Auth::user()->image) );
                }

                // upload new image
                $fileName = uniqid() . $request->file('image')->getClientOriginalName();
                $request->file('image')->move(public_path().'/profileImages/',$fileName);
                $data['profile'] = $fileName;
            }

            // dd($data);
            // dd($condition);

            return [$data,$condition];



}

}
