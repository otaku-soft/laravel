<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'view users','guard_name' => 'web']);
        Permission::create(['name' => 'create users','guard_name' => 'web']);
        Permission::create(['name' => 'edit users','guard_name' => 'web']);
        Permission::create(['name' => 'delete users','guard_name' => 'web']);
        Permission::create(['name' => 'all','guard_name' => 'web']);
    }
}
