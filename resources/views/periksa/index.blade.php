@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Input Data</h1>
        {{-- <div class="d-flex">
            <a href="{{ route('export.pdf', ['type' => 'pdf']) }}" class="btn btn-danger mr-2">
                <i class="fas fa-file-pdf fa-sm text-white-50"></i> Download PDF
            </a>
            <a href="{{ route('export.excel', ['type' => 'excel']) }}" class="btn btn-success">
                <i class="fas fa-file-excel fa-sm text-white-50"></i> Download Excel
            </a>
        </div> --}}
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6>List Data Pasien</h6>
        </div>
        <div class="card-body"> @if($pasien->isEmpty())
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
                        <th scope="col">Nama</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Usia</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pasien as $pasiens)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $pasiens->kode_pasien }}</td>
                        <td>{{ $pasiens->nama }}</td>
                        <td>{{ $pasiens->jenis_kelamin }}</td>
                        <td>{{ $pasiens->usia }}</td>
                        <td>
                            <a href="{{ route('periksa.show', $pasiens->id) }}" class="btn btn-primary">Input Data</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
        </div>
    </div>
</div>
@endsection
