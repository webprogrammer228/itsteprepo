<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sound extends Model
{
    protected $fillable = ['title', 'artist', 'category', 'imagePath', 'soundPath'];
    use HasFactory;

    public function sound()
    {
        return $this->belongsTo(Claim::class);
    }
}
