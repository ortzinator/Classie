<?php

namespace Classie\Http\Controllers;

use Classie\Http\Requests\CreatePostRequest;
use Classie\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('updated_at')->simplePaginate(20);
        return response()->view('posts.list', compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Classie\Http\Requests\CreatePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        $post = new Post();
        $post->user_id = Auth::id();
        $post->title = $request['title'];
        $post->body = $request['body'];
        $post->save();

        if ($request->has('images')) {
            foreach ($request['images'] as $image) {
                Storage::disk('public')->move('tmp/' . $image->src, 'images/' . $image->src);
                Storage::disk('public')->move('tmp/th_' . $image->src, 'images/th_' . $image->src);
                $post->images()->create(['file' => $image->src, 'post_id' => $post->id]);
            }
        }

        return response()->redirectToRoute('posts.show', ['post' => $post->id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('posts.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return response()->view('posts.post', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
