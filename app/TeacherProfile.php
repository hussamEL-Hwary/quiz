<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeacherProfile extends Model
{
  protected $table="teachesprofile";
  protected $guard="teacher";
  protected $fillabe=[
    'address',
    'bio',
    'education',
    'avatar',
    'job',
  ];
    public function teacher()
    {
      return $this->belongsTo('App\Teacher');
    }
}
