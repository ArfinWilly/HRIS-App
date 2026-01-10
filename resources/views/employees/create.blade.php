@extends('layouts.dashboard.main')

@section('title', 'Tambah Employee')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Tambah Data Employee</h3>
                <p class="text-subtitle text-muted">Silahkan Isi Data Employee</p>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <h5 class="alert-heading"><i class="bi bi-exclamation-triangle"></i> Terjadi Kesalahan</h5>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="from-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fullname">Fullname</label>
                                <input type="text" name="fullName" class="form-control" id="fullname" value="{{ old('fullName') }}"
                                    placeholder="Masukkan Nama Lengkap">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" class="form-control" id="email" value="{{ old('email') }}"
                                    placeholder="Masukkan Email">
                            </div>
                            <div class="form-group">
                                <label for="phoneNumber">Nomor HP</label>
                                <input type="text" name="phoneNumber" class="form-control" id="phoneNumber" value="{{ old('phoneNumber') }}"
                                    placeholder="Masukkan Nomor HP">
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="" disabled selected>-- Pilih Status --</option>
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="in-active" {{ old('status') == 'in-active' ? 'selected' : '' }}>In-active</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="role">Role</label>
                                <select name="roleId" id="role" class="form-select">
                                    <option value="" disabled selected>-- Pilih Role --</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" {{ old('roleId') == $role->id ? 'selected' : '' }}>{{ $role->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="birthDate">Tanggal Lahir</label>
                                <input type="date" name="birthDate" class="date form-control" id="birthDate" value="{{ old('birtDate') }}"
                                    placeholder="Masukkan Tanggal Lahir">
                            </div>

                            <div class="form-group">
                                <label for="hireDate">Tanggal Masuk</label>
                                <input type="date" name="hireDate" class="date form-control" id="hireDate" value="{{ old('hireDate') }}"
                                    placeholder="Masukkan Tanggal Masuk">
                            </div>
                            
                            <div class="form-group">
                                <label for="department">Department</label>
                                <select name="departmentId" id="department" class="form-select">
                                    <option value="" disabled selected>-- Pilih Department --</option>
                                    @foreach ($departments as $department)
                                    <option value="{{ $department->id }}" {{ old('departmentId') == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="salary">Gaji</label>
                                <input type="number" name="salary" class="form-control" id="salary" value="{{ old('salary') }}"
                                    placeholder="Masukkan Gaji">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary me-1 mb-2">Simpan</button>
                                <button type="reset" class="btn btn-light-secondary me-1 mb-2">Reset</button>
                                <a href="{{ route('employees.index') }}" class="btn btn-primary me-1 mb-2">Batal</a>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // Flatpickr Initialization
        flatpickr('.date', {
            enableTime: true,
            dateFormat: "Y-m-d",
        });
    </script>
@endsection
