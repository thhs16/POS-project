@extends('admin.layouts.master')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-primary">Admin Profile</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('profileDetailsUpdate') }}" method="post" enctype="multipart/form-data">
                    @csrf
                <div class="row">
                    <div class="col-3">
                        <img class="img-thumbnail" id="output" src="{{ asset('admin/img/undraw_profile.svg') }}" width="100%" alt="">
                        <input type="file"  name="image" class="form-control @error('image')  is-invalid @enderror" onchange="loadFile(event)">

                            @error('image')
                                <small class=" invalid-feedback">{{ $message }}</small>
                            @enderror
                    </div>

                    <div class="col-9">


                        @csrf
                            {{-- 1st row --}}
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control @error('name')  is-invalid @enderror" id="" value="{{ auth()->user()->name }}{{auth()->user()->nickname}}" placeholder="Drinks...">
                                            @error('name')
                                                <small class=" invalid-feedback">{{ $message }}</small>
                                            @enderror
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Email</label>
                                        <input disabled type="text" name="price" class="form-control @error('price')  is-invalid @enderror" id="" value="{{ auth()->user()->email }}" placeholder="Drinks...">
                                            @error('price')
                                                <small class=" invalid-feedback">{{ $message }}</small>
                                            @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- 2nd row --}}
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Phone</label>

                                        <input type="text" name="price" class="form-control @error('price')  is-invalid @enderror" id="" value="{{ auth()->user()->phone }}" placeholder="09XXXXXXXXX">
                                            @error('price')
                                                <small class=" invalid-feedback">{{ $message }}</small>
                                            @enderror
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Address</label>
                                        <input type="text" name="count" class="form-control @error('count')  is-invalid @enderror" id="" placeholder="Drinks..." value="{{ auth()->user()->address }}">
                                            @error('count')
                                                <small class=" invalid-feedback">{{ $message }}</small>
                                            @enderror
                                    </div>
                                </div>


                            </div>

                            <a href="{{ route('passwordChangePg') }}">Change Password</a> <br><br>



                            <input type="submit" value="Update" class="btn btn-primary">



                    </div>

                </div>{{-- End of the row --}}
            </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

@endsection
