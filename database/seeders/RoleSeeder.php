<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Src\Resources\Constants\Roles;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            Roles::CLIENT => 'CLIENT',
            Roles::OWNER => 'OWNER',
            Roles::COLLABORATOR => 'COLLABORATOR',
            Roles::ADMIN => 'ADMIN'
        ];
        $data = [];
        foreach ($roles as $key => $role) {
            $data[] = ['key' => $key, 'name' => $role];
        }
        Role::upsert($data, ['key'], ['name']);
    }
}
