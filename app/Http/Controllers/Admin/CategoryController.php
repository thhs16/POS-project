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
        return view('admin.category.list');
    }

    // category create page
    public function createPage(){
        return view('admin.category.create');
    }

    // category create
    public function create(Request $request){
        // dd($request->all());

        $validator = $request->validate([
            'category' => 'required'
        ],[
            'category.required' => 'This name is required to be filled out.'
        ]);

        Category::create([
            'name' => $request->category,
        ]);

        // return back()->with(['success' => 'insert success']);
        Alert::success('Success Title', 'Success Message');

        return back();
    }
}
