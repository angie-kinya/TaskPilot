<?php

namespace App\Exports;

use App\Models\Task;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;

class TasksExport implements FromCollection
{
    use Exportable;

    public function collection()
    {
        return Task::select('id', 'title', 'description', 'is_completed', 'created_at')->get();
    }
}
