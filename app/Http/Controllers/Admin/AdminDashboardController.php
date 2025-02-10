<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminDashboardController;

class AdminDashboardController extends Controller
{
    // direct admin page
    public function index(){
        $total_sale_amount_all_time = order::sum('total_price');

        $user_count = User::where('role','user')->select('id')->count();

        $order_pending = order::where('status', 0)->groupBy('order_code')->get();
        $order_pending = count($order_pending);

        $order_success = order::where('status', 1)->groupBy('order_code')->get();
        $order_success = count($order_success);

        // $revenue_source = order::select('total_price');
        $category = Category::select('id','name')->get();

        // foreach($category as $item){
        //     // revenue_source_laptop
        //     $revenue_source.$item->name = order::where('products.id', $item->id)->select('orders.total_price')->leftJoin('products', 'products.category_id', $item->id)->get();
        //
        // }

        $product = Product::select('id', 'category_id')->get();

        $same_product_from_order = order::select('orders.product_id','products.category_id')
                                    ->leftJoin('products','products.id', 'orders.product_id')
                                    ->groupBy('orders.product_id')
                                    ->get();


        // $total=[];
        $i = 0;
        $mobile_total_price = 0;
        $laptop_total_price = 0;


            // cete = 1
            // array_push([
            //     $category_item->id => ''
            // ]);
            // $i++;

                // dd($same_product_from_order->toArray());
            foreach($same_product_from_order as $same_product_item){

                // foreach($category as $category_item){

                $i++;
                if($same_product_item->category_id == 1){
                    $mobile_total_price += order::where('product_id', $same_product_item->product_id)->sum('total_price');


                    // $i++;
                }else{

                    $laptop_total_price += order::where('product_id', $same_product_item->product_id)->sum('total_price');
                    // $laptop_total_price += $order_total_price;

                    // $i++;
                }


            // }
        }

        // dd($i);
        // dd($laptop_total_price);



        return view('admin/home', compact('total_sale_amount_all_time', 'user_count', 'order_pending', 'order_success', 'category', 'laptop_total_price', 'mobile_total_price'));
    }
}
