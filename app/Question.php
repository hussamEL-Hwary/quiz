<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table='questions';
    protected $guard='teacher';
    protected $fillable=['quiz_id','question','answer_type'];

    public function quiz()
    {
      return $this->belongsTo('App\Quiz');
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
