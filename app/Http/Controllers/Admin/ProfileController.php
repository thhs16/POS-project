<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
