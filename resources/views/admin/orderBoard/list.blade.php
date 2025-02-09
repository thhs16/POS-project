@extends('admin.layouts.master')

@section('content')


    <!-- Begin Page Content -->
    <div class="container-fluid">


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-primary">Order Board</h6>
                    </div>

                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Order Code</th>
                                <th>Date</th>
                                <th>User's Name</th>
                                <th>Product's Name</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $order_detail as $item )
                            <tr>
                                <td><a href="{{ route('orderCodeDetail', $item->order_code)}}" class="orderCode">{{ $item->order_code}}</a></td>
                                <td>{{ $item->created_at}}</td>
                                <td>{{ $item->user_name}}</td>
                                <td>{{ $item->product_name}}</td>
                                <td>{{ $item->total_price}}</td>
                                <td>
                                    <select name="" class="statusChange">
                                        <option  value="0" @if ($item->status == 0)
                                            selected
                                        @endif>Pending</option>
                                        <option  value="1" @if ($item->status == 1)
                                            selected
                                        @endif>Delivered</option>
                                        <option  value="2" @if ($item->status == 2)
                                            selected
                                        @endif>Rejected</option>
                                    </select>
                                </td>


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

@section('orderListStatus')
    <script>
        $(document).ready(function(){

            $('.statusChange').change(function(){
                $currentStatus = $(this).val();
                $orderCode = $(this).parents('tr').find('.orderCode').html();

                $data = {
                    'status' : $currentStatus ,
                    'orderCode' : $orderCode
                }

                $.ajax({
                    type : 'get',
                    url : 'statusChange',
                    data : $data,
                    datatype : 'json',
                    success : function(response){
                        if(response.message == 'success'){
                            console.log('success');
                        }
                    }
                })
            });
        });
    </script>
@endsection
