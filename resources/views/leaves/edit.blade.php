@extends('layouts.dashboard.main')

@section('title', 'Edit Perizinan Cuti')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Data Perizinan Cuti</h3>
                <p class="text-subtitle text-muted">Silahkan Perbarui Data Perizinan Cuti</p>
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
            <form action="{{ route('leaves.update', $leave->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="from-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name Employee</label>
                                <select name="employeeId" id="employeeId" class="form-select">
                                    <option value="" disabled selected>-- Pilih Employee --</option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}"
                                            {{ old('employeeId') == $employee->id || $employee->id == $leave->employeeId ? 'selected' : '' }}>
                                            {{ $employee->fullName }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="leaveReason">Alasan Cuti</label>
                                <input type="text" name="leaveReason" class="form-control" id="leaveReason"
                                    value="{{ old('leaveReason' , $leave->leaveReason) }}" placeholder="Masukkan Alasan Cuti">
                            </div>
                            <div class="form-group">
                                <label for="startDate">Awal Cuti</label>
                                <input type="date" name="startDate" class="form-control Date" id="startDate"
                                    value="{{ old('startDate' , $leave->startDate) }}" placeholder="Masukkan Tanggal Awal Cuti">
                            </div>
                            <div class="form-group">
                                <label for="endDate">Akhir Cuti</label>
                                <input type="date" name="endDate" class="form-control Date" id="endDate"
                                    value="{{ old('endDate' , $leave->endDate) }}" placeholder="Masukkan Tanggal Akhir Cuti">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary me-1 mb-2">Simpan</button>
                                <button type="reset" class="btn btn-light-secondary me-1 mb-2">Reset</button>
                                <a href="{{ route('leaves.index') }}" class="btn btn-primary me-1 mb-2">Batal</a>
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
        flatpickr(
            ".Date", {
                altInput: true,
                altFormat: "F j, Y",
                dateFormat: "Y-m-d",
            });
    </script>
@endsection
