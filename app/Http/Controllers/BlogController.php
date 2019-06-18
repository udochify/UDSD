<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Post;
use App\Comment;

class BlogController extends Controller
{
    function __construct() 
    {
        parent::__construct();
        $allPosts = self::$data['widgetPosts'];
        $categories = $allPosts->pluck('posttype')->unique()->values()->all();
        $posts = Post::orderBy('created_at', 'asc')->paginate(2);
        $comments = [];
        foreach ($posts as $post) {
            $comments[$post->id] = Comment::where('postid', '=', $post->id)->get();
        }
        self::mergeParameters([
            'categories' => $categories,
            'posts' => $posts,
            'comments' => $comments,
            'pageTitle' => 'uᴅShareDesk > Blog',
            'pageurl' => 'index.php',
            'indexTab' => 'active',
            'subnavStates' => ['Welcome'=>'', 'Blog'=>'active', 'Category'=>'active'],
            'subnavLinks' => ['Welcome'=>route('home.index'), 'Blog'=>route('blog.index'), 'Category'=>'#']
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('blog.index')->with(self::$data);
    }

    public function work()
    {
        $posts = Post::orderBy('created_at', 'asc')->where('posttype', 'entertainment')->paginate(4);
        self::mergeParameters(['pageTitle' => 'uᴅShareDesk > Work', 'categories' => '', 'comments' => '', 'indexTab'=>'', 'servicesTab' => 'active', 'subnavStates' => [], 'subnavLinks' => [], 'posts' => $posts]);
        return view('blog.work')->with(self::$data);
    }

    public function load()
    {
        return view('ajax.blog.index')->with(self::$data);
    }

    public function loadWork()
    {
        $posts = Post::orderBy('created_at', 'desc')->where('posttype', 'entertainment')->paginate(4);
        self::mergeParameters(['pageTitle' => 'uᴅShareDesk > Work', 'categories' => '', 'comments' => '', 'indexTab'=>'', 'servicesTab' => 'active', 'subnavStates' => [], 'subnavLinks' => [], 'posts' => $posts]);
        return view('ajax.blog.work')->with(self::$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        self::updateParameter('posts', [new Post]);
        return view('blog.create')->with(self::$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = Post::create($request->input());
        return $this->show($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($post)
    {
        $this->preparePost($post);
        return view('blog.show')->with(self::$data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function get($post)
    {
        $this->preparePost($post);
        return view('ajax.blog.show')->with(self::$data);
    }

    public function open($post, $sort)
    {
        $this->preparePost($post);
        return view('blog.show', ['showSort'=> $sort])->with(self::$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($post)
    {
        $this->preparePost($post);
        return view('blog.edit')->with(self::$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $post->update($request->input());
        return $this->show($post);
    }

    public function category(Request $request)
    {
        $this->prepareCategory($request);
        return view('blog.index')->with(self::$data);
    }

    public function ajaxCategory(Request $request)
    {
        $this->prepareCategory($request);
        return view('ajax.blog.index')->with(self::$data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::destroy($id);
        return redirect()->back();
    }

    private function preparePost($post) {
        $comments = [];
        $comments[$post->id] = Comment::where('postid', '=', $post->id)->get();
        self::updateParameter('comments', $comments);
        self::updateParameter('posts', [$post]);
        self::updateParameter('categories', [$post->posttype]);
        self::updateParameter('subnavStates', ['Welcome'=>'', 'Blog'=>'', 'Category'=>'active']);
    }

    private function prepareCategory(Request $request) {
        $posts = Post::where('posttype', $request->input('posttype'))->orderBy('created_at', 'desc')->paginate(2);
        $comments = [];
        foreach ($posts as $post) {
            $comments[$post->id] = Comment::where('postid', '=', $post->id)->get();
        }
        self::mergeParameters(['ajaxCategory'=>$request->input('posttype')]);
        self::updateParameter('posts', $posts);
        self::updateParameter('comments', $comments);
        self::updateParameter('subnavStates', ['Welcome'=>'', 'Blog'=>'', 'Category'=>'active']);
    }
}
