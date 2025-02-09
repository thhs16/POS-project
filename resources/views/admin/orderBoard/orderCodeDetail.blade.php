@extends('admin.layouts.master')

@section('content')


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <a href="{{route('orderBoardList')}}">Back</a>
        {{-- DataTable --}}
        <div class="row">
            <div class="col">
                <table class="table table-bordered">

                    <thead>
                        <th>
                            Name
                        </th>
                        <th>
                            Date
                        </th>
                        <th>
                            Order Code
                        </th>
                        <th>
                            Total Price
                        </th>
                    </thead>
                    <tr>
                        <td>
                            {{$order_Code_Detail[0]->user_name}}
                        </td>
                        <td>
                            {{$order_Code_Detail[0]->created_at}}
                        </td>
                        <td>
                            {{$order_Code_Detail[0]->order_code}}
                        </td>
                        <td>
                            {{$total_price}}
                            <small class="text-danger"> *Included the shipping fees</small>
                        </td>
                    </tr>

                </table>
            </div>

            <div class="col">
                <table class="table table-bordered">

                    <thead>
                        <th>
                            Phone
                        </th>
                        <th>
                            Payment Method
                        </th>
                        <th>
                            Pay Slip Image
                        </th>
                    </thead>
                    <tr>
                        <td>
                            {{$pay_Slip_history_detail->phone}}
                        </td>
                        <td>
                            {{$pay_Slip_history_detail->payment_name}}
                        </td>
                        <td>
                            {{-- {{$pay_Slip_history_detail->payslip_image}} --}}
                            <img src="{{asset('paySlipRecords/'.$pay_Slip_history_detail->payslip_image)}}" class=" img-thumbnail" width="150px" alt="">
                        </td>

                    </tr>

                </table>
        </div>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-primary">Order Code Detail</h6>
                    </div>

                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Count</th>
                                <th>Product Price</th>
                                <th>Total Price</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $order_Code_Detail as $item )
                            <tr>
                                <td>
                                    <img src="{{asset('productImages/'.$item->product_image)}}" width="100px" alt="">
                                </td>
                                <td>{{ $item->product_name}}</td>
                                <td>{{ $item->count}}</td>
                                <td>{{ $item->product_price}}</td>
                                <td>{{ $item->total_price}}</td>


                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

@endsection
