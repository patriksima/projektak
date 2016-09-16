<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TaskStatusesDefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            'task' => [
                'done' => 'Done',
                'hold' => 'On Hold',
            ],
            'client' => [
                'approve' => 'Client Approve',
                'complaint' => 'Client Complaint',
            ],
            'worker' => [
                'analyze' => 'Analyze',
                'realize' => 'Realize',
                'test' => 'Test',
            ],
            'project' => [
                'prepare' => 'Prepare',
                'approve' => 'Approve',
                'request' => 'Time Request',
                'test' => 'Test',
            ],
        ];

        $sql = [];
        $order = 1;
        foreach ($statuses as $type => $slugs) {
            foreach ($slugs as $slug => $name) {
                $sql[] = [
                    'name' => $name,
                    'type' => $type,
                    'slug' => $slug,
                    'order' => $order,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
                $order++;
            }
        }

        DB::table('task_statuses')->insert($sql);
    }
}
