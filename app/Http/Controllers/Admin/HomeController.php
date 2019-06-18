<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Post;
use App\Comment;

class HomeController extends Controller
{
    // function __construct() 
    // {
    //     parent::__construct();
    //     $allPosts = Post::orderBy('created_at', 'desc');
    //     $comments = [];
    //     $post = null;
    //     if($allPosts->count() > 0)
    //     {
    //         $posts = $allPosts->take(1)->get();
    //         $post = $posts[0];
    //         $comments[$post->id] = Comment::where('postid', '=', $post->id)->get();
            
    //     }
    //     self::mergeParameters([
    //         'post' => $post,
    //         'comments' => $comments,
    //         'pageTitle' => 'uᴅShareDesk > Home',
    //         'pageurl' => 'index.php',
    //         'indexTab' => 'Active',
    //         'subnavStates' => ['Welcome'=>'active', 'Blog'=>''],
    //         'subnavLinks' => ['Welcome'=>route('home.index'), 'Blog'=>route('blog.index')],
    //     ]);
    // }

    public function store(Request $request)
    {
        $pin = $request->input('pin');

        if (DB::table('pins')->where(['pin' => $pin, 'email' => session('email')])->count() > 0)
        {
            if (DB::table('admins')->where('email', session('email'))->count() > 0)
            {
                session(['can_register' => "no"]);
            }
            else 
            {
                session(['can_register' => "yes"]);
            }
        }
        else 
        {
            session()->flush();
        }
        return redirect()->back();
    }
}
