<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PMController extends Controller
{
    public function officer($id){
        $dataOfficer = DB::table('users')
        ->where('id',$id)
        ->first();

        $dataWeekly = DB::table('tb_weekly_progress')
        ->where('id_user',$id)
        ->get()->keyBy('weekNum');

        $dataDaily = DB::table('tb_daily_progress')
            ->where('id_user', $id)
            ->get();

        return view('pages.user.pm.officer', compact('dataOfficer','dataWeekly','dataDaily'));
    }
}
