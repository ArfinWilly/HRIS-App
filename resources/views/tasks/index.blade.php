@extends('layouts.dashboard.main')

@section('title', 'Task')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/extensions/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/table-datatable.css') }}">
@endsection

@section('content')

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Daftar Task</h3>
                    <p class="text-subtitle text-muted">Task yang terdaftar</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <a href="{{ route('tasks.create') }}" class="btn btn-primary float-start float-lg-end">
                                <i class="bi bi-plus-lg"></i>
                                Tambah Task
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
                                <th>Title</th>
                                <th>Description</th>
                                <th>Assigned To</th>
                                <th>Due Date</th>
                                <th colspan="2">Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ $task->description }}</td>
                                    <td>{{ $task->employee->fullName }}</td>
                                    <td>{{ $task->dueDate }}</td>
                                    <td>
                                        @if ($task->status == 'pending')
                                            <span class="text-warning">Pending</span>
                                        @elseif ($task->status == 'completed')
                                            <span class="text-success">Completed</span>
                                        @else
                                            <span class="text-info">{{ $task->status }}</span>
                                        @endif
                                    </td>
                                    <td>

                                        @if ($task->status == 'pending')
                                            <a href="{{ route('tasks.completed', $task->id) }}" class="btn btn-sm btn-success">
                                                Mark as Completed
                                            </a>
                                        @else
                                            <a href="{{ route('tasks.pending', $task->id) }}" class="btn btn-sm btn-warning">
                                                Mark as Pending
                                            </a>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
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
