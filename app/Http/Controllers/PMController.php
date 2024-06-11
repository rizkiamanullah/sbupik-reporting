<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PMController extends Controller
{
    public function officer($id){
        $wom = $this->WoM(date('Ymd'));
        $dataOfficer = DB::table('users')
        ->where('id',$id)
        ->first();

        $dataWeekly = DB::table('tb_weekly_progress')
        ->where('id_user', $id)
        ->orderBy('id', 'asc')
        ->get()->keyBy('weekNum');

        $dataDaily = [];
        foreach ($dataWeekly as $dW){
            $dataDaily[$dW->id] = DB::table('tb_daily_progress')
                    ->where('id_user', $id)
                    ->where('id_task', $dW->id)
                    ->orderBy('date', 'asc')
                    ->get();
        }
        // $dataDaily = DB::table('tb_daily_progress')
        //     ->where('id_user', $id)
        //     ->get();

        // dd($dataDaily, $dataWeekly);
        return view('pages.user.pm.officer', compact('wom','dataOfficer','dataWeekly','dataDaily'));
    }

}
