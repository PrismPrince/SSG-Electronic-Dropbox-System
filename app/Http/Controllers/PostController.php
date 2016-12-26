<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;

class PostController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:api');
  }

  public function index(Request $request)
  {
    $posts = Post::with('user')->offset($request->skip)->limit($request->take)->orderBy('created_at', 'desc')->get();

    return response()->json($posts);
  }

  public function create()
  {
    //
  }

  public function store(Request $request)
  {
    $post = new Post();
    $post->user_id = Auth::guard('api')->id();
    $post->title = $request->title;
    $post->desc = $request->desc;
    $post->save();

    return response()->json(Post::with('user')->find($post->id));
  }

  public function show($id)
  {
    //
  }

  public function edit($post)
  {
    return response()->json(Post::with('user')->find($post));
  }

  public function update(Request $request, $post)
  {
    $post = Post::with('user')->find($post);
    $post->title = $request->title;
    $post->desc = $request->desc;
    $post->save();

    return response()->json($post);
  }

  public function destroy($post)
  {
    $post = Post::with('user')->find($post);
    $post->delete();

    return response()->json($post);
  }
}
