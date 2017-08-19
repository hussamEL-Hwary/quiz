<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class TeacherSocial extends Authenticatable
{

  use Notifiable;
  protected $guard="teacher";

  protected $fillable = [
    'teacher_id','provider','social_id',
  ];

  protected $table='TeacherSocialLogins';
  public function teacher()
  {
    return $this->belongsTo('App\Teacher');
  }

}
