<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Permission;
use App\Role;
use App\User;

class PermissionController extends Controller
{
    public function Permission(Request $request)
    {
        if ($request->user()->hasRole('administrator')) {

            $users = User::all();
            foreach ($users as $user) {
                $user->delete();
            }

            $roles = Role::all();
            foreach ($roles as $role) {
                $role->delete();
            }

            $permissions = Permission::all();
            foreach ($permissions as $permission) {
                $permission->delete();
            }

            $create_post = Permission::where('slug', 'create-posts')->first();
            $create_category = Permission::where('slug', 'create-category')->first();
            $manager = Permission::where('slug', 'all-permissions')->first();

            //RoleTableSeeder.php
            $cp_role = new Role();
            $cp_role->slug = 'provider';
            $cp_role->name = 'Content provider';
            $cp_role->save();
            $cp_role->permissions()->attach($create_post);

            $cm_role = new Role();
            $cm_role->slug = 'manager';
            $cm_role->name = 'Content Manager';
            $cm_role->save();
            $cm_role->permissions()->attach($create_category);
            $cm_role->permissions()->attach($create_post);

            $admin_role = new Role();
            $admin_role->slug = 'administrator';
            $admin_role->name = 'Administrator';
            $admin_role->save();
            $admin_role->permissions()->attach($create_category);
            $admin_role->permissions()->attach($create_post);
            $admin_role->permissions()->attach($manager);

            $cp_role = Role::where('slug', 'provider')->first();
            $cm_role = Role::where('slug', 'manager')->first();
            $admin_role = Role::where('slug', 'administrator')->first();

            // permissions

            $createPost = new Permission();
            $createPost->slug = 'create-posts';
            $createPost->name = 'Create Posts';
            $createPost->save();
            $createPost->roles()->attach($cp_role);

            $createCategory = new Permission();
            $createCategory->slug = 'create-category';
            $createCategory->name = 'Create Category';
            $createCategory->save();
            $createCategory->roles()->attach($cm_role);

            $allPermissions = new Permission();
            $allPermissions->slug = 'all-permissions';
            $allPermissions->name = 'All Permissions';
            $allPermissions->save();
            $allPermissions->roles()->attach($admin_role);

            $cp_role = Role::where('slug', 'provider')->first();
            $cm_role = Role::where('slug', 'manager')->first();
            $admin_role = Role::where('slug', 'administrator')->first();

            $content_provider = new User();
            $content_provider->name = 'Khan';
            $content_provider->email = 'khan@xala.no';
            $content_provider->password = bcrypt('rta2020');
            $content_provider->save();
            $content_provider->roles()->attach($cp_role);
            $content_provider->permissions()->attach($createPost);

            $manager = new User();
            $manager->name = 'Ibrahim';
            $manager->email = 'ibrahim@xala.no';
            $manager->password = bcrypt('rta2020');
            $manager->save();
            $manager->roles()->attach($cm_role);
            $manager->permissions()->attach($createPost);
            $manager->permissions()->attach($createCategory);

            $admin = new User();
            $admin->name = 'RTA';
            $admin->email = 'rta@rta.af';
            $admin->password = bcrypt('rta2020');
            $admin->save();
            $admin->roles()->attach($admin_role);
            $admin->permissions()->attach($createPost);
            $admin->permissions()->attach($createCategory);
            $admin->permissions()->attach($allPermissions);
        }

        return redirect()->back();
    }
}
