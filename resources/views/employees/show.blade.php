@extends('layouts.dashboard.main')

@section('title', 'Detail Employee')

@section('content')

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Detail Employee</h3>
                    <p class="text-subtitle text-muted">Informasi lengkap tentang employee</p>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4>Detail.</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Name:</strong> {{ $employee->fullName }} </p>
                            <p><strong>Email:</strong> {{ $employee->email }} </p>
                            <p><strong>Phone Number:</strong> {{ $employee->phoneNumber ?? '-' }} </p>
                            <p><strong>Birth Date:</strong> {{ $employee->birthDate ?? '-' }} </p>
                            <p><strong>Hire Date:</strong> {{ $employee->hireDate }} </p>
                            <p><strong>Department:</strong> {{ $employee->department->name ?? '-' }} </p>
                            <p><strong>Role:</strong> {{ $employee->role->title ?? '-' }} </p>
                            <p><strong>Status:</strong>
                                <span class="badge {{ $employee->status == 'active' ? 'bg-success' : 'bg-warning' }}">
                                    {{ $employee->status }}
                                </span>
                            </p>
                        </div>
                        <div class="form-group">
                            <a href="{{ route('employees.index') }}" class="btn btn-primary me-1 mb-2">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
