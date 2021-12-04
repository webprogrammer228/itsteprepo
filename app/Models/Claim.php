<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    protected $fillable = ['reason', 'claimbody'];
    use HasFactory;

    public function claim()
    {
        return $this->hasMany(Sound::class);
    }
}
