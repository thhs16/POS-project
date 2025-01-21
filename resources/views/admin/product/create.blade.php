@extends('admin.layouts.master')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-primary">Add Product Page</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('productCreateCon')}}" method="post" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-3">
                        <img class="img-thumbnail" id="output" src="https://lh4.googleusercontent.com/proxy/EWm9FVpPqF7N5rcraSRF-UMDuwBzfkA2tYNH73WwfdaqqrhD7V-TQL22-XP7fOgbjSp4X836b8_TVTYw1JN7bSJuUHbgtMURdiA2n-lyFKYnnpRzFzCJ72kCEw" width="100%" alt="">
                        <input type="file"  name="image" class="form-control @error('')  is-invalid @enderror" onchange="loadFile(event)" {{ old('count')}}>

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
                                        <input type="text" name="name" class="form-control @error('name')  is-invalid @enderror" id="" placeholder="Drinks..." {{ old('name')}}>
                                            @error('name')
                                                <small class=" invalid-feedback">{{ $message }}</small>
                                            @enderror
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Price</label>
                                        <input type="text" name="price" class="form-control @error('price')  is-invalid @enderror" id="" placeholder="Drinks..." {{ old('price')}}>
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
                                        <label for="" class="form-label">Category Name</label>

                                        <select name="categoryId" class="form-control @error('categoryId')  is-invalid @enderror" id="" >

                                            <option value="">Choose a category</option>
                                            @foreach ($categoryData as $c )
                                                <option value="{{$c->id}}" @if (old('categoryId') == $c->item)
                                                    selected
                                                @endif>{{ $c->name }}</option>
                                            @endforeach

                                        </select>
                                            @error('categoryId')
                                                <small class=" invalid-feedback">{{ $message }}</small>
                                            @enderror
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Count</label>
                                        <input type="text" name="count" class="form-control @error('count')  is-invalid @enderror" id="" placeholder="Drinks..." value="{{ old('count')}}">
                                            @error('count')
                                                <small class=" invalid-feedback">{{ $message }}</small>
                                            @enderror
                                    </div>
                                </div>


                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Description</label>
                                        <textarea name="description" class="form-control @error('description')  is-invalid @enderror" id="" cols="30" rows="10">{{ old('description')}}</textarea>
                                            @error('description')
                                                <small class=" invalid-feedback">{{ $message }}</small>
                                            @enderror
                                    </div>
                                </div>
                            </div>



                            <input type="submit" value="Create" class="btn btn-primary">



                    </div>

                </div>{{-- End of the row --}}
            </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

@endsection
