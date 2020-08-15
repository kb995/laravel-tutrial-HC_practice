<?php

use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        foreach (range(1, 5) as $num) {
            DB::table('tasks')->insert([
                'folder_id' => 1,
                'title' => "サンプルタスク {$num}",
                'status' => $num,
                'due_date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
