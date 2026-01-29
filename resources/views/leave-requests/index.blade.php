@extends('layouts.dashboard.main')

@section('title', 'Perizinan Cuti')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/extensions/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/table-datatable.css') }}">
@endsection

@section('content')

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Daftar Perizinan Cuti</h3>
                    <p class="text-subtitle text-muted">Perizinan Cuti yang terdaftar</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <a href="{{ route('leave-requests.create') }}" class="btn btn-primary float-start float-lg-end">
                                <i class="bi bi-plus-lg"></i>
                                Tambah Perizinan Cuti
                            </a>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <p><i class="bi bi-check-circle"></i> {{ session('success') }}</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name Employee</th>
                                <th>Alasan Cuti</th>
                                <th>Mulai Cuti</th>
                                <th>Akhir Cuti</th>
                                <th>Status</th>
                                <th colspan="2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leaves as $leave)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $leave->employee->fullName ?? '-' }}</td>
                                    <td>{{ $leave->leaveReason }}</td>
                                    <td>{{ $leave->startDate }}</td>
                                    <td>{{ $leave->endDate }}</td>
                                    <td>
                                        @if ($leave->status == 'confirmed')
                                            <span class="text-success">{{ $leave->status }}</span>
                                        @elseif ($leave->status == 'rejected')
                                            <span class="text-danger">{{ $leave->status }}</span>
                                        @else
                                            <span class="text-warning">{{ $leave->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($leave->status == 'rejected' || $leave->status == 'pending')
                                            <a href="{{ route('leave-requests.confirmed', $leave->id) }}"
                                                class="btn btn-sm btn-success">
                                                <i class="bi bi-check-circle"></i>
                                            </a>
                                        @elseif ($leave->status == 'confirmed' || $leave->status == 'pending')
                                            <a href="{{ route('leave-requests.rejected', $leave->id) }}"
                                                class="btn btn-sm btn-danger">
                                                <i class="bi bi-x-circle"></i>
                                            </a>
                                        @endif

                                        <a href="{{ route('leave-requests.edit', $leave->id) }}"
                                            class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('leave-requests.destroy', $leave->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

@endsection

@section('script')

    <script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/simple-datatables.js') }}"></script>

@endsection
