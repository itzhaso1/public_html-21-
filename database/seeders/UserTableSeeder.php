<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
class UserTableSeeder extends Seeder
{
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();
        User::create([
            'name'     => 'Islam Hafez',
            'email'    => 'user@app.com',
            'phone'    => '01015558628',
            'password' => Hash::make('123123123'),
            'status'   => 'active',
        ]);
        //UserFactory::new()->count(5)->create();
        Schema::enableForeignKeyConstraints();
    }
}