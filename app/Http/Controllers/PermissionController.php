<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Permission;
use App\Role;
use App\User;

class PermissionController extends Controller
{
    public function Permission()
    {
        $dev_permission = Permission::where('slug', 'create-posts')->first();
        $creae_category_permission = Permission::where('slug', 'create-category')->first();
        $manager_permission = Permission::where('slug', 'edit-users')->first();

        //RoleTableSeeder.php
        $dev_role = new Role();
        $dev_role->slug = 'developer';
        $dev_role->name = 'Front-end Developer';
        $dev_role->save();
        $dev_role->permissions()->attach($dev_permission);

        $manager_role = new Role();
        $manager_role->slug = 'manager';
        $manager_role->name = 'Assistant Manager';
        $manager_role->save();
        $manager_role->permissions()->attach($manager_permission);
        $manager_role->permissions()->attach($creae_category_permission);

        $dev_role = Role::where('slug', 'developer')->first();
        $manager_role = Role::where('slug', 'manager')->first();

        $createTasks = new Permission();
        $createTasks->slug = 'create-posts';
        $createTasks->name = 'Create Posts';
        $createTasks->save();
        $createTasks->roles()->attach($dev_role);

        $editUsers = new Permission();
        $editUsers->slug = 'edit-users';
        $editUsers->name = 'Edit Users';
        $editUsers->save();
        $editUsers->roles()->attach($manager_role);

        $editUsers = new Permission();
        $editUsers->slug = 'create-category';
        $editUsers->name = 'Create Category';
        $editUsers->save();
        $editUsers->roles()->attach($manager_role);

        $dev_role = Role::where('slug', 'developer')->first();
        $manager_role = Role::where('slug', 'manager')->first();
        $dev_perm = Permission::where('slug', 'create-posts')->first();
        $manager_perm = Permission::where('slug', 'edut-user')->first();
        $manager_perm_category = Permission::where('slug', 'create-category')->first();

        $developer = new User();
        $developer->name = 'Ibrahim';
        $developer->email = 'ibrahim@xala.no';
        $developer->password = bcrypt('secrettt');
        $developer->save();
        $developer->roles()->attach($dev_role);
        $developer->permissions()->attach($dev_perm);

        $manager = new User();
        $manager->name = 'RTA';
        $manager->email = 'rta@rta.af';
        $manager->password = bcrypt('secrettt');
        $manager->save();
        $manager->roles()->attach($manager_role);
        $manager->permissions()->attach($manager_perm);
        $manager->permissions()->attach($manager_perm_category);


        return redirect()->back();
    }
}
