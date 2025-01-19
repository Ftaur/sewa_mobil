@extends('layouts.master')

@section('sidebar-content')
@endsection

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Car</h1>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <form method="POST" action="{{ route('return.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="rental_id" class="col-sm-2 col-form-label">Pilih Rental</label>
                                <div class="col-sm-10">
                                    <select name="rental_id" id="rental_id" class="form-control" required>
                                        @foreach($userRentals as $rental)
                                            <option value="{{ $rental->id }}">{{ $rental->car->brand }} - {{ $rental->car->model }} ({{ $rental->license_plate }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- <label for="rental_id">Select Rental:</label>
                            <select name="rental_id" id="rental_id" required>
                                @foreach($userRentals as $rental)
                                    <option value="{{ $rental->id }}">{{ $rental->car->brand }} - {{ $rental->car->model }} ({{ $rental->license_plate }})</option>
                                @endforeach
                            </select> --}}

                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <input type="submit" class="btn btn-primary" value="Simpan Data">
                                    <button type="reset" class="btn btn-danger" value="Delete">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
