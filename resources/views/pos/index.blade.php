@extends('layouts.app')
<!-- © 2020 Copyright: Tahu Coding -->
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="min-height:85vh">
                <div class="card-header bg-white">
                    <form action="{{ url('/transcation') }}" method="get">
                        <div class="row">
                            <div class="col">
                                <h4 class="font-weight-bold">Products</h4>
                            </div>
                            <div class="col text-right">
                                <select name="" id="" class="form-control from-control-sm" style="font-size: 12px">
                                    <option value="" holder>Filter Category</option>
                                    <option value="1">All Category...</option>
                                    <!-- Kembangkan sendiri ya bagian ini kalau bisa pake select2 biar keren -->
                                </select>
                            </div>
                            <div class="col"><input type="text" name="search"
                                    class="form-control form-control-sm col-sm-12 float-right"
                                    placeholder="Search Product..." onblur="this.form.submit()"></div>
                            <div class="col-sm-3"><button type="submit"
                                    class="btn btn-primary btn-sm float-right btn-block">Cari Product</button></div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($products as $product)
                        <div style="width: 16.66%;border:1px solid rgb(243, 243, 243)" class="mb-4">
                            <div class="productCard">
                                <div class="view overlay">
                                    <form action="{{url('/transcation/addproduct', $product->id)}}" method="POST">
                                        @csrf
                                        @if($product->qty == 0)
                                        <img class="card-img-top gambar" src="{{ $product->image }}"
                                            alt="Card image cap">
                                        <button class="btn btn-primary btn-sm cart-btn disabled"><i
                                                class="fas fa-cart-plus"></i></button>
                                        @else
                                        <img class="card-img-top gambar" src="{{ $product->image }}"
                                            alt="Card image cap" style="cursor: pointer"
                                            onclick="this.closest('form').submit();return false;">
                                        <button type="submit" class="btn btn-primary btn-sm cart-btn"><i
                                                class="fas fa-cart-plus"></i></button>
                                        @endif
                                    </form>
                                </div>
                                <div class="card-body">
                                    <label class="card-text text-center font-weight-bold"
                                        style="text-transform: capitalize;">
                                        {{ Str::words($product->name,4) }} ({{$product->qty}}) </label>
                                    <p class="card-text text-center">Rp. {{ number_format($product->price,2,',','.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div>{{ $products->links() }}</div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card" style="min-height:85vh">
                <div class="card-header bg-white">
                    <div class="row">
                        <div class="col-sm-4">
                            <h4 class="font-weight-bold">Cart</h4>
                        </div>
                        <div class="col-sm-8">
                            <select name="" id="" class="form-control from-control-sm" style="font-size: 13px">
                                <option value="1">Take Away Customer</option>
                                <option value="" holder>Other Customer...</option>
                                <!-- Kembangkan sendiri ya bagian ini -->
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div style="overflow-y:auto;min-height:53vh;max-height:53vh" class="mb-3">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th width="10%">No</th>
                                    <th width="30%">Nama Product</th>
                                    <th width="30%">Qty</th>
                                    <th width="30%" class="text-right">Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no=1
                                @endphp
                                @forelse($cart_data as $index=>$item)
                                <tr>
                                    <td>
                                        <form action="{{url('/transcation/removeproduct',$item['rowId'])}}"
                                            method="POST">
                                            @csrf
                                            {{$no++}} <br><a onclick="this.closest('form').submit();return false;"><i
                                                    class="fas fa-trash" style="color: rgb(134, 134, 134)"></i></a>
                                        </form>
                                    </td>
                                    <td>{{Str::words($item['name'],3)}} <br>Rp.
                                        {{ number_format($item['pricesingle'],2,',','.') }}
                                    </td>
                                    <td class="font-weight-bold">
                                        <form action="{{url('/transcation/decreasecart', $item['rowId'])}}"
                                            method="POST" style='display:inline;'>
                                            @csrf
                                            <button class="btn btn-sm btn-info"
                                                style="display: inline;padding:0.4rem 0.6rem!important"><i
                                                    class="fas fa-minus"></i></button>
                                        </form>
                                        <a style="display: inline">{{$item['qty']}}</a>
                                        <form action="{{url('/transcation/increasecart', $item['rowId'])}}"
                                            method="POST" style='display:inline;'>
                                            @csrf
                                            <button class="btn btn-sm btn-primary"
                                                style="display: inline;padding:0.4rem 0.6rem!important"><i
                                                    class="fas fa-plus"></i></button>
                                        </form>
                                    </td>
                                    <td class="text-right">Rp. {{ number_format($item['price'],2,',','.') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">Empty Cart</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <table class="table table-sm table-borderless">
                        <tr>
                            <th width="60%">Sub Total</th>
                            <th width="40%" class="text-right">Rp.
                                {{ number_format($data_total['sub_total'],2,',','.') }} </th>
                        </tr>
                        <tr>
                            <th>
                                <form action="{{ url('/transcation') }}" method="get">
                                    PPN 10%
                                    <input type="checkbox" {{ $data_total['tax'] > 0 ? "checked" : ""}} name="tax"
                                        value="true" onclick="this.form.submit()">
                                </form>
                            </th>
                            <th class="text-right">Rp.
                                {{ number_format($data_total['tax'],2,',','.') }}</th>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <th class="text-right font-weight-bold">Rp.
                                {{ number_format($data_total['total'],2,',','.') }}</th>
                        </tr>
                    </table>
                    <div class="row">
                        <div class="col-sm-4">
                            <form action="{{ url('/transcation/clear') }}" method="POST">
                                @csrf
                                <button class="btn btn-info btn-lg btn-block" style="padding:1rem!important"
                                    onclick="return confirm('Apakah anda yakin ingin meng-clear cart ?');"
                                    type="submit">Clear</button>
                            </form>
                        </div>
                        <div class="col-sm-4">
                            <a class="btn btn-primary btn-lg btn-block"
                                style="padding:1rem!important" href="{{url('/transcation/history')}}" target="_blank">History</a>
                            <!-- Kembangkan sendiri ya bagian ini, logikanya kita simpan cartnya sementara dalam databse ntar kalau butuh keluarin lagi-->
                        </div>
                        <div class="col-sm-4">
                            <button class="btn btn-success btn-lg btn-block" style="padding:1rem!important"
                                data-toggle="modal" data-target="#fullHeightModalRight">Pay</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade right" id="fullHeightModalRight" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">

        <!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal -->
        <div class="modal-dialog modal-full-height modal-right" role="document">

        <!-- Sorry campur2 bahasa indonesia sama inggris krn kebiasaan make b.inggris eh ternyata buat aplikasi buat indonesia jadi gini deh  -->
            <div class="modal-content">
                <div class="modal-header indigo">
                    <h6 class="modal-title w-100 text-light" id="myModalLabel">Billing Information</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-sm table-borderless">
                        <tr>
                            <th width="60%">Sub Total</th>
                            <th width="40%" class="text-right">Rp.
                                {{ number_format($data_total['sub_total'],2,',','.') }} </th>
                        </tr>
                        @if($data_total['tax'] > 0)
                        <tr>
                            <th>PPN 10%</th>
                            <th class="text-right">Rp.
                                {{ number_format($data_total['tax'],2,',','.') }}</th>
                        </tr>
                        @endif
                    </table>
                    <form action="{{ url('/transcation/bayar') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="oke">Input Nominal</label>
                        <input id="oke" class="form-control" type="number" name="bayar" autofocus />
                    </div>
                    <h3 class="font-weight-bold">Total:</h3>
                    <h1 class="font-weight-bold mb-5">Rp. {{ number_format($data_total['total'],2,',','.') }}</h1>
                    <input id="totalHidden" type="hidden" name="totalHidden" value="{{$data_total['total']}}" />

                    <h3 class="font-weight-bold">Bayar:</h3>
                    <h1 class="font-weight-bold mb-5" id="pembayaran"></h1>

                    <h3 class="font-weight-bold text-primary">Kembalian:</h3>
                    <h1 class="font-weight-bold text-primary" id="kembalian"></h1>
                </div>
                
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="saveButton" disabled onClick="openWindowReload(this)">Save transcation</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
    <!-- © 2020 Copyright: Tahu Coding -->
    <!-- Ini error harusnya bisa dinamis ambil value dari controller tp agar cepet ya biar aja gini silahkan modifikasi  -->
    @push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    @if(Session::has('error'))
    <script>
        toastr.error(
            'Telah mencapai jumlah maximum Product | Silahkan tambah stock Product terlebih dahulu untuk menambahkan'
        )

    </script>
    @endif

    @if(Session::has('errorTransaksi'))
    <script>
        toastr.error(
            'Transaksi tidak valid | perhatikan jumlah pembayaran | cek jumlah product'
        )

    </script>
    @endif

    @if(Session::has('success'))
    <script>
        toastr.success(
            'Transaksi berhasil | Thank Your from Tahu Coding'
        )

    </script>
    @endif

    <script>
        $(document).ready(function () {
            $('#fullHeightModalRight').on('shown.bs.modal', function () {
                $('#oke').trigger('focus');
            });
        });

        oke.oninput = function () {
            let jumlah = parseInt(document.getElementById('totalHidden').value) ? parseInt(document.getElementById('totalHidden').value) : 0;
            let bayar = parseInt(document.getElementById('oke').value) ? parseInt(document.getElementById('oke').value) : 0;
            let hasil = bayar - jumlah;
            document.getElementById("pembayaran").innerHTML = bayar ? 'Rp ' + rupiah(bayar) + ',00' : 'Rp ' + 0 +
                ',00';
            document.getElementById("kembalian").innerHTML = hasil ? 'Rp ' + rupiah(hasil) + ',00' : 'Rp ' + 0 +
                ',00';

            cek(bayar, jumlah);
            const saveButton = document.getElementById("saveButton");   

            if(jumlah === 0){
                saveButton.disabled = true;
            }

        };

        function cek(bayar, jumlah) {
            const saveButton = document.getElementById("saveButton");   

            if (bayar < jumlah) {
                saveButton.disabled = true;
            } else {
                saveButton.disabled = false;
            }
        }

        function rupiah(bilangan) {
            var number_string = bilangan.toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{1,3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            return rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        }

    </script>

    @endpush

    @push('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
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

        html {
            overflow: scroll;
            overflow-x: hidden;
        }

        ::-webkit-scrollbar {
            width: 0px;
            /* Remove scrollbar space */
            background: transparent;
            /* Optional: just make scrollbar invisible */
        }

        /* Optional: show position indicator in red */
        ::-webkit-scrollbar-thumb {
            background: #FF0000;
        }

        .cart-btn {
            position: absolute;
            display: block;
            top: 5%;
            right: 5%;
            cursor: pointer;
            transition: all 0.3s linear;
            padding: 0.6rem 0.8rem !important;

        }

        .productCard {
            cursor: pointer;

        }

        .productCard:hover {
            border: solid 1px rgb(172, 172, 172);

        }

    </style>
    <!-- © 2020 Copyright: Tahu Coding -->
    @endpush
