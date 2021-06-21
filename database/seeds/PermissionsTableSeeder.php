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
    public $list = ['dashboards.index','settings.index','profile','generalInfo','changeImage'
                    ,'changePassword','site.profile','site.generalInfo','site.changeImage'
                    ,'site.changePassword'];
    
    public $researcher = ['researcher.home'];
    
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
        
        foreach($this->list as $i)
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
                'name' => $i,
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
