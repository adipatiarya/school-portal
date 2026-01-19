<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Taxonomy extends Model {
    protected $fillable = ['term_id', 'taxonomy'];
    protected $hidden = ['description'];

    public function term() {
        return $this->belongsTo(Term::class);
    }

    public function relationships() {
        return $this->hasMany(TermRelationship::class);
    }
}
