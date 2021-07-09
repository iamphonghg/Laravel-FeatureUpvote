<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{

    protected $fillable = ['title', 'content', 'suggested_by'];

    public $timestamps = false;

    public function comments() {
        return $this->hasMany('App\Models\Comment');
    }

    public function votes() {
        return $this->hasMany('App\Models\Vote');
    }

    public function contributor() {
        return $this->belongsTo('App\Models\Contributor');
    }
    public function board() {
        return $this->belongsTo('App\Models\Board');
    }
}
