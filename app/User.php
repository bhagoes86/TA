<?php

namespace App;

use App\Date;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
  use Authenticatable, CanResetPassword;

  protected $table = 'user';

  protected $fillable = [
    'id_pkk',
    'id_posyandu',
    'username',
    'last_login',
    'permissions',
  ];
  protected $hidden = [
    'password',
    'remember_token',
  ];

  public function pkk() {
    return $this->belongsTo( 'App\PkkData', 'id_pkk' );
  }

  public function roles() {
    return $this->belongsToMany( 'App\Role', 'user_role', 'user_id', 'role_id' );
  }

  /**
   * get user last_login attribute in Indonesian date format
   *
   * @param  string $value      last_login real value
   * @return string             last_login in Indonesia date format
   */
  public function getLastLoginAttribute( $value ) {
    return Date::indonesian_date( $value );
  }
}
