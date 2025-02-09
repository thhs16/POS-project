<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\order;
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

        foreach($category as $item){
            // revenue_source_laptop
            $revenue_source.$item->name = order::select('orders.total_price')->leftJoin('products', 'products.category_id', $item->id)->sum()
        }
        // dd($order_pending);
        return view('admin/home', compact('total_sale_amount_all_time', 'user_count', 'order_pending', 'order_success'));
    }
}
