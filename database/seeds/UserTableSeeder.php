<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name'=>'klevson Felipe',
            'email'=>'klevsonatleticano@gmail.com',
            'password'=>bcrypt('123456'),
            'acesso'=>0
    ]);
         App\User::create([
            'name'=>'Pedro Henrique',
            'email'=>'Pedro@gmail.com',
            'password'=>bcrypt('123456'),
            'acesso'=>1
    ]);
         App\User::create([
            'name'=>'João Batista',
            'email'=>'batista@gmail.com',
            'password'=>bcrypt('12'),
            'acesso'=>1
    ]);
}}
