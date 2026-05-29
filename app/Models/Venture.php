<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venture extends Model
{
    protected $fillable = ['title', 'role', 'description', 'image', 'link', 'order'];
}
