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
}
