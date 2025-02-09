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

            <div class="row">
                <div class="col-5">
                    <div class="card">
                        <div class="card-body">
                            <h5>Payment Info</h5>
                            @foreach ($payment as $item)
                                <p>{{$item->type}}( name : {{$item->account_name}} )</p>
                                <p>Account : {{$item->account_number}}</p>
                                <hr>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Payment Input Data --}}

                    <div class="col">
                        <form action="{{ route('orderProductHistory') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                        <div class="row mb-4">
                            {{-- 1 --}}

                            <div class="col-6">
                                <input type="text" name="customerName" class=" form-control @error('customerName') is-invalid @enderror" placeholder="Enter your name..." >
                            @error('customerName')
                                <small class=" text-danger" style=" display:inline">{{$message}}</small>
                             @enderror
                            </div>

                            {{-- 2 --}}
                            <div class="col">
                                <input type="text" name="customerPhone" class=" form-control @error('customerPhone') is-invalid @enderror" placeholder="09xxxxxxxxx" >
                            @error('customerPhone')
                                <small class=" text-danger">{{$message}}</small>
                             @enderror
                            </div>
                        </div>
                        {{-- 3 --}}
                        <div class="row mb-4" >

                                <select name="paymentMethod" id="type" class="  form-control col @error('paymentMethod') is-invalid @enderror">
                                    <option value="">Select Payment Type...</option>
                                    @foreach ($payment as $item)
                                        <option value="{{$item->id}}" class=" form-control">
                                            {{$item->type}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('paymentMethod')
                                    <small class=" text-danger">{{$message}}</small>
                                @enderror
                        </div>

                        {{-- 4 --}}
                        <div class="row mb-4" >
                            <input type="file" name="payslipImage" id="" class=" form-control @error('payslipImage') is-invalid @enderror">
                            @error('payslipImage')
                                <small class=" text-danger">{{$message}}</small>
                             @enderror
                        </div>


                        {{-- 5 --}}
                        <div class="row mb-4">
                            <input type="text" name="orderCode" class=" form-control @error('orderCode') is-invalid @enderror" value="{{$order_list_payment[0]['order_code']}}" readonly>
                            @error('orderCode')
                                <small class=" text-danger">{{$message}}</small>
                             @enderror
                        </div>


                        {{-- 6 --}}
                        <div class="row mb-4" >
                            <input type="text" name="orderAmount" class=" form-control @error('orderAmount') is-invalid @enderror" value="{{$total_price_payment}}" readonly>
                            @error('orderAmount')
                                <small class=" text-danger">{{$message}}</small>
                             @enderror
                        </div>


                        <div class="row mb-4" >
                            <button type="submit" id="checkout" class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase " type="button">Finish Order</button>
                        </div>
                    </form>
                    </div>

            </div>
            </div>

        </div>
    </div>
    <!-- Cart Page End -->
@endsection
