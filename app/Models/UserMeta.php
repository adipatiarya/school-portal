<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{
    protected $fillable = ['user_id','meta_key','meta_value'];
    protected $table = 'user_meta';

    public function user() {
        return $this->belongsTo(User::class);
    }
}
