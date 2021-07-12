<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // create roles for users
    $superAdmin = Role::updateOrCreate(['name' => 'super admin']);
    $admin = Role::updateOrCreate(['name' => 'admin']);
    $user = Role::updateOrCreate(['name' => 'user']);

    $permissions = Permission::all();

    //create roles and assign existing permissions
    $superAdmin->syncPermissions($permissions);
  }
}
