<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'     => 'Administrador',
            'email'    => 'admin@onidigital.com',
            'password' => bcrypt('oni35224837')
        ]);
    }
}
