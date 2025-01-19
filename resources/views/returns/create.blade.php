@extends('layouts.master')

@section('sidebar-content')
@endsection

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Pengembalian Mobil</h1>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col">
                <div class="card shadow mb-4">
                    <div class="card-header">
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
                        <form method="POST" action="{{ route('return.store') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="license_plate" class="col-sm-2 col-form-label">Plat Nomer</label>
                                <div class="col-sm-10">
                                    <input type="text" name="license_plate" id="license_plate" class="form-control" required placeholder="Masukkan Plat Nomer Mobil">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <input type="submit" class="btn btn-primary" value="Kembalikan Mobil" onclick="return confirm('Apakah anda yakin ingin mengembalikan mobil ini?')">
                                    <button type="reset" class="btn btn-danger">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
