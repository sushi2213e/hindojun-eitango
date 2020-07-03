<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserSentence extends Pivot
{
    protected $table = 'user_sentence';
}
