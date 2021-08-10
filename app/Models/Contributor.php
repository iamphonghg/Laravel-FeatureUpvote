<?php

namespace App\Models;

use App\Models\Suggestion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contributor extends Model {
    use HasFactory;

    protected $guarded = [];

    public function suggesitons() {
        return $this->hasMany(Suggestion::class);
    }

    public function votes() {
        return $this->belongsToMany(Suggestion::class, 'votes');
    }

    public function getAvatar() {
        $randomInteger = $this->id % 36 + 1;
        return 'https://s.gravatar.com/avatar/'
            .md5($this->email)
            .'?s=200'
            .'&d=https://s3.amazonaws.com/laracasts/images/forum/avatars/default-avatar-'
            .$randomInteger
            .'.png';
    }
}
