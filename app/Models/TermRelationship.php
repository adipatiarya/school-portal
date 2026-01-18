<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TermRelationship extends Model {
    protected $fillable = ['taxonomy_id', 'object_id'];

    public function taxonomy() {
        return $this->belongsTo(Taxonomy::class);
    }
}
