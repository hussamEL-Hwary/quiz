<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Textquestion extends Model
{
    protected $guard='teacher';
    protected $fillable=['content','quiz_id'];

    public function quiz()
    {
      return $this->belongsTo('App\Quiz');
    }
}
