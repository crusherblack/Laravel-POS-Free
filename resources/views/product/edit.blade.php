@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white"><label class="font-weight-bold">Products</label>
                <form action="{{ route('products.destroy', $product->id ) }}" method="POST">
                        @method('delete')
                        @csrf
                        <input type="hidden" name="redirect_to" value="{{ URL::previous() }}">
                        <a href="{{ url('/products/create')}}" class="btn btn-primary btn-sm float-right ml-1">Add Product</a>
                        <button class="btn btn-danger btn-sm float-right" onclick="return confirm('Apakah anda yakin menghapus data ini ?');">Delete Product</button>
                    </form>
                    
                </div>
                <div class="card-body">
                    @if(Session::has('error'))
                        @include('layouts.flash-error',[ 'message'=> Session('error') ])
                    @endif
                    <form action="{{url('/products')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <input type="hidden" name="redirect_to" value="{{ URL::previous() }}">
                        <div class="form-group">
                            <label for="product">Product Name</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name', $product->name) }}">
                            @include('layouts.error', ['name' => 'name'])
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" name="price" value="{{ old('price' , $product->price) }}">
                                    @include('layouts.error', ['name' => 'price'])
                                </div>
                                <div class="form-group">
                                    <label>Gambar Hero</label>
                                    <div>
                                        <div class="custom-file">
                                            <br>
                                            <input name="image" id="image" type="file" class="custom-file-input"
                                                accept="image/*"
                                                onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0]); document.getElementById('preview').style.display = 'none'"><label
                                                class="custom-file-label">Choose File</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12"><img id="output" src="" class="img-fluid"></div>
                                    @if($product->image)
                                        <img src="{{asset($product->image)}}" class="img-fluid" id="preview">
                                    @endif
                                    @include('layouts.error', ['name' => 'image'])
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="qty">Qty</label>
                                    <input type="number" class="form-control" name="qty" value="{{ old('qty', $product->qty) }}">
                                    @include('layouts.error', ['name' => 'qty'])
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" cols="30" rows="10"
                                class="form-control">{{ old('description', $product->description) }}</textarea>
                                @include('layouts.error', ['name' => 'description'])
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Submit Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
