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
        Permission::create(['name' => 'revoke_moderator']);
        Permission::create(['name' => 'delete_article']);
        Permission::create(['name' => 'delete_comment']);
        Permission::create(['name' => 'can_see_dashboard']);
        Permission::create(['name' => 'create_delete_category']);

        Permission::create(['name' => 'revoke_admin']);

        $superadmin = Role::create(['name' => 'super-admin']);
        $superadmin->givePermissionTo('validate_article');
        $superadmin->givePermissionTo('promote_moderator');
        $superadmin->givePermissionTo('revoke_moderator');
        $superadmin->givePermissionTo('revoke_admin');
        $superadmin->givePermissionTo('delete_comment');
        $superadmin->givePermissionTo('delete_article');
        $superadmin->givePermissionTo('create_delete_category');
        $superadmin->givePermissionTo('can_see_dashboard');

        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo('validate_article');
        $admin->givePermissionTo('promote_moderator');
        $admin->givePermissionTo('revoke_moderator');
        $admin->givePermissionTo('delete_comment');
        $admin->givePermissionTo('create_delete_category');
        $admin->givePermissionTo('can_see_dashboard');

        $moderator = Role::create(['name' => 'moderator']);
        $moderator->givePermissionTo('validate_article');
        $moderator->givePermissionTo('delete_comment');
        $moderator->givePermissionTo('can_see_dashboard');


        Role::create(['name' => 'user']);
    }
}
