@extends('layouts.dashboard.main')

@section('title', 'Tambah Task')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Tambah Data Task</h3>
                <p class="text-subtitle text-muted">Silahkan Isi Data Task</p>
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
            <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="from-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Nama Task</label>
                                <input type="text" name="title" class="form-control" id="title"
                                    placeholder="Masukkan Nama Task">
                            </div>

                            <div class="form-group">
                                <label for="des">Deskripsi</label>
                                <textarea name="description" class="form-control" id="des" placeholder="Masukkan Deskripsi Task"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="assignedTo">Assign To</label>
                                <select name="assignedTo" id="assignedTo" class="form-select">
                                    <option value="" disabled selected>-- Pilih Karyawan --</option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->fullName }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="dueDate">Due Date</label>
                                <input type="date" name="dueDate" class="form-control" id="dueDate"
                                    placeholder="Masukkan Due Date">
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="" disabled selected>-- Pilih Status --</option>
                                    <option value="completed">Completed</option>
                                    <option value="pending">Pending</option>
                                    <option value="on-progress">On-Progress</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary me-1 mb-2">Simpan</button>
                                <button type="reset" class="btn btn-light-secondary me-1 mb-2">Reset</button>
                                <a href="{{ route('tasks.index') }}" class="btn btn-primary me-1 mb-2">Batal</a>
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
        flatpickr("#dueDate", {
            enableTime: true,
            dateFormat: "Y-m-d",
        });
    </script>
@endsection