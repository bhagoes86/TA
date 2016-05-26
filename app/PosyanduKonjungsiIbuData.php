<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PosyanduKonjungsiIbuData extends Model
{
  protected $table = 'posyandu_konjungsi_ibu_data';

  protected $fillable = [
    'id_posyandu',
    'id_ibu'
  ];
}
