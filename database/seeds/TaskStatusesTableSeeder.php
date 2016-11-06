<?php

use Illuminate\Database\Seeder;

class TaskStatusesTableSeeder extends Seeder
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

        foreach ($statuses as $type => $slugs) {
            foreach ($slugs as $slug => $name) {
                factory(App\TaskStatus::class)->create([
                    'name' => $name, 'slug' => $slug, 'type' => $type, 'order' => @++$order,
                ]);
            }
        }
    }
}
