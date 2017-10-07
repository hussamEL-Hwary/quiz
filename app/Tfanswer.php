<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tfanswer extends Model
{
    protected $table='tfanswers';
    protected $guars='teacher';
    protected $fillable=['answer','question_id','quiz_id'];

    public function quiz()
    {
      return $this->belongsTo('App\Quiz');
    }

    public function question()
    {
      return $this->belongsTo('App\Question');
    }
}
