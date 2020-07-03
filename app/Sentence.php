<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sentence extends Model
{
    public function users() {
      return $this->belongsToMany('App\User', 'user_sentence', 'sentence_id', 'user_id')
                      ->using('App\UserSentence')
                      ->withPivot('id', 'achieve', 'accomplish');
    }
}
