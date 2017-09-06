<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

  protected $guard='teacher';
  protected $fillable= ['teacher_id','name'];

  public function teacher()
  {
    return $this->belongsTo('App\Teacher');
  }

  public function quiz()
  {
    return $this->hasMany('App\Quiz'); 
  }

}
