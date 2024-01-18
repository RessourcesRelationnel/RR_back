<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Permission::create(['name' => 'validate_article']);
        Permission::create(['name' => 'promote_moderator']);
        Permission::create(['name' => 'promote_admin']);
        Permission::create(['name' => 'delete_article']);
        Permission::create(['name' => 'delete_comment']);


            $superadmin = Role::create(['name' => 'super-admin']);
            $superadmin->givePermissionTo('validate_article');
            $superadmin->givePermissionTo('promote_moderator');
            $superadmin->givePermissionTo('promote_admin');
            $superadmin->givePermissionTo('delete_comment');
            $superadmin->givePermissionTo('delete_article');

            $admin = Role::create(['name' => 'admin']);
            $admin->givePermissionTo('validate_article');
            $admin->givePermissionTo('promote_moderator');
            $admin->givePermissionTo('delete_comment');

            $moderator = Role::create(['name' => 'moderator']);
            $moderator->givePermissionTo('validate_article');
            $moderator->givePermissionTo('delete_comment');


            Role::create(['name' => 'user']);
    }
}
