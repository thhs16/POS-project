<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    // list
    public function list(){
        return view('admin.product.list');
    }

    // create
    public function create(){
        $categoryData = Category::get();
        // dd($categoryData->toArray());
        return view('admin.product.create', compact('categoryData'));
    }

    // product create
    public function createCon(Request $request){
        // dd($request->all());
        $this->validationProduct($request);


    }

    // product creation validation
    private function validationProduct($request){

        $rules = [
            'name' => 'required| unique:products,name',
            'price' => 'required',
            'description' => 'required',
            'categoryId' => 'required',
            'count' => 'required|numeric|digits_between:1,100',
            'image' => 'required|mimes:jpg,jpeg,png|file',
        ];

        $message = [
            'categoryId' => 'The category name field is required.'
        ];

        $validator = $request->validate($rules, $message);


    }
}
