<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $fillable = ['name','slug'];

    public function posts() {
        return $this->belongsToMany(Post::class, 'term_relationships');
    }
}
