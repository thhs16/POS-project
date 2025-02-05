<?php

namespace App\Http\Controllers\User;

use App\Models\cart;
use App\Models\order;
use App\Models\rating;
use App\Models\Comment;
use App\Models\payment;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
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

        $rating = Comment::select('comments.message','users.name','users.profile')
                    ->leftJoin('users', 'users.id','comments.user_id')
                    ->get();

        // dd($rating->toArray());


        return view('customer/home', compact('category_list','product_list', 'rating'));
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

        $comment_detail = Comment::where('comments.product_id', $product_id)
                                    ->select('comments.message','comments.created_at', 'users.name as user_name', 'users.profile as user_image')
                                    ->leftJoin('users', 'comments.user_id' , 'users.id')
                                    ->get();

        $rating_count_avg = rating::where('product_id', $product_id)->avg('count');

        $rating_ids = rating::where('product_id', $product_id)->select('id');

        $rating_ids = $rating_ids->count();


        // request('productId') does not exist because it is for $this->productRating();
        $user_rating = rating::where('user_id', auth()->user()->id)
        ->where('product_id', $product_id)
        ->select('count')->first();

        // $user_rating = $user_rating->count;

        // dd($user_rating);

        $product_list_cate = Product::where('categories.name',$product_detail->category_name)
                        ->select('products.id','products.name','products.price','products.description','products.count','products.image','categories.name as category_name')
                        ->leftJoin('categories', 'products.category_id','categories.id')
                        ->get();

        return view('customer.shop_detail', compact('product_detail', 'comment_detail', 'rating_count_avg', 'rating_ids','user_rating', 'product_list_cate'));
    }

    public function createComment(Request $request){

        $validation = $request->validate([
            'message' => 'required'
        ]);

        $data = [
            'user_id' => $request->userId,
            'product_id' => $request->productId,
            'message' => $request->message
        ];

        Comment::create($data);

        return back();
    }

    public function productRating(){

        $rating_status = rating::where('user_id', auth()->user()->id)
                        ->where('product_id', request('productId'))
                        ->select('id')->first();


        $data = [
            'product_id' => request('productId'),
            'user_id' => request('userId'),
            'count' => request('productRating')
        ];

        // // setting default rating value
        // if(request('product_rating') == null){
        //     $data['count'] = '5';
        // }else{
        //     $data['count'] = request('productRating');
        // }

        // update or create
        if($rating_status == null){

            rating::create($data);
        }else{
            rating::where('id', $rating_status->id)->update([
                'count' => request('productRating')
            ]);
        }







        return back()->with('message', 'Rating Success!');

    }

    public function cart(){
        // product name, price, image
        // cart - quantity,
        // user - id

        $cart_detail = cart::where('carts.user_id', auth()->user()->id)
                        ->select('carts.id','carts.qty', 'products.name','products.price','products.image')
                        ->leftJoin('products', 'products.id', 'carts.product_id')
                        ->get();

        // dd($cart_detail->toArray());

        $payment_methods = payment::select('id','type')->get();

        // dd($payment_methods->toArray());

        return view('customer.cart', compact('cart_detail','payment_methods'));
    }

    // cart system
    public function addToCart(){
        // dd(request('userId'));
        // dd(request('productId'));
        // dd(request('qty'));

        cart::create([
            'user_id' => request('userId'),
            'product_id' => request('productId'),
            'qty' => request('qty')
        ]);


        return to_route('customerShop');
    }

    // remove cart data
    public function removeCart(Request $request){

        logger($request->all());


        cart::where('id',$request->cartId)->delete();

        $cart_last_detail = cart::where('carts.user_id', auth()->user()->id)
                        ->select('carts.id','carts.qty', 'products.name','products.price','products.image')
                        ->leftJoin('products', 'products.id', 'carts.product_id')
                        ->get();

        $serverResponse = [
            'data' => $cart_last_detail ,
            'message' => 'success'
        ];

        return response()->json($serverResponse, 200);
    }

    // order
    public function order(Request $request){
        // logger($request->all());

        foreach($request->all() as $item){
            // logger($item);
            order::create([
                'product_id' => $item['productId'],
                'user_id' => $item['userId'],
                'status' => 0,
                'order_code' => $item['orderCode'],
                'count' => $item['qty'],
                'total_price' => $item['totalPrice']
            ]);

            cart::where('user_id', $item['userId'])->where('product_id', $item['productId'])->delete();
        }

        return response()->json([
            'message' => 'success',
            'status' => 200
        ], 200);
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
