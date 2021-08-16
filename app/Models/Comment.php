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

    public function currentContributorCanEditComment() {
        if (auth()->guest()) {
            if (!isset($_COOKIE['cid'])) {
                return false;
            } else {
                return $_COOKIE['cid'] == $this->contributor_id;
            }
        }
        return true;
    }
}
