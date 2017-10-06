<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Repositories\Posts;
use Carbon\Carbon;

class PostsController extends Controller
{
  public function __contruct()
  {
    $this->middleware('auth')->except(['index', 'show']);
  }
  public function index(Posts $posts)
  {
    //dd($posts);
    $posts = $posts->all();

    /*$posts = Post::latest()
      ->filter(request(['month', 'year']))
      ->get();*/

    // $posts = Post::latest();
    //
    // if ($month = request('month'))
    // {
    //   $posts->whereMonth('created_at', Carbon::parse($month)->month);
    // }
    //
    // if ($year = request('year'))
    // {
    //   $posts->whereYear('created_at', $year);
    // }
    //
    // $posts = $posts->get();

    //$posts = Post::all();
    //$posts = Post::orderBy('created_at', 'desc')->get();
    //$archives = Post::archives();

    /*$archives = Post::selectRaw('year(created_at) year, monthname(created_at) month, count(*) published')
    ->groupBy('year', 'month')
    ->orderByRaw('min(created_at) desc')
    ->get()
    ->toArray();*/

    //return view('posts.index', compact('posts', 'archives'));
    return view('posts.index')->with('posts', $posts);
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
    //Post::create(request(['title', 'body']));

    auth()->user()->publish(
      new Post(request(['title', 'body']))
    );

    // And then redirect to the home page
    return redirect('/');
  }
}
