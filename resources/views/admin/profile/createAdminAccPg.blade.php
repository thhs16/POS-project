@extends('admin.layouts.master')

@if(session('message'))
    <h6 id="sessionMessage" class="alert alert-success">
        {{ session('message') }}
    </h6>
@endif

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">


        <!-- DataTales Example -->
        <div class="card shadow mb-4 col-5">
            <div class="card-header py-3">
                <div class="">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-primary">Add New Admin Account</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">

            <form action="{{ route('createAdminAcc') }}" method="post">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="adminName" value="{{ old('adminName') }}" class="form-control @error('adminName') is-invalid @enderror" placeholder="Drinks...">
                    @error('adminName')
                        <small class=" invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="text" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Drinks...">
                    @error('email')
                        <small class=" invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>

                {{-- should not be the name password --}}
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="pw" value="{{ old('pw') }}" class="form-control @error('pw') is-invalid @enderror" placeholder="Drinks...">
                    @error('pw')
                        <small class=" invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="confirmPassword" value="{{ old('confirmPassword') }}" class="form-control @error('confirmPassword') is-invalid @enderror" placeholder="Drinks...">
                    @error('confirmPassword')
                        <small class=" invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>

                <input type="submit" value="Create" class="btn btn-primary">
            </form>

            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

@endsection
