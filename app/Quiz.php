<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table="quizs";
    protected $guard='teacher';
    protected $fillable=['name','qcount','teacher_id','category_id'];

    public function category()
    {
      return $this->belongsTo('App\Category');
    }

    public function teacher()
    {
      return $this->belongsTo('App\Teacher');
    }

    public function question()
    {
      return $this->hanMany('App\Question');
    }

    public function tfanswer()
    {
      return $this->hasMany('App\Tfanswer');
    }

    public function multianswer()
    {
      return $this->hasMany('App\Multianswer');
    }
}
