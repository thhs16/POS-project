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
        <h1 class="text-center text-white display-6">Cart</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Cart</li>
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
                        <th scope="col">Products</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                        <th scope="col">Handle</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                                $totalPrice = 0;
                            @endphp
                        <input type="hidden" id="userId" value="{{auth()->user()->id}}">
                        @foreach ($cart_detail as $item)
                        <tr>

                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <img src="{{asset('productImages/'.$item->image)}}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                    </div>

                                    {{-- @if ($item->profile == null)
                                        <div class="d-flex align-items-center">
                                            <img src="{{asset('admin/img/undraw_profile.svg')}}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                        </div>
                                    @else
                                        <div class="d-flex align-items-center">
                                            <img src="{{asset('profileImages/'.$item->profile)}}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                        </div>
                                    @endif --}}
                                </th>
                                <td>
                                    <p class="mb-0 mt-4">{{$item->name}}</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4" id="price">{{$item->price}} $</p>
                                </td>
                                <td>
                                    <div class="input-group quantity mt-4" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                                            <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm text-center border-0" id="qty" value="{{$item->qty}}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4" id="eachTotal">{{$item->price * $item->qty}} $</p>
                                    @php
                                        $totalPrice += $item->price * $item->qty;
                                    @endphp
                                </td>
                                <td>
                                    <input type="hidden" name="cartId" id="cartId" value="{{$item->id}}">
                                    <input type="hidden" name="productId" id="productId" value="{{$item->product_id}}">

                                    <button class="btn btn-md rounded-circle bg-light border mt-4" >
                                        <i class="fa fa-times text-danger" id="btnRemove"></i>
                                    </button>
                                </td>
                            @endforeach

                        </tr>

                    </tbody>
                </table>
            </div>
            <div class="mt-5">
                <input type="text" class="border-0 border-bottom rounded me-5 py-3 mb-4" placeholder="Coupon Code">
                <button class="btn border-secondary rounded-pill px-4 py-3 text-primary" type="button">Apply Coupon</button>
            </div>
            <div class="row g-4 justify-content-end">
                <div class="col-8"></div>
                <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                    <div class="bg-light rounded">
                        <div class="p-4">
                            <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                            <div class="d-flex justify-content-between mb-4">
                                <h5 class="mb-0 me-4" >Subtotal:</h5>
                                <p class="mb-0" id="subTotal">${{$totalPrice}}</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="mb-0 me-4">Shipping</h5>
                                <div class="">
                                    <p class="mb-0">Flat rate: $3.00</p>
                                </div>
                            </div>
                            <p class="mb-0 text-end">Shipping to Ukraine.</p>
                        </div>
                        <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                            <h5 class="mb-0 ps-4 me-4">Total</h5>
                            <p class="mb-0 pe-4" id="total">${{$totalPrice+3}}</p>
                        </div>
                        <div class="px-4 pb-2">
                            <label for="" class=" form-control">Payment Type :</label>
                            <select name="" id="" class=" form-control">
                                @foreach ($payment_methods as $item)
                                    <option value="{{$item->id}}" class=" form-control">
                                        {{$item->type}}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button id="checkout" class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="button">Proceed Checkout</button>
                    </div>
                </div>
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

            $('#btnRemove').click(function(){
                $parentNode = $(this).parents('tr');
                $cartId = $parentNode.find('#cartId').val();

                // console.log($cartId);

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

                    console.log($qty);
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
