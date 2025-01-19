@extends('layouts.master')

@section('sidebar-content')
@endsection

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Sewa Mobil</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <form method="POST" action="{{ route('rental.store') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="car_id" class="col-sm-2 col-form-label">Plat Nomer</label>
                            <div class="col-sm-10">
                                <select name="car_id" id="car_id" class="form-control" required>
                                    @foreach($availableCars as $car)
                                        <option value="{{ $car->id }}">{{ $car->brand }} - {{ $car->model }} ({{ $car->license_plate }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date" class="col-sm-2 col-form-label">Tanggal Sewa & Kembali</label>
                            <div class="col-sm-10">
                                <input type="date" name="start_date" id="start_date" required="required"
                                    class="form-control" placeholder="Ketik...">
                                <br>
                                <input type="date" name="end_date" id="end_date" required="required"
                                    class="form-control" placeholder="Ketik...">
                            </div>
                        </div>

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
