<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class UserDashboardController extends Controller
{
    // direct user page
    public function index(){
        $category_list = Category::select('id','name')->get();

        $product_list = Product::select('products.id','products.name','products.price','products.description','products.count','products.image','categories.name as category_name')
                        ->leftJoin('categories', 'products.category_id','categories.id')
                        ->get();


        return view('customer/home', compact('category_list','product_list'));
    }


    public function shop($category_id = null){

        // dd(request('searchKey'));
        $category_list = Category::select('id','name')->get();
        $product_list = $this->productDB($category_id, request('searchKey') );


        return view('customer/shop', compact('category_list','product_list'));
    }


    public function shopDetail($product_id){
        $product_detail = Product::where('products.id', $product_id)
                                ->select('products.id','products.name','products.price','products.description','products.count','products.image','categories.name as category_name')
                                ->leftJoin('categories', 'products.category_id','categories.id')
                                ->first();
        return view('customer.shop_detail', compact('product_detail'));
    }

    public function createComment(Request $request){

        $validation = $request->validate([
            'message' => 'required'
        ]);
    }


    private function productDB($category_id, $searchKey){

        $product_list = Product::when($searchKey, function($query, $searchKey){

            // Error : undefined $searchKey (it is because $searchKey is declared outside the function.)
            // Has to use table name like products and categories after where or whereAny.
            $query->whereAny(['products.name', 'categories.name'],'like','%'.$searchKey.'%');
        })
                            ->select('products.id','products.name','products.price','products.description','products.count','products.image','categories.name as category_name')
                            ->leftJoin('categories', 'products.category_id','categories.id');

        if( $category_id != null){

            // 'where' query builder should be after leftJoin (but it can come first in shopDetail Method)
            $product_list = $product_list->where('categories.id', $category_id )->paginate(2);
        }else{

            $product_list = $product_list->paginate(2);
        }

        // foreach($product_list as $item){
        //     dd($item->name);
        // }

        return $product_list;
    }
}
