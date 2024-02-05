<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alumni;

class AlumniController extends Controller
{
    public function index()
    {
        $blogs =  Alumni::orderBy('created_at', 'desc')->paginate(5);

        return view('alumni', ['blogs' => $blogs]);
    }

    public function view($slug)
    {
        $selectedBlog = Alumni::where('slug', $slug)->first();

        return view('alumni-selected', ['blog' => $selectedBlog]);
    }

    public function getAllAlumni()
    {
        return Alumni::all()->map->format();
    }

    public function addAlumniBlog(Request $request)
    {
        $request->validate([
            'title'             =>  'required',
            'initial_content'   =>  'required',
            'content'           =>  'required',
            'image'             =>  'required'
        ]);

        if($request->hasFile('image')) {
            $path = $request->file('image')->storeAs('/', str_slug($request->input('title')) . '-alumni' . '.' . $request->file('image')->getClientOriginalExtension(), 'uploaded_blog');
            return Alumni::create([
                'title'             =>  $request->input('title'),
                'slug'              =>  str_slug($request->input('title')),
                'initial_content'   =>  $request->input('initial_content'),
                'content'           =>  $request->input('content'),
                'image_path'        =>  $path
            ])->format();
        }
    }

    public function deleteAlumniBlog($slug)
    {
        $alumniBlog = Alumni::where('slug', $slug);
        \File::delete('blog_image/'. $alumniBlog->first()->image_path);
        $alumniBlog->delete();
        return response()->json(['message'  =>  'Alumni Blog Deleted.' ]);
    }
}
