<?php

namespace App\Models;

use App\Models\Contributor;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function PHPUnit\Framework\returnSelf;

class Suggestion extends Model {
    use HasFactory, Sluggable;

    protected $guarded = [];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function contributor() {
        return $this->belongsTo(Contributor::class);
    }

    public function votes() {
        return $this->belongsToMany(Contributor::class, 'votes');
    }

    public function getStatusClasses() {
        $allStatuses = [
            'Awaiting' => 'bg-gray-200',
            'Considering' => 'bg-blue text-white',
            'Planned' => 'bg-purple text-white',
            'Not planned' => 'bg-yellow text-white',
            'Done' => 'bg-green text-white',
            'Deleted' => 'bg-red text-white'
        ];
        return $allStatuses[$this->status];
    }

    public function isVotedByThisBrowser() {
        if (isset($_COOKIE["voted_suggestion_list"])) {
            $suggestionId = $this->id;
            if (strpos($_COOKIE["voted_suggestion_list"], "sgt$suggestionId") !== false) {
                return true;
            }
        }
        return false;
    }

    public function vote() {
        if (!isset($_COOKIE["voted_suggestion_list"])) {
            setcookie("voted_suggestion_list", "list:||", time() + 86400 * 365, "/");
        }
        $vote = Vote::factory()->create([
            'suggestion_id' => $this->id,
            'contributor_id' => $this->contributorOfThisBrowser(),
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);
        $this->updateVotedSuggestionListCookie('vote', $this->id, $vote->id);
    }

    public function removeVote() {
        if (!isset($_COOKIE["voted_suggestion_list"])) {
            setcookie("voted_suggestion_list", "list:||", time() + 86400 * 365, "/");
        }
        $votes = explode("||", $_COOKIE["voted_suggestion_list"]);
        $voteId = 0;
        for ($i = 1; $i < count($votes); $i++) {
            if (strpos($votes[$i], "sgt$this->id-") !== false) {
                $voteId = explode("-vid", $votes[$i])[1];
                break;
            }
        }
        Vote::find($voteId)->delete();
        $this->updateVotedSuggestionListCookie('removeVote', $this->id, $voteId);
    }

    public function contributorOfThisBrowser() {
        if (!isset($_COOKIE["cid"])) {
            return 0;
        }
        return $_COOKIE["cid"];
    }

    public function updateVotedSuggestionListCookie($action, $suggestionId, $voteId) {
        if ($action == 'vote') {
            $newCookie = $_COOKIE["voted_suggestion_list"] . "sgt$suggestionId-vid$voteId||";
            setcookie("voted_suggestion_list", $newCookie, time() + 86400 * 365, "/");
        } else {
            $newCookie = str_replace("|sgt$suggestionId-vid$voteId|", "", $_COOKIE["voted_suggestion_list"]);
            setcookie("voted_suggestion_list", $newCookie, time() + 86400 * 365, "/");
        }
    }

}
