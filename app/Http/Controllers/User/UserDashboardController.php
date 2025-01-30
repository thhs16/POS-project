<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserDashboardController extends Controller
{
    // direct user page
    public function index(){
        $category_list = Category::select('id','name')->get();

        $product_list = Product::select('products.id','products.name','products.price','products.description','products.count','products.image','categories.name as category_name')
                        ->leftJoin('categories', 'products.category_id','categories.id')
                        ->get();

        // dd($product_list->toArray());
        return view('customer/home', compact('category_list','product_list'));
    }
}
