<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class BlogController extends Controller
{
    public function getIndex()
    {
        $posts = Post::paginate(10);

        return view('blog.index')->withPosts($posts);

    }

    public function getSingle($slug)
    {
        //Fetch from the DB based on @slug
        $post = Post::where('slug', '=', $slug)->first();

        //Return the View and pass in the Post object
        return view('blog.single')->withPost($post);

    }
}
