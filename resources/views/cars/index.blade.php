@extends('layouts.master')

@section('sidebar-content')
@endsection

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Mobil</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Mobil</h6>
        </div>
        <div class="card-body">
            <a href="{{ route('cars.create') }}" class="btn btn-primary btn-sm">Tambah</a>
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
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Brand Mobil</th>
                            <th>Model</th>
                            <th>Harga Sewa per hari</th>
                            <th>Tersedia</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cars as $car)
                        <tr>
                            <td>{{ $car->brand }}</td>
                            <td>{{ $car->model }}</td>
                            <td>Rp {{ number_format($car->rental_price, 0, ',', '.') }}</td>
                            <td>{{ $car->available ? 'Tersedia' : 'Tidak tersedia' }}</td>
                            <td>
                                @if($car->user_id == auth()->id())
                                    <!-- Actions for user-owned cars -->
                                    <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('cars.destroy', $car->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data ini secara permanen?')">Hapus</button>
                                    </form>
                                @elseif ($car->available)
                                    <!-- Actions for cars available for rent -->
                                    <form method="POST" action="{{ route('rental.store') }}">
                                        @csrf
                                        <input type="hidden" name="car_id" value="{{ $car->id }}">
                                        <input type="date" name="start_date" required="required" class="form-control" placeholder="Tanggal Sewa">
                                        <input type="date" name="end_date" required="required" class="form-control" placeholder="Tanggal Kembali">
                                        <button type="submit" class="btn btn-primary btn-sm">Sewa</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
