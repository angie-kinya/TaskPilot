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
