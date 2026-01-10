@extends('layouts.dashboard.main')

@section('title', 'Employee')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/extensions/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/table-datatable.css') }}">
    <style>
        .truncate {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
@endsection

@section('content')

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Daftar Employee</h3>
                    <p class="text-subtitle text-muted">Employee yang terdaftar</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <a href="{{ route('employees.create') }}" class="btn btn-primary float-start float-lg-end">
                                <i class="bi bi-plus-lg"></i>
                                Tambah Employee
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
                    <div class="table-responsive">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Ulang Tahun</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Department</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Salary</th>
                                    <th colspan="2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $employee->fullName }}</td>
                                        <td>{{ $employee->email }}</td>
                                        <td class="truncate">{{ $employee->phoneNumber }}</td>
                                        <td class="truncate">{{ $employee->birthDate }}</td>
                                        <td class="truncate">{{ $employee->hireDate }}</td>
                                        <td>{{ $employee->department->name }}</td>
                                        <td>{{ $employee->role->title }}</td>
                                        <td>
                                            @if ($employee->status == 'active')
                                                <span class="text-success">Active</span>
                                            @else
                                                <span class="text-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>{{ $employee->salary }}</td>
                                        <td>
                                            <a href="" class="btn btn-sm btn-info">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="" class="btn btn-sm btn-primary">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="{{ route('employees.destroy' , $employee->id) }}" method="POST" class="d-inline">
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
            </div>
        </section>
    </div>

@endsection

@section('script')

    <script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/simple-datatables.js') }}"></script>

@endsection
