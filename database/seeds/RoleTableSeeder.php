<?php

use Illuminate\Database\Seeder;

use App\Role;

class RoleTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Role::create( [
      'name' => 'Administrator',
      'slug' => 'admin',
    ] );

    Role::create( [
      'name' => 'Pengurus PKK',
      'slug' => 'pkk',
    ] );

    Role::create( [
      'name' => 'Pengurus Posyandu',
      'slug' => 'posyandu',
    ] );
  }
}
