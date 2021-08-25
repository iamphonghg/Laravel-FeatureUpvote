<?php

namespace App\Models;

use App\Http\Controllers\CookieController;
use App\Models\Contributor;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Crypt;

class Suggestion extends Model {
    use HasFactory, Sluggable;

    protected $guarded = [];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function board() {
        return $this->belongsTo(Board::class);
    }
    public function contributor() {
        return $this->belongsTo(Contributor::class);
    }
    public function votes() {
        return $this->belongsToMany(Contributor::class, 'votes');
    }
    public function comments() {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get the background color class for this suggestion's status label.
     */
    public function getStatusClasses() {
        $allStatuses = [
            'awaiting' => 'bg-gray-600',
            'considering' => 'bg-blue',
            'planned' => 'bg-purple',
            'not_planned' => 'bg-yellow',
            'done' => 'bg-green',
            'deleted' => 'bg-red'
        ];
        return $allStatuses[$this->status];
    }

    /**
     * Get the border color class for each row of suggestion list (in suggestion manager).
     */
    public function getTableBorderClasses() {
        $allStatuses = [
            'awaiting' => 'border-gray-600',
            'considering' => 'border-blue',
            'planned' => 'border-purple',
            'not_planned' => 'border-yellow',
            'done' => 'border-green',
            'deleted' => 'border-red'
        ];
        return $allStatuses[$this->status];
    }

    /**
     * Check if this suggestion has been voted by the current user.
     */
    public function isVotedByCurrentUser() {
        if (auth()->check()) {
            return $this->votes()->where('contributor_id', auth()->user()->contributor_id)
                ->exists();
        } else{
            if (! CookieController::cookieIsNotSetOrChangedOrDeleted()) {
                $contributorId = Crypt::decrypt($_COOKIE["c_id"]);
                return $this->votes()->where('contributor_id', $contributorId)
                    ->exists();
            }
        }
        return false;
    }

    /**
     * Create a vote if the current suggestion has not been voted by the current user.
     */
    public function vote() {
        if ($this->isVotedByCurrentUser()) {
            return;
        }
        try {
            Vote::factory()->create([
                'suggestion_id' => $this->id,
                'contributor_id' => Contributor::currentContributorId(),
                'ip' => request()->ip(),
                'user_agent' => request()->userAgent()
            ]);
        } catch (QueryException $e) {
            // do nothing
        }
    }

    /**
     * Remove vote if the current suggestion is voted by the current user.
     */
    public function removeVote() {
        if (! $this->isVotedByCurrentUser()) {
            return;
        }

        $voteToDelete = Vote::where('suggestion_id', $this->id)
                        ->where('contributor_id', Contributor::currentContributorId())
                        ->first();
        if ($voteToDelete) {
            $voteToDelete->delete();
        }
    }

    /**
     * Comments with deleted status will not be counted.
     */
    public function countCommentForNormalUser() {
        return $this->comments()->where([
            ['status', '!=', 'deleted']
        ])->count();
    }

    /**
     * All comments will be counted.
     */
    public function countCommentForAdmin() {
        return $this->comments->count();
    }

    /**
     * Check if the current user can edit this suggestion.
     * There are 3 objects: admin who owns this board, admin who doesn't own this board, and normal user.
     */
    public function currentUserCanEditThisSuggestion() {
        if ($this->currentAdminOwnsThisBoard()) {
            return true;
        } elseif ($this->currentAdminCanEditThisSuggestion()) {
            return true;
        } elseif ($this->currentNormalUserCanEditThisSuggestion()) {
            return true;
        }
    }

    /**
     * This system has many admins, this function checks if the current admin owns this board.
     * The admin who owns this board has full control over suggestions and comments.
     */
    public function currentAdminOwnsThisBoard() {
        return auth()->check()
            and $this->board->user_id == auth()->id();
    }

    /**
     * Check if an admin who doesn't own this board can edit this suggestion.
     */
    public function currentAdminCanEditThisSuggestion() {
        return auth()->check()
            and auth()->user()->contributor_id == $this->contributor_id
            and now()->subHour() <= $this->created_at;
    }

    /**
     * Check if the current normal user can edit this suggestion.
     */
    public function currentNormalUserCanEditThisSuggestion() {
        if (! CookieController::cookieIsNotSetOrChangedOrDeleted()) {
            $contributorId = Crypt::decrypt($_COOKIE["c_id"]);
            return $contributorId == $this->contributor_id
                and now()->subHour() <= $this->created_at;
        }
    }



}
