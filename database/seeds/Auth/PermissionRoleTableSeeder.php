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
        $permissions = config('access.perm_list');
        foreach ($permissions as $name => $desc){
            Permission::create([
                'name' => $name,
                'desc' => $desc
            ]);
        }


        // ALWAYS GIVE ADMIN ROLE ALL PERMISSIONS
        $admin_permissions = array_keys($permissions);
        $admin->givePermissionTo($admin_permissions);

        // Assign Permissions to other Roles
        $admod_permissions = [
            ''
        ];
        $admod->givePermissionTo('view_backend');
        $author_permissions = [];
        $author->givePermissionTo('view_backend');

        $this->enableForeignKeys();
    }
}
