<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Seed the statuses table.
     */
    public function run(): void
    {
        $statuses = [
            ['id' => 1, 'name' => 'draft',     'display_name' => 'Draft',   'order_by' => 1],
            ['id' => 2, 'name' => 'published', 'display_name' => 'Publish', 'order_by' => 2],
            ['id' => 3, 'name' => 'archive',   'display_name' => 'Archive', 'order_by' => 3],
            ['id' => 4, 'name' => 'deleted',   'display_name' => 'Delete',  'order_by' => 4],
            ['id' => 5, 'name' => 'pending',   'display_name' => 'Pending', 'order_by' => 5],
        ];

        foreach ($statuses as $status) {
            DB::table('statuses')->updateOrInsert(
                ['id' => $status['id']],
                $status
            );
        }
    }
}
