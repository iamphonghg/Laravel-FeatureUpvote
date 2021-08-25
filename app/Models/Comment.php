<?php

namespace App\Models;

use App\Http\Controllers\CookieController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Comment extends Model {
    use HasFactory;

    protected $guarded = [];

    public function contributor() {
        return $this->belongsTo(Contributor::class);
    }
    public function suggestion() {
        return $this->belongsTo(Suggestion::class);
    }

    /**
     * Check if the current user can edit this comment.
     * There are 3 objects: admin who owns this board, admin who doesn't own this board, and normal user.
     */
    public function currentUserCanEditThisComment() {
        if ($this->suggestion->currentAdminOwnsThisBoard()) {
            return true;
        } elseif ($this->currentAdminCanEditThisComment()) {
            return true;
        } elseif ($this->currentNormalUserCanEditThisComment()) {
            return true;
        }
    }

    /**
     * Check if an admin who doesn't own this board can edit this comment.
     */
    public function currentAdminCanEditThisComment() {
        return auth()->check()
            and auth()->user()->contributor_id == $this->contributor_id;
    }

    /**
     * Check if the current normal user can edit this comment.
     */
    public function currentNormalUserCanEditThisComment() {
        if (! CookieController::cookieIsNotSetOrChangedOrDeleted()) {
            $contributorId = Crypt::decrypt($_COOKIE["c_id"]);
            return $contributorId == $this->contributor_id;
        }
    }

}
