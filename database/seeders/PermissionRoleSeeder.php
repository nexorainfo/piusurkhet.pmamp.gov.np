<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Permission::where('title', 'like', 'subDivision_%')->get()->pluck('id');

        Role::findOrFail(1)->permissions()->sync(
            Permission::whereNotIn('id', $permissions)->get()->pluck('id')
        );

        $smuggling = Permission::where('title', 'like', 'smuggling_%')->get();

        Role::findOrFail(2)->permissions()->sync($permissions);
        Role::findOrFail(2)->permissions()->attach($smuggling);
    }
}
