<?php

namespace App\Http\Controllers;

use App\Models\order;
use Illuminate\Http\Request;
use App\Models\PaySlipHistory;
use App\Http\Controllers\OrderBoard;

class OrderBoard extends Controller
{
    // list page
    public function list(){

        $order_detail = order::select('orders.*', 'products.name as product_name', 'users.name as user_name')
                        ->leftJoin('products','orders.product_id', 'products.id')
                        ->leftJoin('users', 'orders.user_id', 'users.id')
                        ->groupBy('orders.order_code')
                        ->get();


        return view('admin.orderBoard.list', compact('order_detail'));
    }

    // orderCodeDetail
    public function orderCodeDetail($orderCode){

        $order_Code_Detail = order::select('orders.count', 'orders.total_price','orders.created_at','orders.order_code','products.image as product_image', 'products.name as product_name', 'products.price as product_price', 'users.name as user_name')
        ->leftJoin('products','orders.product_id', 'products.id')
        ->leftJoin('users', 'orders.user_id', 'users.id')
        ->where('orders.order_code', $orderCode)
        ->get();

        // dd($order_Code_Detail[0]->created_at);
        $pay_Slip_history_detail = PaySlipHistory::where('order_code', $orderCode)
                                    ->select('pay_slip_histories.*', 'payments.type as payment_name')
                                    ->leftJoin('payments','payments.id', 'pay_slip_histories.payment_method')
                                    ->first();

        // dd($pay_Slip_history_detail->toArray());

        // this is not total
        $total_price = $order_Code_Detail[0]->total_price * $order_Code_Detail[0]->count;

        return view('admin.orderBoard.orderCodeDetail', compact('order_Code_Detail', 'total_price' , 'pay_Slip_history_detail'));
    }

    public function statusChange(Request $request){

        // logger($request->all());

        order::where('order_code',$request->orderCode)->update([
            'status' => $request->status
        ]);

        return response()->json([
            'message' => 'success',
            'status' => 200
        ], 200);
    }
}
