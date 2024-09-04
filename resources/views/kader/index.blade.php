@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6>List Data Kader</h6>
            </div>
            <div class="card-body">
                <!-- Search Form -->
                <form action="{{ route('kader.index') }}" method="GET" class="mb-3">
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
                                Tambah Data Kader
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
                                <h5 class="modal-title" id="addPatientModalLabel">Tambah Data Kader</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('kader.store') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-floating mb-3">
                                        <label for="name">Name</label>
                                        <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                                        @if ($errors->has('name'))
                                            <div class="text-danger mt-2">{{ $errors->first('name') }}</div>
                                        @endif
                                    </div>
                        
                                    <!-- Email Input -->
                                    <div class="form-floating mb-3">
                                        <label for="email">Email</label>
                                        <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
                                        @if ($errors->has('email'))
                                            <div class="text-danger mt-2">{{ $errors->first('email') }}</div>
                                        @endif
                                    </div>
                        
                                    <!-- Password Input -->
                                    <div class="form-floating mb-3">
                                        <label for="password">Password</label>
                                        <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password">
                                        @if ($errors->has('password'))
                                            <div class="text-danger mt-2">{{ $errors->first('password') }}</div>
                                        @endif
                                    </div>
                        
                                    <!-- Confirm Password Input -->
                                    <div class="form-floating mb-3">
                                        <label for="password_confirmation">Confirm Password</label>
                                        <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password">
                                        @if ($errors->has('password_confirmation'))
                                            <div class="text-danger mt-2">{{ $errors->first('password_confirmation') }}</div>
                                        @endif
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
                @if ($kader->isEmpty())
                    <div class="alert alert-warning">
                        Data tidak ditemukan.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kader as $kaders)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $kaders->name }}</td>
                                        <td>{{ $kaders->email }}</td>
                                        <td>
                                            <form action="{{ route('pasien.destroy', $kaders->id) }}" method="POST"
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
