<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentProfile extends Model
{
    protected $table='studentsprofile';
    protected $guard='student';
    protected $fillable=[
      'address',
      'education',
      'bio',
      'job',
      'avatar',
    ];

    public function student()
    {
      return $this->belongsTo('App\Student');
    }
}
