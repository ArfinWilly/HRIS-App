@extends('layouts.dashboard.main')

@section('title', 'Edit Presence')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Data Presence</h3>
                <p class="text-subtitle text-muted">Silahkan Perbarui Data Presence</p>
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
            <form action="{{ route('presences.update', $presence->id) }}" method="POST" enctype="multipart/form-data">
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
                                        <option value="{{ $employee->id }}" {{ $employee->fullName || old('employeeId') == $employee->id ? 'selected' : '' }}>
                                            {{ $employee->fullName }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Date">Tanggal</label>
                                <input type="date" name="date" class="form-control" id="Date" value="{{ old('date' , $presence->date) }}"
                                    placeholder="Masukkan Tanggal Presence">
                            </div>
                            <div class="form-group">
                                <label for="timepicker">Check-In</label>
                                <input type="time" name="checkIn" class="form-control" id="timepicker" value="{{ old('checkIn' , $presence->checkIn) }}"
                                    placeholder="Masukkan Check-In Presence">
                            </div>
                            <div class="form-group">
                                <label for="timepicker">Check-Out</label>
                                <input type="time" name="checkOut" class="form-control" id="timepicker" value="{{ old('checkOut' , $presence->checkOut) }}"
                                    placeholder="Masukkan Check-Out Presence">
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="" disabled selected>-- Pilih Status --</option>
                                    <option value="present" {{ $presence->status == 'present' || old('status') == 'present' ? 'selected' : '' }}>Present</option>
                                    <option value="absent" {{ $presence->status == 'absent' || old('status') == 'absent' ? 'selected' : '' }}>Absent</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary me-1 mb-2">Simpan</button>
                                <button type="reset" class="btn btn-light-secondary me-1 mb-2">Reset</button>
                                <a href="{{ route('presences.index') }}" class="btn btn-primary me-1 mb-2">Batal</a>
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
        if (document.getElementById('Date')) {
            flatpickr(
                "#Date", {
                    altInput: true,
                    altFormat: "F j, Y",
                    dateFormat: "Y-m-d",
                });
        }

        if (document.getElementById('timepicker')) {
            flatpickr(
                "#timepicker", {
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i",
                    time_24hr: true
                });
        }
    </script>
@endsection