<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'initial_content',
        'content',
        'image_path'
    ];

    public function format()
    {
        return [
            'id'                =>  $this->id,
            'title'             =>  $this->title,
            'slug'              =>  $this->slug,
            'initial_content'   =>  $this->initial_content,
            'content'           =>  $this->content,
            'image_path'        =>  url('blog_image/' . $this->image_path),
            'created_at'        =>  $this->created_at->diffForHumans()
        ];
    }
}
