@extends('layouts.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Periksa</h1>
    </div>
    
    <!-- Data Pasien -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Pasien</h6>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-4 font-weight-bold">Kode Pasien:</div>
                <div class="col-md-8">{{ $pasien->kode_pasien }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 font-weight-bold">Nama Pasien:</div>
                <div class="col-md-8">{{ $pasien->nama }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 font-weight-bold">Nomor Telepon:</div>
                <div class="col-md-8">{{ $pasien->notelpon }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 font-weight-bold">Jenis Kelamin:</div>
                <div class="col-md-8">{{ $pasien->jenis_kelamin }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 font-weight-bold">Usia:</div>
                <div class="col-md-8">{{ $pasien->usia }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 font-weight-bold">Alamat:</div>
                <div class="col-md-8">{{ $pasien->alamat }}</div>
            </div>
        </div>
    </div>
    
        <!-- Data Historis -->
        @if($medicalRecord)
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6>List Data Periksa</h6>
            </div>
            <div class="card-body"> @if($medicalRecord->isEmpty())
                <div class="alert alert-warning">
                    Data tidak ditemukan.
                </div>
            @else
            <div class="table-responsive">
                <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kode</th>
                        <th scope="col">Tensi</th>
                        <th scope="col">Berat Badan</th>
                        <th scope="col">Suhu Badan</th>
                        <th scope="col">Nadi</th>
                        <th scope="col">Keluhan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($medicalRecord as $medicalRecords)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $medicalRecords->kode_periksa }}</td>
                        <td>{{ $medicalRecords->tensi }}</td>
                        <td>{{ $medicalRecords->bb }}</td>
                        <td>{{ $medicalRecords->suhu_badan }}</td>
                        <td>{{ $medicalRecords->nadi }}</td>
                        <td>{{ $medicalRecords->keluhan }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            @endif
            </div>
        </div>
        @endif
</div>
@endsection
