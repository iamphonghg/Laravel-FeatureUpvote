<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model {
    use HasFactory;

    protected $guarded = [];

    public function suggestions() {
        return $this->hasMany(Suggestion::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }


}
