<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Review;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['name','description','duration','user_id'];

    function user(){
        return $this->belongsTo(User::class);
    }
    
    function student(){
        return $this->belongsToMany(User::class);
    }

    function reviews(){
        return $this->hasMany(Review::class);
    }
}
