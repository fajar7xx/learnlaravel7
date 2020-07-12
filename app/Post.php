<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = [
        'title',
        'slug',
        'body',
        'category_id',
        'user_id',
        'thumbnail'
    ];

    // penggunaan laravel eager loading d model
    protected $with = [
        'category',
        'tags',
        'author'
    ];

    // bahaya jika menggunakan ini karena bisa
    // manipulasi semua data
    // protected $guarded = [];
    
    // scope funcion
    public function scopeLatestFirst()
    {
        return $this->latest()->first();
    }

    // relatiionship
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getPostImageAttribute()
    {
        if($this->thumbnail){
            return "/storage/" . $this->thumbnail;
        }else{
            return "https://dummyimage.com/600x400/000/fff";
        }
    }

    
}
