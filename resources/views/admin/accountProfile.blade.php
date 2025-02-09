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
                        <h6 class="m-0 font-weight-bold text-primary">Account Profile</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">


                <div class="row">
                    <div class="col-3">


                        <img class="img-thumbnail" id="output" src="{{ auth()->user()->profile == null ? asset('admin/img/undraw_profile.svg') : asset('profileImages/'. $account->profile) }}" width="100%" alt="">
                    </div>

                    <div class="col-9">


                        @csrf
                            {{-- 1st row --}}
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Name :</label>
                                        <span>{{$account->name}}</span>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Email :</label>
                                        <span>{{$account->email}}</span>
                                    </div>
                                </div>
                            </div>

                            {{-- 2nd row --}}
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Phone :</label>
                                        <span>{{$account->phone == null ? 'none' : $account->phone}}</span>

                                    </div>
                                </div>

                                <div class="col">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Address :</label>
                                        <span>{{$account->address == null ? 'none' : $account->address}}</span>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Role :</label>
                                        <span>{{$account->role}}</span>
                                    </div>
                                </div>


                            </div>



                    </div>

                </div>{{-- End of the row --}}

            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

@endsection
