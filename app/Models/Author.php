<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = ['name', 'bio'];

    // Define relationships if needed
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
