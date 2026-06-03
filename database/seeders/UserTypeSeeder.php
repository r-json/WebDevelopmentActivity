<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypeSeeder extends Seeder
{
    /**
     * Seed the user_types table.
     */
    public function run(): void
    {
        $types = [
            ['name' => 'admin',   'display_name' => 'Admin',   'order_by' => 1],
            ['name' => 'faculty', 'display_name' => 'Faculty', 'order_by' => 2],
            ['name' => 'staff',   'display_name' => 'Staff',   'order_by' => 3],
            ['name' => 'student', 'display_name' => 'Student', 'order_by' => 4],
            ['name' => 'user',    'display_name' => 'User',    'order_by' => 5],
            ['name' => 'guest',   'display_name' => 'Guest',   'order_by' => 6],
        ];

        foreach ($types as $type) {
            DB::table('user_types')->updateOrInsert(
                ['name' => $type['name']],
                $type
            );
        }
    }
}
