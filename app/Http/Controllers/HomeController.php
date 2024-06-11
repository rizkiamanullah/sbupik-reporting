<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $wom = $this->WoM(date('Ymd'));
        @$curr_sticky_notes_db = DB::table("sticky_notes")
            ->where("user_id", Auth::user()->id)
            ->get();
        $users = DB::table('users')
        ->where('id','!=',99)
        ->get();
        $projects = DB::table('projects')
        ->get();
        $curr_board_db = DB::table("user_kanban")
        ->get();
        $curr_task_db = DB::table("user_kanban_tasks")
            ->where("user_id", Auth::user()->id)
            ->where("archived", 0)
            ->get();
            
            // officer
        if (Auth::user()->user_role_id == 1){
            return view('pages.user.officer.dashboard', compact('wom','curr_sticky_notes_db','curr_board_db','curr_task_db', 'users','projects'));
        }
            // pm/ higher
        if (Auth::user()->user_role_id > 1 && Auth::user()->user_role_id < 99){
            return view('pages.user.pm.dashboard', compact('wom','curr_sticky_notes_db', 'projects', 'users'));
        }
        return view('pages.admin.dashboard', compact('wom','curr_sticky_notes_db', 'projects', 'users'));
    }
}
