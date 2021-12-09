<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Practice extends Model
{
    use HasFactory;
    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }

    public function publicationState()
    {
        return $this->belongsTo(PublicationState::class);

    }
    public static function allPublished(){
        return self::whereHas('publicationState', fn ($ps) => $ps->where('slug', 'PUB'))
        ->get();
    }
    public static function publishedModifiedOnes($nbdays){
        return self::whereHas('publicationState', fn ($ps) => $ps->where('slug', 'PUB'))
        ->where('updated_at', '>', Carbon::now()->subDays($nbdays))
        ->get();
    }
}
