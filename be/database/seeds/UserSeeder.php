<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Schema::enableForeignKeyConstraints();
        User::create([
            'name'      => 'Albert Dapiton',
            'email'     => 'albert_dapiton@cody.inc',
            'password'  => Hash::make('12345')
        ])->roles()->attach(Role::where('name', 'admin')->first());

        User::create([
            'name'      => 'Sample Test 1',
            'email'     => 'sampletest1@test.test',
            'password'  => Hash::make('12345')
        ])->roles()->attach(Role::where('name', 'customer')->first());

        User::create([
            'name'      => 'Sample Test 2',
            'email'     => 'sampletest2@test.test',
            'password'  => Hash::make('12345')
        ])->roles()->attach(Role::where('name', 'customer')->first());

        User::create([
            'name'      => 'Sample Test 3',
            'email'     => 'sampletest3@test.test',
            'password'  => Hash::make('12345')
        ])->roles()->attach(Role::where('name', 'customer')->first());
    }
}
