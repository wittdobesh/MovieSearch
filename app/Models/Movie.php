<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Actor;

class Movie extends Model
{
    protected $fillable = ['title', 'overview', 'release_date', 'runtime', 'cast'];

}
