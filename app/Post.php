<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'post',
        'posttype',
        'posttitle',
        'author',
        'editauthor',
        // 'created_at',
        // 'updated_at'
    ];

    public function getShortpostAttribute() 
    {
        return substr_replace($this->post, '...', 100);
    }

    public function getShorttitleAttribute() 
    {
        return substr_replace($this->posttitle, '...', 28);
    }

    public function custompost($size)
    {
        return substr_replace($this->post, '...', $size);
    }
}
