<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 
        'content',
        'status',
        'slide_url'
    ];

    protected $appends = [
        'image_full_path',
    ];

    public function getImageFullPathAttribute()
    {
        return $this->slide_url ?? '';
    }
}
