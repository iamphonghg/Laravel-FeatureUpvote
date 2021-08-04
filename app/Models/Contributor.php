<?php

namespace App\Models;

use App\Models\Suggestion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contributor extends Model
{
    use HasFactory;

    public function suggesitons() {
        return $this->hasMany(Suggestion::class);
    }
}
