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
                        <form action="{{ route('cars.update', $car->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Number Plate -->
                            <div class="form-group row">
                                <label for="license_plate" class="col-sm-2 col-form-label">Plat Nomer</label>
                                <div class="col-sm-10">
                                    <input type="text" name="license_plate" id="license_plate" required="required"
                                        class="form-control" value="{{ $car->license_plate }}" maxlength="16">
                                </div>
                            </div>

                            <!-- Brand -->
                            <div class="form-group row">
                                <label for="brand" class="col-sm-2 col-form-label">Brand Mobil</label>
                                <div class="col-sm-10">
                                    <input type="text" name="brand" id="brand" required="required"
                                        class="form-control" value="{{ $car->brand }}" maxlength="256">
                                </div>
                            </div>

                            <!-- Type -->
                            <div class="form-group row">
                                <label for="model" class="col-sm-2 col-form-label">Model</label>
                                <div class="col-sm-10">
                                    <input type="text" name="model" id="model" required="required"
                                        class="form-control" value="{{ $car->model }}" maxlength="256">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="rental_price" class="col-sm-2 col-form-label">Harga Sewa per hari</label>
                                <div class="col-sm-10">
                                    <input type="number" name="rental_price" id="rental_price" required="required"
                                        class="form-control" value="{{ $car->rental_price }}" maxlength="256">
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
    <!-- /.container-fluid -->

@endsection
