<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    protected $fillable = ['board_name', 'short_name'];
    public $timestamps = false;

    public function suggestions() {
        return $this->hasMany('App\Models\Suggestion');
    }
}
