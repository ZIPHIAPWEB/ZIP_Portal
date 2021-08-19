<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;

class BlogImageController extends Controller
{
    public function upload(Request $request)
    {
        $blog = new Blog();
        $blog->id = 0;
        $blog->exists = true;
        $image = $blog->addMediaFromRequest('upload')
            ->toMediaCollection('blog');

        return response()->json([
            'url'   => 'http://' . $image->getUrl()
        ]);
    }
}
