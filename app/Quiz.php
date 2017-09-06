<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $guard='teacher';
    protected $fillable=['name','teacher_id','category_id'];

    public function category()
    {
      return $this->belongsTo('App\Category');
    }

    public function textquestion()
    {
      return $this->hanMany('App\Textquestion');
    }

    public function tfanswer()
    {
      return $this->hasMany('App\Tfanswer');
    }
}
