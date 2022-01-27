<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Changelogs extends Model
{
    use HasFactory;
    protected $fillable = [
        'reason',
        'previously',
        'user_id',
        'practice_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function practice()
    {
        return $this->belongsTo(Practice::class);
    }
}
