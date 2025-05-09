<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Entities\User;

class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => ADMIN_ROLE]);
        Role::create(['name' => USER_ROLE]);
        Role::create(['name' => VIEWER_ROLE]);

        Permission::create(['name' => VIEW_CARRIER]);

        Permission::create(['name' => MANAGE_USERS]);
        Permission::create(['name' => MANAGE_CARRIER]);
        Permission::create(['name' => VIEW_ADD_CARRIER]);


        /** @var User $superAdmin */
        $superAdmin = User::find(1);
        $superAdmin->givePermissionTo(Permission::all()->pluck('id'));
    }
}
