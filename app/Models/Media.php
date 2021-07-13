<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'title', 'slug', 'url', 'type'];
    public function user(){
        return $this->belongsTo('App\User');
    }
}
