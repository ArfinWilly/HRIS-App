@extends('layouts.dashboard.main')

@section('title', 'Pembayaran Gaji')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/extensions/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/table-datatable.css') }}">
@endsection

@section('content')

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Daftar Pembayaran Gaji</h3>
                    <p class="text-subtitle text-muted">Pembayaran Gaji yang terdaftar</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <a href="{{ route('payrolls.create') }}" class="btn btn-primary float-start float-lg-end">
                                <i class="bi bi-plus-lg"></i>
                                Tambah Payroll
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
                                <th>Salary</th>
                                <th>Bonuses</th>
                                <th>Deduction</th>
                                <th>Net Salary</th>
                                <th>Payment Date</th>
                                <th colspan="2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payrolls as $payroll)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $payroll->employee->fullName ?? '-'}}</td>
                                    <td>{{ 'Rp' . number_format($payroll->salary, 0, ',', '.') }}</td>
                                    <td>{{ 'Rp' . number_format($payroll->bonuses, 0, ',', '.') }}</td>
                                    <td>{{ 'Rp' . number_format($payroll->deductions, 0, ',', '.') }}</td>
                                    <td>{{ 'Rp' . number_format($payroll->netSalary, 0, ',', '.') }}</td>
                                    <td>{{ $payroll->paymentDate }}</td>
                                    <td>
                                        <a href="{{ route('payrolls.edit' , $payroll->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('payrolls.destroy', $payroll->id) }}" method="POST" class="d-inline">
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
