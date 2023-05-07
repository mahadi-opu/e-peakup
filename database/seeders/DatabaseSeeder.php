<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $tables = DB::select('show tables');
        if ($tables) dd('Tables already exists.');
        else DB::unprepared(file_get_contents(base_path('SQL/ep.sql')));
    }
}
