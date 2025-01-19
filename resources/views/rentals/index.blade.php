@extends('layouts.master')

@section('sidebar-content')
@endsection

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Trip Perjalanan</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Sewa Mobil</h6>
        </div>
        <div class="card-body">
            <a href="{{ route('rental.create') }}" class="btn btn-primary btn-sm">Sewa</a>
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
                            <th>Tanggal Sewa</th>
                            <th>Tanggak Kembali</th>
                            <th>Status</th>
                            {{-- <th>Actions</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rentals as $rental)
                        <tr>
                            <td>{{ $rental->license_plate }}</td>
                            <td>{{ $rental->start_date }}</td>
                            <td>{{ $rental->end_date }}</td>
                            <td>{{ $rental->status ? 'Kembali' : 'Sedang Disewa' }}</td>
                            {{-- <td>
                                <a href="{{ route('rental.edit', $rental->id) }}" class="btn btn-warning btn-sm">Pengembalian</a>
                                <form action="{{ route('rental.destroy', $rental->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data ini secara permanen?')">Hapus</button>
                                </form>
                            </td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
