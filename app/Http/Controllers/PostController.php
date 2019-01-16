<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Events\PostCreated;

class PostController extends Controller
{

    public function index(Request $request, Post $post){
        $allPosts = $post->whereIn('user_id', $request->user()->following()->pluck('users.id')->push($request->user()->id))->with('user');
        // dd($allPosts->count());
        $posts = $allPosts->orderBy('created_at', 'desc')->take(10)->get();
        return response()->json(['posts'=>$posts,]);
    }
    public function create(Request $request, Post $post)
    {
        //create post 
        $createdPost = $request->user()->posts()->create([
            'body' => $request->body,
        ]);
        //broadcast
        // broadcast(new PostCreated($createdPost, $request->user()))->toOthers();
        //return reponse in json
        return response()->json($post->with('user')->find($createdPost->id));
    }
}
