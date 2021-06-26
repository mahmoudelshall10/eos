<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public $admin = ['dashboards.index','settings.index','profile','generalInfo','changeImage','changePassword','projects.updatePermission'];
    
    public $researcher = [
        'home','workspaces.index','workspaces.create','workspaces.edit','workspaces.destroy',
        'workspaces.files.index','workspaces.files.create','workspaces.files.edit',
        'workspaces.files.destroy','researcher.filespermissions.index'
        ,'researcher.filespermissions.create'
        ,'researcher.filespermissions.show'
        ,'researcher.filespermissions.edit'
        ,'researcher.filespermissions.destroy'
    ];

    public $user       = ['user.home'];


    public function run()
    {
        $role = Role::find(1);

        foreach (config('permission.modules') as $module) {

            foreach (config('permission.permissions') as $permission) {

                $permission = Permission::create([
                    'name' => 'admin.' . $module . '.' . $permission,
                    'guard_name' => 'web'
                ]);

                $role->permissions()->save($permission);
            }
        }
        
        foreach($this->admin as $i)
        {
            $permission = Permission::create([
                'name' => 'admin.' . $i,
                'guard_name' => 'web'
                ]);

            $role->permissions()->save($permission);
        }
        
        $role2 = Role::find(2);
        
        foreach($this->researcher as $i)
        {
            $permission = Permission::create([
                'name' => 'researcher.' . $i,
                'guard_name' => 'web'
                ]);

            $role2->permissions()->save($permission);
        }

        $role3 = Role::find(3);

        foreach($this->user as $i)
        {
            
            $permission = Permission::create([
                'name' => $i,
                'guard_name' => 'web'
                ]);

            $role3->permissions()->save($permission);
        }

    }
}
