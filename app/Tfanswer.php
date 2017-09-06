<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tfanswer extends Model
{
    protected $guars='teacher';
    protected $fillable=['answer','question_table','question_id','quiz_id'];

    public function quiz()
    {
      return $this->belongsTo('App\Quiz');
    }
}
