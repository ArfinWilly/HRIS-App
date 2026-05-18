@extends('layouts.dashboard.main')

@section('title', 'Detail Task')

@section('content')

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Detail Task</h3>
                    <p class="text-subtitle text-muted">Informasi lengkap tentang task</p>
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
                            <p><strong>Title:</strong> {{ $task->title }} </p>
                            <p><strong>Description:</strong> {{ $task->description }} </p>
                            <p><strong>Assigned To:</strong> {{ $task->employee->fullName }} </p>
                            <p><strong>Due Date:</strong> {{ $task->dueDate }} </p>
                            <p><strong>Status:</strong>
                                <span class="badge {{ $task->status == 'completed' ? 'bg-success' : 'bg-warning' }}">
                                    {{ $task->status }}
                                </span>
                            </p>
                        </div>
                        <div class="form-group">
                            <a href="{{ route('tasks.index') }}" class="btn btn-primary me-1 mb-2">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
