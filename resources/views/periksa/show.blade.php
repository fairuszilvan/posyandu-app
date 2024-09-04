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
    
    <div class="row">
        <!-- Input Data Periksa -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Input Data Periksa</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('periksa.store') }}">
                        @csrf
        
                        <input type="hidden" name="id_pasien" value="{{ $pasien->id }}">
        
                        <div class="form-group">
                            <label for="tensi">Tensi</label>
                            <input type="text" class="form-control" id="tensi" name="tensi" placeholder="Contoh: 120/80" required>
                        </div>
                        <div class="form-group">
                            <label for="bb">Berat Badan</label>
                            <input type="text" class="form-control" id="bb" name="bb" placeholder="Contoh: 70" required>
                        </div>
                        <div class="form-group">
                            <label for="suhu_badan">Suhu Badan</label>
                            <input type="text" class="form-control" id="suhu_badan" name="suhu_badan" placeholder="Contoh: 36" required>
                        </div>
                        <div class="form-group">
                            <label for="nadi">Nadi</label>
                            <input type="text" class="form-control" id="nadi" name="nadi" placeholder="Contoh: 72" required>
                        </div>
                        <div class="form-group">
                            <label for="Keluhan">Keluhan</label>
                            <textarea type="text" class="form-control" id="keluhan" name="keluhan" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        

        <!-- Data Historis -->
        @if($medicalRecord)
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Historis</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Kode Periksa:</div>
                        <div class="col-md-8">{{ $medicalRecord->kode_periksa }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Tensi:</div>
                        <div class="col-md-8">{{ $medicalRecord->tensi }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Berat Badan:</div>
                        <div class="col-md-8">{{ $medicalRecord->bb }} kg</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Suhu Badan:</div>
                        <div class="col-md-8">{{ $medicalRecord->suhu_badan }} °C</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Nadi:</div>
                        <div class="col-md-8">{{ $medicalRecord->nadi }} BPM</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Keluhan:</div>
                        <div class="col-md-8">{{ $medicalRecord->keluhan }}</div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Historis</h6>
                </div>
                <div class="card-body">
                    <div class="alert alert-warning">
                        Tidak ada data hasil pemeriksaan yang ditemukan.
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
