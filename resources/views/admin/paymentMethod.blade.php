@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">


        <!-- DataTales Example -->
        <div class="card shadow mb-4 col-5">
            <div class="card-header py-3">
                <div class="">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-primary">Change Password</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">

            <form action="{{ route('passwordChange') }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Old password</label>
                    <input type="password" name="oldPassword" value="{{ old('oldPassword') }}" class="form-control @error('oldPassword') is-invalid @enderror" id="exampleFormControlInput1" placeholder="Drinks...">
                    @error('oldPassword')
                        <small class=" invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">New password</label>
                    <input type="password" name="newPassword" value="{{ old('newPassword') }}" class="form-control @error('newPassword') is-invalid @enderror" id="exampleFormControlInput1" placeholder="Drinks...">
                    @error('newPassword')
                        <small class=" invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Confirm password</label>
                    <input type="password" name="confirmPassword" value="{{ old('confirmPassword') }}" class="form-control @error('confirmPassword') is-invalid @enderror" id="exampleFormControlInput1" placeholder="Drinks...">
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
