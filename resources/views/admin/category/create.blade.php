@extends('admin.layouts.master')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">


        <!-- DataTales Example -->
        <div class="card shadow mb-4 col-5">
            <div class="card-header py-3">
                <div class="">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-primary">Add Category Page</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">

            <form action="{{ route('categoryCreate') }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Category Name</label>
                    <input type="text" name="category" value="{{ old('category') }}" class="form-control" id="exampleFormControlInput1" placeholder="Drinks...">
                </div>

                <input type="submit" value="Create" class="btn btn-primary">
            </form>

            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

@endsection
