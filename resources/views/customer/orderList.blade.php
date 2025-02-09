@extends('customer.layouts.master')

@section('content')
    <!-- Modal Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center">
                    <div class="input-group w-75 mx-auto d-flex">
                        <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                        <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Search End -->


    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Order List</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">OrderList</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Cart Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">

            <div class="table-responsive">
                <table class="table" id="dataTable">
                    <thead>
                      <tr>
                        <th scope="col">Order Code</th>
                        <th scope="col">Created at</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Order Status</th>
                        {{-- <th scope="col">Total</th>
                        <th scope="col">Handle</th> --}}
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($order_detail as $item)
                        <tr>
                            <td scope="col">{{ $item->order_code}}</td>
                            <td scope="col">{{ $item->created_at}}</td>
                            <td scope="col">{{ $item->total_price}}</td>
                            <td scope="col">
                                {{-- {{ $item->status}} --}}
                                @if( $item->status == 0)
                                    <button type="button" class="btn btn-secondary text-white">Pending</button>
                                @elseif( $item->status == 1)
                                    <button type="button" class="btn btn-primary text-white">Delivered</button>
                                @elseif( $item->status == 2)
                                    <button type="button" class="btn btn-danger text-white">Rejected</button>
                                @endif
                            </td>
                            {{-- <td scope="col">Total</td>
                            <td scope="col">Handle</td> --}}
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <!-- Cart Page End -->
@endsection

@section('JqContent')
    <script>
// If one error, the whole script will not work.
        $(document).ready(function(){


            // when plus btn is clicked
            $('.btn-plus').click(function(){
                $parentNode = $(this).parents('tr');

                $price = $parentNode.find('#price').text().replace(' $','');
                $qty = $parentNode.find('#qty').val();

                $parentNode.find('#eachTotal').html($price*$qty + '$' )

                finalCalculation();

            })

            // when minus btn is clicked
            $('.btn-minus').click(function(){
                $parentNode = $(this).parents('tr');

                $price = $parentNode.find('#price').text().replace(' $','');
                $qty = $parentNode.find('#qty').val();

                $parentNode.find('#eachTotal').html($price*$qty + '$' )

                finalCalculation();

            })

            function finalCalculation(){
                $sumPrice = 0;


                $("#dataTable tbody tr").each(function ( item , row){
                    $sumPrice += Number( $(row).find('#eachTotal').text().replace('$', '') );
                })

                console.log($sumPrice);

                $('#subTotal').html('$'+ $sumPrice);

                $('#total').html(`$${$sumPrice+3}`);
            }

            $('.btnRemove').click(function(){
                $parentNode = $(this).parents('tr');
                $cartId = $parentNode.find('#cartId').val();

                console.log($cartId);

                $deleteData = {
                    'cartId' : $cartId
                };

                $.ajax({
                    type : 'get',
                    url: 'removeCart',
                    data : $deleteData,
                    dataType : 'json',
                    success : function(response){
                        // console.log(response.message);
                        if(response.message == 'success'){
                            location.reload();
                        }
                    }
                })


            })

            $('#checkout').click(function(){
                $userId = $('#userId').val() ;

                $orderList = [];

                $orderCode = Math.floor(Math.random() * 1000000);

                // $totalPrice = $('#total').text().replace('$','');


                $("#dataTable tbody tr").each(function ( item , row){

                    $productId = $(row).find('#productId').val() *1;
                    $qty = $(row).find('#qty').val() *1
                    $totalPrice = $(row).find('#eachTotal').text().replace('$','') *1;

                    console.log($productId);
                    $orderList.push({
                        'userId' : $userId,
                        'productId' :$productId,
                        'orderCode' : 'POS' + $orderCode,
                        'totalPrice' : $totalPrice,
                        'qty' : $qty
                    })

                })

                console.log($orderList);
                $.ajax({
                    type : 'get',
                    url : 'order',
                    data : Object.assign({},$orderList),
                    datatype : 'json',
                    success : function(response){
                        if(response.message == 'success'){
                            location.href = 'shop';
                            console.log('success');
                        }
                        // console.log(response);
                    }
                })

                // console.log('sending success');



            })

        })
    </script>
@endsection
