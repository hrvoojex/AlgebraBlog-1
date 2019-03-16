<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'body', 'user_id'];
   // protected $guarded = ['id', 'payment_key'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public static function archives(){
        
        return static::selectRaw('year(created_at) as year,  monthname(created_at) as month, count(*) as published_posts')
        ->groupBy('year', 'month')
        ->orderByRaw('min(created_at) desc')
        ->get();
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

}
