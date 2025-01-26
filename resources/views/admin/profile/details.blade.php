@extends('admin.layouts.master')

@if(session('Error message'))
    <h6 id="" class="alert alert-danger">
        {{ session('Error message') }}
    </h6>
@endif

@if(session('message'))
    <h6 id="sessionMessage" class="alert alert-success">
        {{ session('message') }}
    </h6>
@endif

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


                        <img class="img-thumbnail" id="output" src="{{ auth()->user()->profile == null ? asset('admin/img/undraw_profile.svg') : asset('profileImages/'. auth()->user()->profile) }}" width="100%" alt="">
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
                                        <input type="text" @if (auth()->user()->providerName != 'simple')
                                            readonly
                                        @endif name="name" class="form-control @error('name')  is-invalid @enderror" id="" value="{{ auth()->user()->name }}{{auth()->user()->nickname}}" placeholder="Drinks...">
                                            @error('name')
                                                <small class=" invalid-feedback">{{ $message }}</small>
                                            @enderror
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Email</label>
                                        <input disabled type="text" name="email" class="form-control @error('email')  is-invalid @enderror" id="" value="{{ auth()->user()->email }}" placeholder="Drinks...">
                                            @error('email')
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

                                        <input type="text" name="phone" class="form-control @error('phone')  is-invalid @enderror" id="" value="{{ auth()->user()->phone }}" placeholder="09XXXXXXXXX">
                                            @error('phone')
                                                <small class=" invalid-feedback">{{ $message }}</small>
                                            @enderror
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Address</label>
                                        <input type="text" name="address" class="form-control @error('address')  is-invalid @enderror" id="" placeholder="Drinks..." value="{{ auth()->user()->address }}">
                                            @error('address')
                                                <small class=" invalid-feedback">{{ $message }}</small>
                                            @enderror
                                    </div>
                                </div>


                            </div>

                            @if ( auth()->user()->providerName == 'simple' )
                                <a href="{{ route('passwordChangePg') }}">Change Password</a> <br><br>
                            @endif


                            <input type="submit" value="Update" class="btn btn-primary">



                    </div>

                </div>{{-- End of the row --}}
            </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

@endsection
