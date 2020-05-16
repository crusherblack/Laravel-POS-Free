@extends('layouts.app')
<!-- © 2020 Copyright: Tahu Coding -->
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white">
                    <form action="{{ route('products.destroy', $product->id ) }}" method="POST">
                        <label class="font-weight-bold">
                            <h4 class="font-weight-bold">Products</h4>
                        </label>
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger btn-sm float-right"
                            onclick="return confirm('Apakah anda yakin menghapus data ini ?');">Delete Product</button>
                    </form>
                </div>
                <div class="card-body">
                    @if(Session::has('error'))
                    @include('layouts.flash-error',[ 'message'=> Session('error') ])
                    @endif
                    @if(Session::has('success'))
                    @include('layouts.flash-success',[ 'message'=> Session('success') ])
                    @endif
                    <form action="{{url('/products')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <input type="hidden" name="qty" value="{{ $product->qty }}">
                        <div class="form-group">
                            <label for="product">Product Name</label>
                            <input type="text" class="form-control" name="name"
                                value="{{ old('name', $product->name) }}">
                            @include('layouts.error', ['name' => 'name'])
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" name="price"
                                        value="{{ old('price' , $product->price) }}">
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
                                    <input type="number" class="form-control" value="{{ old('qty', $product->qty) }}"
                                        disabled>
                                </div>
                                <div class="form-group">
                                    <label for="addQty">Add / Reduce Qty </label>
                                    <input type="number" class="form-control" name="addQty" value="{{ old('addQty') }}"
                                        placeholder="Use positive number to increase | negative number to decrease">
                                    @if(Session::has('errorQty'))
                                    <small class="text-danger font-weight-bold">
                                        {{ Session('errorQty') }}
                                    </small>
                                    @endif
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
                            <button type="submit" class="btn btn-primary btn-block">Update Product</button>
                        </div>
                    </form>
                    <H4>Product History</H4>
                    <table class="table" id="dtMaterialDesignExample">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Updated By</th>
                                <th>Qty Before</th>
                                <th>Qty Added/Reduce</th>
                                <th>Qty</th>
                                <th>Time</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($history as $index=>$item)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$item->user->name}}</td>
                                <td>{{$item->qty}}</td>
                                <td>{{$item->qtyChange}}</td>
                                <td>{{$item->qty + $item->qtyChange}}</td>
                                <td>{{$item->created_at->diffForHumans()}}</td>
                                <td>{{$item->tipe}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<!-- © 2020 Copyright: Tahu Coding -->

