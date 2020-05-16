@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white"><label class="font-weight-bold">Products</label>
                    <a href="{{ url('/products/create')}}" class="btn btn-primary btn-sm float-right">Add Product</a>
                </div>
                <div class="card-body">
                    @if(Session::has('success'))
                    @include('layouts.flash-success',[ 'message'=> Session('success') ])
                    @endif
                    <div class="row">
                        @foreach ($products as $product)
                        <div class="col-sm-3">
                            <div class="card mb-3">
                                <div class="view overlay">
                                    <img class="card-img-top gambar" src="{{ $product->image }}" alt="Card image cap">
                                    <a href="#!">
                                        <div class="mask rgba-white-slight"></div>
                                    </a>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title text-center font-weight-bold"
                                        style="text-transform: capitalize;">
                                        {{ Str::words($product->name,6) }}</h5>
                                    <p class="card-text text-center">Rp. {{ number_format($product->price,2,',','.') }}
                                    </p>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-block btn-sm">Details</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div>{{ $products->links() }}</div>
            </div>
        </div>
    </div>
    @endsection

    @push('style')
    <style>
        .gambar {
            width: 100%;
            height: 175px;
            padding: 0.9rem 0.9rem
        }

        @media only screen and (max-width: 600px) {
            .gambar {
                width: 100%;
                height: 100%;
                padding: 0.9rem 0.9rem
            }
        }

    </style>
    @endpush
