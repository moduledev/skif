<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        User::create(['name'=>'admin','email'=>'admin@admin.com','password'=>Hash::make('password'),'surname'=>'Kupa']);
//        User::create(['name'=>'editor','email'=>'user@user.com','password'=>Hash::make('password'),'surname'=>'Some User']);
        $file = new Filesystem;
        $file->cleanDirectory('storage/app/public/admin');
    }
}
