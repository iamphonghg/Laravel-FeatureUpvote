<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    public $timestamps = false;

    protected $fillable = ['suggestion_id', 'ip', 'name_and_email', 'user_agent'];

    public function suggestion() {
        return $this->belongsTo('App\Models\Suggestion');
    }
}
