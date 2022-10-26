<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'slug',
        'category_id',
        'cover'
    ];

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    static public function getUniqueSlugFrom($title)
    {
        $slug_base = Str::slug($title);
        $slug = $slug_base;
        $post = Post::where('slug', $slug)->first();
        $counter = 1;

        while ($post) {

            $slug = $slug_base . '-' . $counter;

            $post = Post::where('slug', $slug)->first();
            $counter++;
        }

        return $slug;
    }
}
