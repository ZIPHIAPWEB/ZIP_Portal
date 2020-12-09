<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;

class BlogController extends Controller
{
    public function index()
    {
        $blogs =  Blog::orderBy('created_at', 'desc')->paginate(5);

        return view('blog', ['blogs' => $blogs]);
    }

    public function view($slug)
    {
        $selectedBlog = Blog::where('slug', $slug)->first();

        return view('blog-selected', ['blog' => $selectedBlog]);
    }

    public function getAllBlogs()
    {
        return Blog::all()->map->format();
    }

    public function addBlog(Request $request)
    {
        $request->validate([
            'title'             =>  'required',
            'initial_content'   =>  'required',
            'content'           =>  'required',
            'image'             =>  'required'
        ]);

        if($request->hasFile('image')) {
            $path = $request->file('image')->storeAs('/', str_slug($request->input('title')) . '-blog' . '.' . $request->file('image')->getClientOriginalExtension(), 'uploaded_blog');
            return Blog::create([
                'title'             =>  $request->input('title'),
                'slug'              =>  str_slug($request->title, '-'),
                'initial_content'   =>  $request->input('initial_content'),
                'content'           =>  $request->input('content'),
                'image_path'        =>  $path 
            ])->format();
        } else {
            return response()->json('Error! Invalid', 500);
        }
    }

    public function updateBlog(Request $request, $slug)
    {
        if($request->hasFile('image')) {
            $updatedBlog = Blog::where('slug', $slug)->update([

            ]);
        }
    }

    public function deleteBlog($slug)
    {
        $blog = Blog::where('slug', $slug);
        \File::delete('blog_image/' . $blog->first()->image_path);
        $blog->delete();

        return response()->json(['message'  =>  'Blog Deleted!']);
    }
}
