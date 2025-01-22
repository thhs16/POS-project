<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    // list
    public function list(){
        $productData = Product::orderBy('id', 'DESC')->paginate(3);
        // dd( $productData->toArray() );
        return view('admin.product.list', compact('productData'));
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

        $data = $this->requestCategoryData($request);

        if($request->hasFile('image')){

            // unique name image
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();

            // move into public file
            $request->file('image')->move(public_path().'/productImages/',$fileName);

            // move image name(unique) into db
            $data['image'] = $fileName;
        }

        // Send data to db
        Product::create($data);

        Alert::success('Insert Success', 'Category is inserted successfully.');

        return to_route('productList');


    }

    // product creation validation
    private function validationProduct($request){

        $rules = [
            'name' => 'required| unique:products,name',
            'price' => 'required| numeric',
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

    // delete
    public function productDelete($id){
        Product::where('id', $id)->delete();
        return back()->with('message',"Deleted Successfully");
    }

    // product details
    public function productDetails($id){
        $product_detail = Product::select('products.id','products.name','products.price','products.description','products.category_id','products.count','products.image', 'categories.name as category_name')
                                    ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
                                    ->where('products.id', $id)->first();
        // dd($product_detail->toArray());
        return view('admin.product.details', compact('product_detail'));

    }


    // product edit
    public function productEdit($id){
        $product_detail = Product::select('products.id','products.name','products.price','products.description','products.category_id','products.count','products.image', 'categories.name as category_name')
                                    ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
                                    ->where('products.id', $id)->first();

        $category_detail = Product::get();
        return view('admin.product.edit', compact('product_detail','category_detail'));

    }

    // product update
    public function productUpdate(Request $request){
        dd($request->all());
    }

    private function requestCategoryData($request){
        return [
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $request->categoryId,
            'count' => $request->count,
            'image' => '',
        ];
    }
}
