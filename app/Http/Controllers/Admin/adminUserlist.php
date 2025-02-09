<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class adminUserlist extends Controller
{
    // admin
    public function adminUserList(){

        // Note | superAdmin account shows even the keyword is wrong in searching.

        // dd(request('keyword'));
        $admin_list = User::when(request('keyword'),function($query){
            $query->whereAny(['name','email','phone','address'],'like','%'.request('keyword').'%');
        })
        ->select('id','name','email','nickname','phone','address','role')->where('role','admin')->orWhere('role','superAdmin')->paginate(2);

        $user_count = User::select('id')->where('role','user')->count();
        // dd($user_count);
        return view('admin.adminUserList', compact('admin_list','user_count'));


    }

    public function deleteAdmin($id){
        User::where('id',$id)->delete();

        return back()->with('Error message', 'The account is deleted successfully');
    }

    public function changeToAdminRole($id){

        User::where('id', $id)
                ->update(['role'=>'admin']);

        return back()->with('message', 'The account is changed into the admin role successfully.');
    }



    // user
    public function userList(){
        $user_list = User::when(request('keyword'),function($query){
            $query->whereAny(['name','email','phone','address'],'like','%'.request('keyword').'%');
        })
        ->select('id','name','email','nickname','phone','address','role')->where('role','user')->paginate(2);

        $admin_count = User::select('id')->where('role','admin')->orWhere('role','superAdmin')->count();

        return view('customer.userList', compact('user_list','admin_count'));
    }

    public function deleteUser(){
        User::where('id',$id)->delete();

        return back()->with('Error message', 'The account is deleted successfully');
    }

    // account profile
    public function accountProfile($id){
        $account = User::where('id',$id)->first();
        // dd($account);
        return view('admin.accountProfile', compact('account'));
    }
}
