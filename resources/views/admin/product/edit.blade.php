@extends('admin.layouts.master')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-primary">Product Edit Page</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('productCreateCon') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="oldImageName" value="{{ $product_detail->image}}">
                    <input type="hidden" name="productId" value="{{ $product_detail->id}}">
                <div class="row">
                    <div class="col-3">
                        <img class="img-thumbnail" id="output" src="{{ asset('productImages/'.$product_detail->image) }}" width="100%" alt="">
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
                                        <input type="text" name="name" class="form-control @error('name')  is-invalid @enderror" id="" value="{{ old('name',$product_detail->name) }}" placeholder="Drinks...">
                                            @error('name')
                                                <small class=" invalid-feedback">{{ $message }}</small>
                                            @enderror
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Price</label>
                                        <input type="text" name="price" class="form-control @error('price')  is-invalid @enderror" id="" value="{{ old('price',$product_detail->price) }}" placeholder="Drinks...">
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
                                            @foreach ($category_detail as $cd )
                                                <option value="{{$cd->id}}" @if ( old('categoryId',$cd->id) == $cd->id ) selected @endif>{{ $cd->name }}</option>
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
                                        <input type="text" name="count" class="form-control @error('count')  is-invalid @enderror" id="" placeholder="Drinks..." value="{{ old('count',$product_detail->count) }}">
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
                                        <textarea name="description" class="form-control @error('description')  is-invalid @enderror" id="" cols="30" rows="10">{{ old('description',$product_detail->description)}}</textarea>
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
