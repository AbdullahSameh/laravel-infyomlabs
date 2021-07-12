<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $superAdmin =  User::updateOrCreate([
      'email' => 'admin@admin.com',
    ], [
      'name' => 'Super Admin',
      'password' => bcrypt('admin123'),
      'email_verified_at' => now(),
    ]);

    if (!$superAdmin->hasRole('super admin')) {
      $superAdmin->assignRole('super admin');
    }

    $permissions = Permission::all();

    $superAdmin->syncPermissions($permissions);
  }
}
