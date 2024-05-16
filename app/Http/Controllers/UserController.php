<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show()
    {
        $curr_board_db = DB::table("user_kanban")
        ->get();
        $curr_task_db = DB::table("user_kanban_tasks")
        ->where("user_id", Auth::user()->id)
        ->where("archived", 0)
        ->get();
        return view('pages.user.officer.kanban', compact('curr_board_db','curr_task_db'));
    }

    public function getStickyNotes(){
        $curr_sticky_notes_db = DB::table('sticky_notes')
        ->where('user_id', Auth::user()->id)
        ->get();

        if (@$curr_sticky_notes_db){
            return json_encode($curr_sticky_notes_db);
        }
        return ['status' => 403, 'msg' => 'Error'];
    }

    public function deleteStickyNotes(){
        $curr_sticky_notes_db = DB::table('sticky_notes')
        ->where('user_id', Auth::user()->id)
        ->where('id', $_POST['id'])
        ->delete();

        if (@$curr_sticky_notes_db){
            return ['status' => 200, 'msg' => 'Deleted'];
        }
        return ['status' => 403, 'msg' => 'Error'];
    }
    public function saveStickyNotes(){
        $input = $_POST['input'];

        $insert = DB::table('sticky_notes')
        ->insert([
            'user_id' => Auth::user()->id,
            'message' => $input,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        if (@$insert){
            return ['status' => 200, 'msg' => 'Saved'];
        }
        return ['status' => 403, 'msg' => 'Error'];
    }

    public function fetchMessages(){
        $curr_message = json_decode(DB::table('direct_messages')
        ->where('id',$_GET['id'])
        ->get(), true);
        if ($curr_message){
            return json_encode($curr_message);
        }
        return ['status' => 403, 'msg' => 'Error'];
    }

    public function messaging(){
        $data = $_POST;
        // dd($data);
        if ($data['type'] == 'new'){
            $insert = DB::table('direct_messages')
            ->insert([
                'sender_user_id' => Auth::user()->id,
                'receiver_user_id' => $data['receiver_id'],
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => Auth::user()->email,
            ]);
            if ($insert){
                return ['status' => 200, 'msg' => 'Created'];
            }
        }

        if ($data['type'] == 'send'){
            $message = [
                'id_gen' => uniqid()."_".date('Ymd_His'),
                'msg' => @$_POST['message'],
                'sender_email' => Auth::user()->email,
                'sender_uname' => Auth::user()->username,
                'time_sent' => date('Y-m-d H:i:s'),
            ];

            $curr_message = DB::table('direct_messages')
            ->where('id',$data['message_id'])
            ->first()->message;

            if ($curr_message == ""){
                $new_message = [$message];
            } else {
                $new_message = json_decode($curr_message, true);
                array_push($new_message, $message);
            }

            $update = DB::table('direct_messages')
            ->where('id',$data['message_id'])
            ->update([
                "message" => json_encode($new_message),
            ]);
            
            if ($update){
                return ['status' => 200, 'msg' => 'Sent'];
            }
        }
        return ['status' => 403, 'msg' => 'Error'];

    }

    public function fetchUsers(){
        if (
            $data = DB::table('users')
            ->where('id',$_GET["id"])
            ->first()
        ){
            return json_encode($data);
        }
        return "Err";
    }
    public function getReports($id){
        $data = DB::table('tb_daily_progress')
        ->where('id_user',$id)
        ->orderBy('date','desc')
        ->get();
        $userData = DB::table('users')
        ->where('id',$id)
        ->first();
        return view('pages.pm-report-daily', compact('data','userData'));
    }

    public function saveReporting(){
        $user_id = $_POST['user_id'];
        $rencana = $_POST['rencana'];
        $realisasi = $_POST['realisasi'];
        $id_task = $_POST['id_task'];

        $today = DB::table('tb_daily_progress')
        ->where('id_user',$user_id)
        ->where('date', date('Y-m-d'))
        ->first();

        if ($today){
            $progress = json_decode($today->progress, true);
            $progress['realisasi'] = $realisasi;
            $progress['datetime2'] = date('Y-m-d H:i:s');

            $update = DB::table('tb_daily_progress')
            ->where('id_user',$user_id)
            ->where('date',date('Y-m-d'))
            ->update([
                'done_for_today' => 1,
                'progress' => json_encode($progress),
            ]);

            if ($update){
                return ['status' => 200, 'success' => true, 'type' => 'update'];
            }
            return ['status' => 203, 'success' => false, 'type' => 'update'];
        }

        $insert = DB::table('tb_daily_progress')
        ->insert([
            'id_user' => $user_id,
            'id_task' => $id_task,
            'date' => date('Y-m-d'),
            'progress' => json_encode([
                'rencana' => $rencana,
                'datetime' => date('Y-m-d H:i:s'),
            ])
        ]);

        if ($insert){
            return ['status' => 200, 'success' => true, 'type' => 'insert'];
        }
        return ['status' => 203, 'success' => false, 'type' => 'insert'];

    }

    public function saveReportingWeekly(){
        $user_id = $_POST['user_id'];
        $rencana = $_POST['rencana_input'];
        $weekNum = $_POST['weekNum'];

        $today = DB::table('tb_weekly_progress')
        ->where('id_user',$user_id)
        ->where('year',date('Y'))
        ->where('weekNum',$weekNum)
        // ->where('date', date('Y-m-d'))
        ->first();

        if ($today){
            $progress = json_decode($today->progress, true);
            $progress['datetime2'] = date('Y-m-d H:i:s');

            $update = DB::table('tb_weekly_progress')
            ->where('id_user',$user_id)
            // ->where('date',date('Y-m-d'))
            ->where('year', date('Y'))
            ->where('weekNum', $weekNum)
            ->update([
                'done_for_today' => 1,
                'json_data' => json_encode($progress),
            ]);

            if ($update){
                // return ['status' => 200, 'success' => true, 'type' => 'update'];
                return redirect()->to('/monthly')->with(['msg' => 'Pelaporan Mingguan Tersimpan!']);
            }
            return ['status' => 203, 'success' => false, 'type' => 'update'];
        }

        $insert = DB::table('tb_weekly_progress')
        ->insert([
            'id_user' => $user_id,
            'date' => date('Y-m-d'),
            'year'=> date('Y'),
            'weekNum'=> $weekNum,
            'json_data' => json_encode([
                'rencana' => $rencana,
                'datetime' => date('Y-m-d H:i:s'),
            ])
        ]);

        if ($insert){
            // return ['status' => 200, 'success' => true, 'type' => 'insert'];
            return redirect()->to('/monthly')->with(['msg' => 'Pelaporan Mingguan Tersimpan!']);
        }
        return ['status' => 203, 'success' => false, 'type' => 'insert'];

    }


    public function reportOk(){
        $id = $_POST['id'];
        $this_report = DB::table('tb_daily_progress')
            ->where('id', $id)
            ->first();
            
        if ($this_report){
            $progress = json_decode($this_report->progress, true);
            $progress['ok'] = 1;
            $progress['datetime_ok'] = date('Y-m-d H:i:s');

            $update = DB::table('tb_daily_progress')
                ->where('id', $id)
                ->update([
                    'progress' => json_encode($progress),
                ]);

            if ($update) {
                return ['status' => 200, 'success' => true, 'type' => 'update'];
            }
        }
    }
}
