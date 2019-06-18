<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class BlogCommentController extends Controller
{
    function __construct() 
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function create(Post $post)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $post)
    {
        Comment::create($request->all() + ['postid' => $post->id]);
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function ajaxStore(Request $request, $post)
    {
        $comment = Comment::create($request->all() + ['postid' => $post->id]);
        return view('ajax.comment.show')->with(['comment'=>$comment]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post, Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post, Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Comment::destroy($id);
        return redirect()->back();
    }
}
