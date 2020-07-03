<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Minifolder extends Model
{
    public function folders() {
      return $this->belongsTo('App\Folder');
    }

    public function words() {
      return $this->hasMany('App\Words');
    }
}
