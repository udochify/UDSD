<?php

namespace App\Http\Controllers;
\Debugbar::disable();

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

use App\Post;
use App\Helper;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static $data = [];

    function __construct() 
    {
        $widgetPosts = Post::orderBy('created_at', 'asc')->where('posttype', '<>', 'entertainment')->get();
        $pageNames = ['about', 'services', 'contact'];
        self::$data = [
            'month' => date('n'),
            'year' => date('Y'),
            'widgetPosts' => $widgetPosts,
            'pageNames' => $pageNames,
            'appname' => 'UDShareDesk',
            // 'createPage' => false,
            // 'editPage' => false,
            // 'deletePage' => false
        ];
    }

    public static function mergeParameters($args)
    {
        self::$data = array_merge(self::$data, $args);
    }

    public static function updateParameter($key, $data) 
    {
        self::$data[$key] = $data;
    }

    public static function retrieveParameter($key) 
    {
        return self::$data[$key];
    }

    function refresh(Request $request) 
    {
        return back()->withInput($request->all());
    }
}
