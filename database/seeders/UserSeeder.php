<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([

            [
                'role_id' => '1',
                'name' => 'Md.Admin',
                'username' => 'admin',
                'email' => 'admin@blog.com',
                'password' => bcrypt(value:'rootadmin'),
                
            ]
            
        ]);

        DB::table('users')->insert([
            [
               'role_id' => '2',
                'name' => 'Md.Author',
                'username' => 'author',
                'email' => 'author@blog.com',
                'password' => bcrypt(value:'rootauthor'),
                
            ],
        ]);
    }
}
