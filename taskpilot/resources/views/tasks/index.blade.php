@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Your Tasks</h5>
        <div class="btn-group">
            <a href="{{ route('tasks.export', 'csv') }}" class="btn btn-outline-secondary btn-sm">Export CSV</a>
            <a href="{{ route('tasks.export', 'xlsx') }}" class="btn btn-outline-secondary btn-sm">Export Excel</a>
        </div>
        <div>
            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addTaskModal">Add Task</button>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped" id="tasksTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->description }}</td>
                        <td>
                            <span class="badge {{ $task->is_completed ? 'bg-success' : 'bg-secondary' }}">
                                {{ $task->is_completed ? 'Completed' : 'Pending' }}
                        </td>
                        <td>
                            <form action="{{ route('tasks.update', $task) }}" method="POST" class="d-inline">
                                @csrf 
                                @method('PUT')
                                <input type="hidden" name="is_completed" value="{{ $task->is_completed ? 0 : 1 }}">
                                <button type="submit" class="btn btn-sm {{ $task->is_completed ? 'btn-warning' : 'btn-primary' }}">
                                    {{ $task->is_completed ? 'Mark as Pending' : 'Mark as Completed' }}
                                </button>
                            </form>

                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Add Task Modal -->
 <div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('tasks.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTaskLabel">Add New Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Task Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Task Description</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                    <button type="submit" class="btn btn-primary">Create Task</button>
                </div>
            </div>
        </form>
    </div>
 </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#tasksTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('tasks.data') }}',
            columns: [
                { data: 'id', name: 'id '},
                { data: 'title', name: 'title' },
                { data: 'description', name: 'description' },
                { data: 'status', name: 'status' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false },
            ]
        });
    });
</script>
@endpush