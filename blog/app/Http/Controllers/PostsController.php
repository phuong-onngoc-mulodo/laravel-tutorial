<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

class PostsController extends Controller
{
    public function index()
    {
      //$posts = Post::all();
      $posts = Post::orderBy('created_at', 'desc')->get();
      return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
      //$post = Post::find($id);
      return view('posts.show', compact('post'));
    }

    public function create()
    {
      return view('posts.create');
    }

    public function store()
    {
      //dd(request(['title', 'body']));
      $this->validate(request(), [
        'title' => /*'required|max:10'*/'required',
        'body' => 'required'
      ]);
      // Create a new post using the request data
      //$post = new Post;

      //$post->title = request('title');
      //$post->body = request('body');

      // Save it to the database
      //$post->save();
      Post::create(request(['title', 'body']));
      /*Post::create([
        'title' => request('title'),
        'body' => request('body')
      ]);*/

      // And then redirect to the home page
      return redirect('/');
    }
}
