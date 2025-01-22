@extends('admin.layouts.master')
@if(session('message'))
    <h6 class="alert alert-success">
        {{ session('message') }}
    </h6>
@endif

@section('content')



              <!-- Begin Page Content -->
              <div class="container-fluid">


                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="d-flex justify-content-between">
                            <div class="">
                                <h6 class="m-0 font-weight-bold text-primary">Product List</h6>
                            </div>
                            <div class="">
                                <a href=""><i class="fa-solid fa-plus"></i> Add Category</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productData as $pd)
                                        <tr>
                                            <td>{{ $pd->name }}</td>
                                            <td class=" col-2"><img src="{{ asset('productImages/'.$pd->image) }}" class=" img-thumbnail" alt=""></td>
                                            <td>{{ $pd->price }}</td>
                                            <td>{{ $pd->count }}</td>
                                            <td>
                                                <a href="{{ route('productDetails',$pd->id) }}"><i class="fa-solid fa-eye btn btn-primary"></i></a>
                                                <a href="{{ route('productEdit',$pd->id) }}"><i class="fa-solid fa-pen-to-square btn btn-secondary"></i></a>
                                                <a href="{{ route('productDelete',$pd->id) }}"><i class="fa-solid fa-trash btn btn-danger"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                            {{-- pagination --}}
                            <span class=" d-flex justify-content-end">{{ $productData->links() }}</span>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

@endsection
