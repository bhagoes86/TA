<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    User::create( [
      'username' => 'admin',
      'password' => Hash::make( 'admin' ),
    ] )->roles()->attach( Role::where( 'slug', 'admin' )->first()->id );
  }
}
