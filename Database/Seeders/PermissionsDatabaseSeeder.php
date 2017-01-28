<?php
namespace Zix\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Zix\Core\Entities\Permission;
use Zix\Core\Entities\Role;

class PermissionsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'admin']);
        Permission::create(['name' => 'full_access', 'type' => 'admin']);
        Permission::create(['name' => 'view_admin', 'type' => 'admin']);

        $role->givePermissionTo('full_access');
        $role->givePermissionTo('view_admin');

        $models = ['sites', 'site_themes', 'site_configs', 'users', 'roles', 'pages', 'settings', 'forms'];
        $permissions = ['view', 'create', 'update', 'delete'];

        foreach($models as $model) {
            foreach($permissions as $permission) {
                $access = Permission::create(['name' => $permission.'_'.$model, 'type' => $model]);
                $role->givePermissionTo($access->name);
            }
        }

    }
}
