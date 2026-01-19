<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title','content','type','author_id','status'];

    public function author() {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function meta() {
        return $this->hasMany(PostMeta::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function terms() {
        return $this->belongsToMany(Term::class, 'term_relationships', 'object_id', 'taxonomy_id');

    }
    public function categories()
    {
        return $this->belongsToMany(Taxonomy::class, 'term_relationships', 'object_id', 'taxonomy_id')
                    ->where('taxonomy', 'category');
    }

    public function tags()
    {
        return $this->belongsToMany(Taxonomy::class, 'term_relationships', 'object_id', 'taxonomy_id')
                    ->where('taxonomy', 'tag');
    }



    public function scopePublished($query)
    {
        return $query->where('status', 'publish');
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }


}