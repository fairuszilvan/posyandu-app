@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6>List Data Pasien</h6>
            </div>
            <div class="card-body">
                <!-- Search Form -->
                <form action="{{ route('pasien.index') }}" method="GET" class="mb-3">
                    <div class="row">
                        <div class="col-md-3 d-flex justify-content-between">
                            <input type="text" name="search" class="form-control" placeholder="Search by name..."
                                value="{{ request()->search }}">
                            <button type="submit" class="btn btn-primary ml-2">Search</button>
                        </div>
                        <div class="col-md-8 text-right">
                            <!-- Button to trigger modal -->
                            <button type="button" class="btn btn-success" data-toggle="modal"
                                data-target="#addPatientModal">
                                Tambah Data Pasien
                            </button>
                        </div>
                    </div>
                </form>
                <!-- Modal -->
                <div class="modal fade" id="addPatientModal" tabindex="-1" role="dialog"
                    aria-labelledby="addPatientModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addPatientModalLabel">Tambah Data Pasien</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('pasien.store') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-floating mb-3">
                                        <label for="name">Nama</label>
                                        <input class="form-control" id="nama" name="nama" type="text" placeholder="Masukan Nama Anda" data-sb-validations="required" />
                                        <div class="invalid-feedback" data-sb-feedback="name:required">Nama Diperlukan.</div>
                                    </div>
                                    <!-- Phone number input-->
                                    <div class="form-floating mb-3">
                                        <label for="phone">No Telepon</label>
                                        <input class="form-control" id="notelpon" name="notelpon" type="tel" placeholder="08132239423" data-sb-validations="required" />
                                        <div class="invalid-feedback" data-sb-feedback="phone:required">Nomor Telepon Diperlukan.</div>
                                    </div>
        
                                    <div class="form-floating mb-3">
                                        <label for="gender">Jenis Kelamin</label>
                                        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" data-sb-validations="required">
                                            <option value="" selected disabled>Pilih jenis kelamin</option>
                                            <option value="laki-laki">Laki-laki</option>
                                            <option value="perempuan">Perempuan</option>
                                        </select>
                                        <div class="invalid-feedback" data-sb-feedback="gender:required">Pilih jenis kelamin.</div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <label for="usia">Usia</label>
                                        <input class="form-control" id="usia" name="usia" type="tel" placeholder="24" data-sb-validations="required" />
                                        <div class="invalid-feedback" data-sb-feedback="phone:required">Usia Diperlukan.</div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <label for="alamat">Alamat</label>
                                        <textarea class="form-control" id="alamat" name="alamat" type="text" placeholder="Masukan Alamat anda" style="height: 10rem" data-sb-validations="required"></textarea>
                                        <div class="invalid-feedback" data-sb-feedback="message:required">Alamat Diperlukan.</div>
                                    </div>
                                    <!-- Add more fields as necessary -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Table or No Data Message -->
                @if ($pasien->isEmpty())
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
                                    <th scope="col">No Telepon</th>
                                    <th scope="col">Jenis Kelamin</th>
                                    <th scope="col">Usia</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pasien as $pasiens)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $pasiens->kode_pasien }}</td>
                                        <td>{{ $pasiens->nama }}</td>
                                        <td>{{ $pasiens->notelpon }}</td>
                                        <td>{{ $pasiens->jenis_kelamin }}</td>
                                        <td>{{ $pasiens->usia }}</td>
                                        <td>{{ $pasiens->alamat }}</td>
                                        <td>
                                            <a href="{{ route('pasien.details', $pasiens->id) }}"
                                                class="btn btn-primary">Data Periksa</a>
                                            <button type="button" class="btn btn-secondary" data-toggle="modal"
                                                data-target="#editModal{{ $pasiens->id }}">Edit</button>

                                            <!-- Modal Edit -->
                                            <div class="modal fade" id="editModal{{ $pasiens->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="editModalLabel{{ $pasiens->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel{{ $pasiens->id }}">
                                                                Edit Pasien</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- Form Edit -->
                                                            <form action="{{ route('pasien.edit', $pasiens->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group">
                                                                    <label for="editName">Nama</label>
                                                                    <input type="text" class="form-control"
                                                                        id="editName{{ $pasiens->id }}" name="nama"
                                                                        value="{{ $pasiens->nama }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="editPhone">No Telepon</label>
                                                                    <input type="text" class="form-control"
                                                                        id="editPhone{{ $pasiens->id }}" name="notelpon"
                                                                        value="{{ $pasiens->notelpon }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="editJenisKelamin">Jenis Kelamin</label>
                                                                    <select class="form-control"
                                                                        id="editJenisKelamin{{ $pasiens->id }}"
                                                                        name="jenis_kelamin">
                                                                        <option value="laki-laki"
                                                                            {{ $pasiens->jenis_kelamin == 'laki-laki' ? 'selected' : '' }}>
                                                                            Laki-Laki</option>
                                                                        <option value="perempuan"
                                                                            {{ $pasiens->jenis_kelamin == 'perempuan' ? 'selected' : '' }}>
                                                                            Perempuan</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="editUsia">Usia</label>
                                                                    <input type="text" class="form-control"
                                                                        id="editUsia{{ $pasiens->id }}" name="usia"
                                                                        value="{{ $pasiens->usia }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="editAlamat">Alamat</label>
                                                                    <textarea class="form-control" id="editAlamat{{ $pasiens->id }}" name="alamat">{{ $pasiens->alamat }}</textarea>
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Save
                                                                    changes</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <form action="{{ route('pasien.destroy', $pasiens->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
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
