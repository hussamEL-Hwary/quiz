<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Multianswer extends Model
{
    protected $table='multichose';
    protected $guard='teacher';
    protected $fillable=['quiz_id','question_id','answer1','answer2','answer3','answer4','correct_answer'];

    public function quiz()
    {
      return $this->belongsTo('App\Quiz');
    }

    public function question()
    {
      return $this->belongsTo('App\Question');
    }
}
