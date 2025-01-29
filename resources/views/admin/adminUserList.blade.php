@extends('admin.layouts.master')
@if(session('message'))
    <h6 id="sessionMessage" class="alert alert-success">
        {{ session('message') }}
    </h6>
@endif

@if(session('Error messag'))
    <h6 id="sessionMessage" class="alert alert-danger">
        {{ session('Error messag') }}
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
                                <h6 class="m-0 font-weight-bold text-primary">

                                    <form action="{{ route('productList') }}">

                                        <div class="input-group mb-3">
                                            <input type="text" name="searchKey" class="form-control" value="{{ request('searchKey') }}" placeholder="Product's Name" aria-label="Recipient's username" aria-describedby="basic-addon2">

                                            <div class="input-group-append">
                                              <button class="btn btn-outline-secondary" type="submit">
                                                Search <i class="fa-solid fa-magnifying-glass"></i>
                                              </button>
                                            </div>

                                          </div>
                                    </form>

                                </h6>
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
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($admin_list as $item)
                                        <tr>
                                            {{-- first data --}}
                                            <td @if ($item->role == 'superAdmin') class="text-danger" @endif>
                                                {{ $item->name }}{{ $item->nickname }}
                                            </td>

                                            {{-- second data --}}
                                            <td>{{ $item->email }}hello</td>

                                            {{-- third data --}}
                                            <td>
                                            @if ($item->phone != null)
                                                {{ $item->phone }}
                                            @else
                                                -
                                            @endif</td>

                                            {{-- fouth data --}}
                                            <td>
                                                @if ($item->address != null)
                                                {{ $item->address }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            @if (auth()->user()->role == 'superAdmin')
                                                {{-- fifth data --}}
                                                <td>

                                                    <a href='{{ route('deleteAdmin', $item->id )}}' class=" btn btn-outline-danger" href=""><i class="fa-solid fa-trash"></i></a>
                                                </td>
                                            @endif


                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>

                            {{-- pagination --}}
                            {{-- <span class=" d-flex justify-content-end">{{ $productData->links() }}</span> --}}
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

@endsection
