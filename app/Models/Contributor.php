<?php

namespace App\Models;

use App\Http\Controllers\CookieController;
use App\Models\Suggestion;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Contributor extends Model {
    use HasFactory;

    protected $guarded = [];

    public function suggesitons() {
        return $this->hasMany(Suggestion::class);
    }

    public function votes() {
        return $this->belongsToMany(Suggestion::class, 'votes');
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Generate random avatar link by contributor id.
     */
    public function getAvatar() {
        $randomInteger = $this->id % 36 + 1;
        return 'https://s.gravatar.com/avatar/'
            .md5($this->email)
            .'?s=200'
            .'&d=https://s3.amazonaws.com/laracasts/images/forum/avatars/default-avatar-'
            .$randomInteger
            .'.png';
    }

    /**
     * Return contributor id of current user.
     */
    public static function currentContributorId() {
        if (auth()->check()) {
            return auth()->user()->contributor_id;
        } elseif (CookieController::cookieIsNotSetOrChangedOrDeleted()) {
            return Crypt::decrypt(session("c_id"));
        } else {
            return Crypt::decrypt($_COOKIE["c_id"]);
        }
    }
}
