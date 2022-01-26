<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'slug'
    ];
    public function practices()
    {
        return $this->hasMany(Practice::class);
    }
    public function practicesSortedByStatus()
    {
        return $this->hasMany(Practice::class)->orderBy("publication_state_id");
    }
    public function publishedPractices()
    {
        return $this->practices->filter(function ($p) {
            return $p->publicationState->slug == "PUB";
        });
    }
    public static function getSlugs()
    {
        return Domain::all()->pluck("slug");
    }
}
