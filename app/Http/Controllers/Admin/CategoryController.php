<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Admin\CategoryController;

class CategoryController extends Controller
{
    // category list
    public function list(){
        $data = Category::get();
        return view('admin.category.list', compact('data'));
    }

    // category create page
    public function createPage(){
        return view('admin.category.create');
    }

    // category create
    public function create(Request $request){
        // dd($request->all());

        $validator = $request->validate([
            'category' => 'required|unique:categories,name' // has to add DB and its field name
        ],[
            'category.required' => 'ဖြည့်စွက်ရန်လိုအပ်သည်'
        ]);

        // dd('validated');

        Category::create([
            'name' => $request->category
        ]);

        // dd('created DB');

        // return back()->with(['success' => 'insert success']);
        Alert::success('Success Title', 'Success Message'); // The problem is sweet alert not showing

        // dd('Alert');

        return back();
    }
}
