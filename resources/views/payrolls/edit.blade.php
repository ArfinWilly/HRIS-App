@extends('layouts.dashboard.main')

@section('title', 'Edit Payroll')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Data Payroll</h3>
                <p class="text-subtitle text-muted">Silahkan Perbarui Data Payroll</p>
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
            <form action="{{ route('payrolls.update', $payroll->id) }}" method="POST" enctype="multipart/form-data">
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
                                            {{ old('employeeId') == $employee->id || $employee->id == $payroll->employeeId ? 'selected' : '' }}>
                                            {{ $employee->fullName }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="salary">Salary</label>
                                <input type="number" name="salary" class="form-control" id="salary"
                                    value="{{ old('salary' , $payroll->salary) }}" placeholder="Masukkan Gaji Pokok">
                            </div>
                            <div class="form-group">
                                <label for="bonuses">Bonuses</label>
                                <input type="number" name="bonuses" class="form-control" id="bonuses"
                                    value="{{ old('bonuses' , $payroll->bonuses) }}" placeholder="Masukkan Bonuses">
                            </div>
                            <div class="form-group">
                                <label for="deductions">Deductions</label>
                                <input type="number" name="deductions" class="form-control" id="deductions"
                                    value="{{ old('deductions' , $payroll->deductions) }}" placeholder="Masukkan Potongan">
                            </div>
                            <div class="form-group">
                                <label for="Date">Tanggal Gaji</label>
                                <input type="date" name="paymentDate" class="form-control" id="Date"
                                    value="{{ old('paymentDate' , $payroll->paymentDate) }}" placeholder="Masukkan Tanggal Gaji">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary me-1 mb-2">Simpan</button>
                                <button type="reset" class="btn btn-light-secondary me-1 mb-2">Reset</button>
                                <a href="{{ route('payrolls.index') }}" class="btn btn-primary me-1 mb-2">Batal</a>
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
            "#Date", {
                altInput: true,
                altFormat: "F j, Y",
                dateFormat: "Y-m-d",
            });
    </script>
@endsection
