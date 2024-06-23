<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'Super Admin',
            'desc' => 'Quản Trị Viên Cao Nhất',
        ]);
        Role::create([
            'name' => 'Admin',
            'desc' => 'Quản Trị Viên',
        ]);
        Role::create([
            'name' => 'User',
            'desc' => 'Người Dùng',
        ]);
    }
}