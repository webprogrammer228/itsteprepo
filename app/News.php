<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $primaryKey='id';
    protected $table='news';
    protected $fillable = ['summary', 'short_description', 'full_description', 'created_at', 'updated_at'];
}
