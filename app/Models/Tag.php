<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name'];

    // In the Tag model
    public function posts() // Plural 'posts'
    {
        return $this->belongsToMany(Post::class);
    }


}
