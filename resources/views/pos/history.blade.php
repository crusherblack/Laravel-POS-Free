@extends('layouts.app')
<!-- © 2020 Copyright: Tahu Coding -->
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card" style="min-height: 85vh">
                <div class="card-header bg-white"><h4 class="font-weight-bold">History Transcation</h4></div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr>
                            <th>No</th>
                            <th>Nomor Invoices</th>
                            <th>Admin</th>
                            <th>Bayar</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                        @foreach ($history as $index=>$item)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$item->invoices_number}}</td>
                                <td>{{$item->user->name}}</td>
                                <td>{{$item->pay}}</td>
                                <td>{{$item->total}}</td>
                            <td><a href="{{url('/transcation/laporan', $item->invoices_number )}}" class="btn btn-primary btn-sm"><i class="fas fa-print"></i></a></td>
                            </tr>
                        @endforeach                        
                    </table>
                    <div>{{ $history->links() }}</div>
                </div>
            </div>
    </div>
</div>
</div>
    
@endsection