<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contributor extends Model
{
    protected $fillable = ['name', 'email', 'shop_name'];
    public $timestamps = false;

    public function comments() {
        return $this->hasMany('App\Models\Comment');
    }

    public function suggestions() {
        return $this->hasMany('App\Models\Suggestion');
    }
}
