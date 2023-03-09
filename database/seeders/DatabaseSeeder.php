<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // $this->call([
        //     PermissionsTableSeeder::class,
        //     RolesTableSeeder::class,
        //     PermissionRoleTableSeeder::class,
        //     UsersTableSeeder::class,
        //     RoleUserTableSeeder::class,
        // ]);

        // \App\Models\Category::factory(5)->create();
        // \App\Models\Post::factory(1)->create();
        // \App\Models\DataUser::factory(1)->create();
        \App\Models\MasterKelompok::factory(5)->create();
        \App\Models\AnggotaKelompok::factory(50)->create();
        // \App\Models\V2Kelompoktani::factory(10)->create();
        // \App\Models\V2PoktanMember::factory(20)->create();
    }
}
