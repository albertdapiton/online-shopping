<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $constants = getClassConstants(App\Enums\RoleType::class);

        foreach ($constants as $key => $val) {
            Role::create([
                'name' => $constants[$key],
                'slug' => $constants[$key],
            ]);
        }
    }
}
