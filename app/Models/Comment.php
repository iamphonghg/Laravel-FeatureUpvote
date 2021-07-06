<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $fillable = ['content'];
    public $timestamps = false;

    public function suggestion() {
        return $this->belongsTo('App\Models\Suggestion');
    }

    public function contributor() {
        return $this->belongsTo('App\Models\Contributor');
    }
}
