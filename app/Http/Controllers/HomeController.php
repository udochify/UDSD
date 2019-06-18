<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Post;
use App\Comment;

class HomeController extends Controller
{
    function __construct() 
    {
        parent::__construct();
        $allPosts = self::$data['widgetPosts'];
        $categories = $allPosts->pluck('posttype')->unique()->values()->all();
        $posttype = "";
        $post = null;
        if($allPosts->count() > 0)
        {
            $posts = $allPosts->take(1);
            $post = $posts[0];
            $posttype = $post->posttype;
        }
        self::mergeParameters([
            'categories' => $categories,
            'posttype' => $posttype,
            'post' => $post,
            'pageTitle' => 'uᴅShareDesk > Home',
            'pageurl' => 'index.php',
            'indexTab' => 'active',
            'subnavStates' => ['Welcome'=>'active', 'Blog'=>'', 'Category'=>''],
            'subnavLinks' => ['Welcome'=>route('home.index'), 'Blog'=>route('blog.index'), 'Category'=>'#'],
        ]);
    }

    function index() 
    {
        return view('home.index')->with(self::$data);
    }

    function load() 
    {
        return view('ajax.home.index')->with(self::$data);
    }
}
