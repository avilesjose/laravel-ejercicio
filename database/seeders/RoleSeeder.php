<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        Permission::create(['name' => 'posts.create']);
        Permission::create(['name' => 'posts.edit']);
        Permission::create(['name' => 'posts.trash']);
        Permission::create(['name' => 'comments.create']);
        Permission::create(['name' => 'comments.edit']);
        Permission::create(['name' => 'comments.trash']);

        // Create roles and assign existing permissions
        $publisher = Role::create(['name' => 'publisher']);
        $publisher->givePermissionTo(Permission::all());

        // Gets all permissions via Gate::before rule; see AuthServiceProvider
        $admin = Role::create(['name' => 'admin']);
    }
}
