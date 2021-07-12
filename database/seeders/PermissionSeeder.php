<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // create permissions
    $permissions = [
      ['name' => 'access users'],
      ['name' => 'create users'],
      ['name' => 'show users'],
      ['name' => 'edit users'],
      ['name' => 'delete users'],

      ['name' => 'access roles'],
      ['name' => 'create roles'],
      ['name' => 'show roles'],
      ['name' => 'edit roles'],
      ['name' => 'delete roles'],

      ['name' => 'access permissions'],
      ['name' => 'create permissions'],
      ['name' => 'show permissions'],
      ['name' => 'edit permissions'],
      ['name' => 'delete permissions'],
    ];

    foreach ($permissions as $permission) {
      Permission::updateOrCreate(['name' => $permission['name']], $permission);
    }
  }
}
