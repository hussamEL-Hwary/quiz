<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\StudentResetPasswordNotification;

class student extends Authenticatable
{
  use Notifiable;
  protected $gured="student";
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'first_name','last_name', 'email', 'password','birthday','activated','token',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
      'password', 'remember_token',
  ];

  public function social()
  {
    return $this->hasMany('App\StudentSocial');
  }

  public function sendPasswordResetNotification($token)
  {
      $this->notify(new StudentResetPasswordNotification($token));
  }



}
