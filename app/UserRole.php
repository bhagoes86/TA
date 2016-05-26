<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
  protected $table = 'user_role';
  public $timestamps = false;

  protected $fillable = [
    'user_id',
    'role_id',
  ];
}
