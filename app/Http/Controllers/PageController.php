<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Page;

class PageController extends Controller
{
    protected $name;

    // protected $possibleNames = ['about', 'services', 'contact'];

    function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('page.index')->with(self::$data);
    }

    public function init($name) 
    {
        $this->name = $name;
        $page = new Page;
        $page->name = $name;

        self::mergeParameters([
            'pageTitle' => 'uᴅShareDesk > ' . $name,
            $name . 'Tab' => 'active',
            'page' => $page
        ]);
    }

    public function open($name)
    {
        $this->init($name);
        $pages = DB::table('pages')->where('name', $name)->get();
        if($pages->count() > 0) 
        {
            self::updateParameter('page', $pages[0]);
        }
        return $this->index();
    }

    public function load($name)
    {
        $this->init($name);
        $pages = DB::table('pages')->where('name', $name)->get();
        if($pages->count() > 0)
        {
            self::updateParameter('page', $pages[0]);
        }
        return view('ajax.page.index')->with(self::$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $previous = Url()->previous();
        foreach(self::retrieveParameter('pageNames') as $name)
        {
            if(substr_count(Url()->previous(), $name)) break;
        }
        $this->init($name);
        return view('page.create')->with(self::$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Page::create($request->input());
        return $this->open($request->input()['name']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        $this->init($page->name);
        self::updateParameter('page', $page);
        return view('page.edit')->with(self::$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        $page->update($request->input());
        return $this->open($page->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return $this->open($page->name);
    }
}
