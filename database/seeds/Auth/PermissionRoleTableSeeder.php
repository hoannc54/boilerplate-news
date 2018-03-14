<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

/**
 * Class PermissionRoleTableSeeder.
 */
class PermissionRoleTableSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();

        // Create Roles

        $admin = Role::create(['name' => config('access.users.admin_role')]);
        $admod = Role::create(['name' => 'admod']);
        $author = Role::create(['name' => 'author']);

        // Create Permissions
        Permission::create([
            'name' => 'view_backend',
        ]);

        // ALWAYS GIVE ADMIN ROLE ALL PERMISSIONS
        $admin->givePermissionTo('view backend');

        // Assign Permissions to other Roles
        $admod->givePermissionTo('view backend');
        $author->givePermissionTo('view backend');

        $this->enableForeignKeys();
    }
}
