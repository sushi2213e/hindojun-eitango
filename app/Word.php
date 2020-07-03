<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    public function folders() {
      return $this->belongsTo('App\Folder');
    }

    public function minifolders() {
      return $this->belongsTo('App\Minifolder');
    }
}
