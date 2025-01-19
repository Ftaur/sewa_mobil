@extends('layouts.master')

@section('sidebar-content')
@endsection

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Trip Perjalanan</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Rental</h6>
        </div>
        <div class="card-body">
            <a href="{{ route('return.create') }}" class="btn btn-primary btn-sm">Pengembalian</a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Plat Nomer</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($returns as $return)
                        <tr>
                            <td>{{ $return->license_plate }}</td>
                            <td>{{ number_format($return->fee, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
