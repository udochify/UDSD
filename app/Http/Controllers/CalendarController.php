<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

class CalendarController extends Controller
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
        $month = $request->input('month');
        $year = $request->input('year');
        return view('ajax.calendar.index', ['month'=>$month, 'year'=>$year])->with(self::$data);
    }
}