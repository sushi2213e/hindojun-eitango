<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    public function minifolders() {
      return $this->hasMany('App\Minifolder');
    }

    public function words() {
      return $this->hasMany('App\Word');
    }
}
