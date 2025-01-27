@extends('admin.layouts.master')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-primary">Product Details</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-3">
                        <img class="img-thumbnail" id="output" src="{{ asset('productImages/'.$product_detail->image) }}" width="100%" alt="">

                    </div>

                    <div class="col-9">


                        @csrf
                            {{-- 1st row --}}
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Name</label>
                                        <h3>{{ $product_detail->name }}</h3>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Price</label>
                                        <h4>{{ $product_detail->price }}</h4>
                                    </div>
                                </div>
                            </div>

                            {{-- 2nd row --}}
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Category Name</label>
                                        <h4>{{ $product_detail->category_name }}</h4>

                                    </div>
                                </div>

                                <div class="col">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Count</label>
                                        <h4>{{ $product_detail->count }}</h4>
                                    </div>
                                </div>


                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Description</label>
                                        <h4>{{ $product_detail->description }}</h4>
                                    </div>
                                </div>
                            </div>



                            <a href="{{ route('productList') }}"><input type="button" value="Back" class="btn btn-dark"></a>



                    </div>

                </div>{{-- End of the row --}}
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

@endsection
