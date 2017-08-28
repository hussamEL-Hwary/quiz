<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class StudentSocial extends Authenticatable
{

  use Notifiable;
  protected $guard="student";

  protected $fillable = [
    'teacher_id','provider','social_id',
  ];

  protected $table='studentlogins';
  public function student()
  {
    return $this->belongsTo('App\Student');
  }

}
