<?php

namespace App\Http\Composers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

use App\Post;

class ViewComposer
{
    private $data = [];

    public function compose(View $view) 
    {
        if(Auth::guard('web')->check())
        {
            $uname = Auth::user()->name;
            $userId = Auth::id();
            $usertype = 'visitor';
            $loggedin = true;
            if(DB::table('pins')->where('email', Auth::user()->email)->count() > 0) 
            {
                $usertype = 'admin';
            }
        }
        elseif(Auth::guard('admin')->check())
        {
            $uname = Auth::guard('admin')->user()->name;
            $userId = Auth::guard('admin')->id();
            $usertype = 'activeadmin';
            $loggedin = true;
        }
        else
        {
            $uname = "guest";
            $userId = "0";
            $usertype = 'user';
            $loggedin = false;
        }

        $this->data = array_merge([
            'viewName' => $view->getName(),
            'loggedin' => $loggedin,
            'usertype' => $usertype,
            'uname' => $uname,
            'userId' => $userId
        ], $view->getData());

        switch ($view->getName()) {
            case 'partials.menu':
                $this->processMenu();
                break;
            case 'sections.floater':
                $this->processFloater();
                break;
            case 'partials.archive_index':
            case 'widgets.archive':
                $this->processFloater();
                $this->processArchive($view->getData());
                break;
            case 'partials.calendar_index':
            case 'widgets.calendar':
                $this->processFloater();
                $this->processCalendar($view->getData());
                break;
        }

        return $view->with($this->data);
    }

    private function processMenu()
    {
        $showMenu = 'none';
        if(old('showMenu')) $showMenu = old('showMenu');
        $this->mergeParameters(['showMenu'=>$showMenu]);
    }

    private function processFloater() 
    {
        $currentFloater = ''; 
        $showFloater = $showArchive = $showCalendar = 'none';
        if(isset($_GET['currentFloater'])) $currentFloater = $_GET['currentFloater'];
        if(isset($_GET['showFloater'])) $showFloater = $_GET['showFloater'];
        if($currentFloater == 'archive') $showArchive = 'block';
        else if($currentFloater == 'calendar') $showCalendar = 'block';
        $this->mergeParameters(['currentFloater'=>$currentFloater, 'showFloater'=>$showFloater, 'showArchive'=>$showArchive, 'showCalendar'=>$showCalendar]);
    }

    private function processArchive($data) 
    {
        $widgetPosts = $data['widgetPosts'];
        // Post::orderBy('created_at', 'desc')->get();
        $sortBy = 'category';
        $sortedPosts = [];
        if(old('sortBy')) $sortBy = old('sortBy');
        else if(isset($_GET['sortBy'])) $sortBy = $_GET['sortBy'];
        if(count($widgetPosts) > 0) 
        {
            if($sortBy == 'category')
            {
                $sortedPosts = $widgetPosts->groupBy('posttype');

            }
            else if($sortBy == 'date')
            {
                $sortedPosts = $widgetPosts->groupBy(function($item, $key)
                {
                    return date("M Y", unixtime($item['created_at']));
                });

            }
        }
        $this->mergeParameters(['sortBy'=>$sortBy, 'sortedPosts'=>$sortedPosts]);
    }

    private function processCalendar($data) 
    {
        $widgetPosts = $data['widgetPosts'];
        // Post::orderBy('created_at', 'desc')->get();
        $month = date('n');
        $year = date('Y');
        $sortedPosts = [];
        $months = ['1'=>'january', '2'=>'february', '3'=>'march', '4'=>'april', '5'=>'may', '6'=>'june', '7'=>'july', '8'=>'august', '9'=>'september', '10'=>'october', '11'=>'november', '12'=>'december'];
        $day = ''; 
        $showPosts = 'none';
        if(old('showPosts')) $showPosts = old('showPosts');
        else if(isset($_GET['showPosts'])) $showPosts = $_GET['showPosts'];
        if(old('day')) $day = old('day');
        else if(isset($_GET['day'])) $day = $_GET['day'];
        if(old('month')) $month = old('month');
        else if(isset($_GET['month'])) $month = $_GET['month'];
        if(old('year')) $year = old('year');
        else if(isset($_GET['year'])) $year = $_GET['year'];
        $timestamp = mktime (0, 0, 0, $month, 1, $year); //timestamp for today
        // $monthname = date('F', $timestamp); //month specifier: January to December
        $monthstart = date('w', $timestamp); //day specifier: 0 to 6
        $previouslastday = date('d', mktime (0, 0, 0, $month, 0, $year)); //last day of previous month: 01 to 31
        $currentlastday = date('d', mktime (0, 0, 0, $month+1, 0, $year)); //last day of current month: 01 to 31
        $startdate = -$monthstart;
        $startday = $previouslastday-$monthstart+1;
        $outday = ""; // identify class of days that are not within the month
        $postday = ""; // identify class of days that have posts in them
        $postcount = ""; // number of post in each day
        $postHtmls = []; // Html to build archive-like view of all post in a given day

        if(count($widgetPosts) > 0) {
            $sortedPosts = $widgetPosts->groupBy(function($item, $key)
            {
                return getYear($item['created_at']);
            }); 

            foreach ($sortedPosts as $year_key => $year_value)
            {
                $sortedPosts[$year_key] = $year_value->groupBy(function($item, $key)
                {
                    return getMonth($item['created_at']);
                });

                foreach ($sortedPosts[$year_key] as $month_key => $month_value)
                {
                    $sortedPosts[$year_key][$month_key] = $month_value->groupBy(function($item, $key)
                    {
                        return getDay($item['created_at']);
                    });
                }
            }
        }
        $this->mergeParameters(['months'=>$months, 'day'=>$day, 'month'=>$month, 'year'=>$year, 'showPosts'=>$showPosts,
                                'monthstart'=>$monthstart, 'currentlastday'=>$currentlastday, 'startday'=>$startday,
                                'outday'=>$outday, 'postday'=>$postday, 'postcount'=>$postcount, 'postHtmls'=>$postHtmls, 
                                'sortedPosts'=>$sortedPosts]);
    }
    
    private function mergeParameters($args)
    {
        $this->data = array_merge($this->data, $args);
    }
}