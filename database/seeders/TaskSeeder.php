<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'task_name' => 'Task 1',
                'task_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, nisl eget aliquam tincidunt, nunc nisl aliquam nisl, eget aliquam nunc nisl eget nunc. Donec euismod, nisl eget aliquam tincidunt, nunc nisl aliquam nisl, eget aliquam nunc nisl eget nunc.',
                'task_priority' => 'low',
                'task_status' => 'todo',
                'task_order' => 1,
            ],
            [
                'task_name' => 'Task 2',
                'task_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, nisl eget aliquam tincidunt, nunc nisl aliquam nisl, eget aliquam nunc nisl eget nunc. Donec euismod, nisl eget aliquam tincidunt, nunc nisl aliquam nisl, eget aliquam nunc nisl eget nunc.',
                'task_priority' => 'medium',
                'task_status' => 'in_progress',
                'task_order' => 2,
            ],
            [
                'task_name' => 'Task 3',
                'task_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, nisl eget aliquam tincidunt, nunc nisl aliquam nisl, eget aliquam nunc nisl eget nunc. Donec euismod, nisl eget aliquam tincidunt, nunc nisl aliquam nisl, eget aliquam nunc nisl eget nunc.',
                'task_priority' => 'high',
                'task_status' => 'done',
                'task_order' => 3,
            ],
        ];

        Task::insert($data);
    }
}
