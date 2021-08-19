<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model {
    use HasFactory;

    protected $guarded = [];

    public function countAllComment() {
        $suggestions = $this->suggestions;
        $commentsCount = 0;
        if ($suggestions->isNotEmpty()) {
            foreach ($suggestions as $suggestion) {
                $commentsCount += $suggestion->comments->count();
            }
        }
        return $commentsCount;
    }

    public function countPendingComment() {
        $suggestions = $this->suggestions;
        $commentsCount = 0;
        if ($suggestions->isNotEmpty()) {
            foreach ($suggestions as $suggestion) {
                $commentsCount += $suggestion->comments()
                    ->where('status', 'awaiting')
                    ->count();
            }
        }
        return $commentsCount;
    }

    public function countPendingSuggestion() {
        return $this->suggestions()
            ->where('status', 'awaiting')
            ->count();
    }

    public function countVote() {
        $suggestions = $this->suggestions;
        $votesCount = 0;
        if ($suggestions->isNotEmpty()) {
            foreach ($suggestions as $suggestion) {
                $votesCount += $suggestion->votes->count();
            }
        }
        return $votesCount;

    }

    public function suggestions() {
        return $this->hasMany(Suggestion::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
}
