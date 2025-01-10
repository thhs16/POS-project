<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
    public function create(){
        return view('');
    }
}
