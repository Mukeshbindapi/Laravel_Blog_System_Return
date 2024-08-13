<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;
// use App\Models\Category;
use App\Models\Gallery;

class Post extends Model
{
    use HasFactory;

    public const PUBLISHED = 1;
    public const DRAFT = 0;

    protected $fillable = [
        'gallery_id',
        'user_id',
        'category_id',
        'title',
        'description',
        'status'
    ];

    // public function tags()
    // {
    //     return $this->belongsToMany(Tag::class);
    // }

    public function Category(){
        return $this->belongsTo(Category::class); //'category_id','id'
    }

    public function user(){
        return $this->belongsTo(User::class); //'user_id','id'
    }

    public function gallery()
    {
        return $this->belongsTo(Gallery::class); //'gallery_id','id'

    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

}
