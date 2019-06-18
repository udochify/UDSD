<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

class ArchiveController extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return back()->withInput($request->all());
    }

    public function load(Request $request)
    {
        $sortBy = $request->input('sortBy');
        return view('ajax.archive.index', ['sortBy'=>$sortBy])->with(self::$data); 
    }
}