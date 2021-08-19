<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model {
    use HasFactory;

    protected $guarded = [];

    public function contributor() {
        return $this->belongsTo(Contributor::class);
    }
    public function suggestion() {
        return $this->belongsTo(Suggestion::class);
    }

    public function currentUserCanEditThisComment() {
        if ($this->currentContributorCanEditThisComment()) {
            return true;
        } elseif ($this->suggestion->currentAdminOwnsThisBoard()) {
            return true;
        } elseif ($this->currentAdminCreatedThisCommentButNotOwnsThisBoard()) {
            return true;
        }
        return false;
    }

    public function currentAdminCreatedThisCommentButNotOwnsThisBoard() {
        if (auth()->check() and $this->contributor_id == auth()->user()->contributor_id) {
            return true;
        }
    }

    public function currentContributorCanEditThisComment() {
        if (auth()->guest()) {
            if (!isset($_COOKIE['cid'])) {
                return false;
            } else {
                return $_COOKIE['cid'] == $this->contributor_id;
            }
        }
    }

}
