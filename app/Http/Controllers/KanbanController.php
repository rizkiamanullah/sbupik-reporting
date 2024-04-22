<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use DB;
use Illuminate\Support\Facades\Auth;

class KanbanController extends Controller
{
    // public function show()
    // {
    //     return view('pages.user.officer.kanban');
    // }

    public function showArchives(){
        $data = DB::table("user_kanban_tasks")
        ->where('user_id',Auth::user()->id)
        ->where('archived', 1)
        ->get();
        dd($data);
    }
    
    public function saveTask($user_id){
        $curr_board_db = DB::table("user_kanban")
        ->where("user_id", $user_id)
        ->get();
        @$curr_task_db = DB::table("user_kanban_tasks")
        ->where("user_id", $user_id)
        ->where("kanban_id", $_POST["kanban_id"])
        ->get();

        $data = [
            "user_id"=> $user_id,
            "kanban_id"=> $_POST["kanban_id"],
            "title" => $_POST["title"],
            "deskripsi" => $_POST["deskripsi"],
            "urgensi" => $_POST["urgensi"],
            "order_number" => @$curr_task_db ? count(@$curr_task_db) + 1 : 1,
            "created_at" => date("Y-m-d H:i:s"),
            "created_by" => Auth::user()->email,
        ];

        $insertTask = DB::table("user_kanban_tasks")->insert($data);

        if ($insertTask){
            return ['status' => 200, 'msg'=> 'Added'];
        }
        return ['status'=> 403, 'msg'=> 'Error'];
    }

    public function switchTask($user_id){
        $id = $_POST['id'];
        $turn = $_POST['turn'];

        $currTask = DB::table('user_kanban_tasks')
        ->where('id',$id)
        ->first();

        if (@$currTask && @$currTask->kanban_id > 0){
            if ($turn == 'right'){
                $data = [
                    'kanban_id' => $currTask->kanban_id + 1,
                ];
            }
            if ($turn == 'left'){
                $data = [
                    'kanban_id' => $currTask->kanban_id - 1,
                ];
            }
            $update = DB::table('user_kanban_tasks')->where('id', $id)->update($data);
            if ($update){
                return ['status' => 200, 'msg' => 'Moved', 'highlight_id' => $id];
            }
        }
        return ['status' => 403, 'msg' => 'Error'];
    }

    public function getTaskDetail($user_id){
        $id = $_GET['id'];
        $currTask = DB::table('user_kanban_tasks')
            ->where('id', $id)
            ->first();
        if (@$currTask){
            return json_encode($currTask);
        }
        return ['status' => 403, 'msg' => 'Error'];
    }

    public function saveKomentarTask(){
        $curr_task = DB::table('user_kanban_tasks')
        ->where('id',$_POST['id'])
        ->first();

        $added_data = [
            'comments' => [
                ['sender' => Auth::user()->username, 'message' => $_POST['input'], 'time_sent' => date('Y-m-d H:i:s')],
            ],
        ];

        if ($curr_task->json_details){
            $json_details = json_decode($curr_task->json_details, true);
            array_push($json_details['comments'], ['sender' => Auth::user()->username, 'message' => $_POST['input'], 'time_sent' => date('Y-m-d H:i:s')]);

            $update = DB::table('user_kanban_tasks')
            ->where('id',$_POST['id'])
            ->update(['json_details' => json_encode($json_details)]);
        } else {
            $update = DB::table('user_kanban_tasks')
            ->where('id',$_POST['id'])
            ->update(['json_details' => json_encode($added_data)]);
        }

        if ($update){
            return ['status' => 200, 'msg' => 'Comments added'];
        }
        return ['status' => 403, 'msg' => 'Error'];
    }

    public function getKomentarTask(){
        $curr_task = DB::table('user_kanban_tasks')
            ->where('id', $_GET['id'])
            ->first();
        if ($curr_task){
            return json_encode($curr_task);
        }
        return ['status' => 403, 'msg' => 'Error'];
    }

    public function archiveTask(){
        $curr_task = DB::table('user_kanban_tasks')
            ->where('id', $_POST['id'])
            ->update(['archived' => 1]);
        if ($curr_task) {
            return ['status' => 200, 'msg' => 'Archived'];
        }
        return ['status' => 403, 'msg' => 'Error'];
    }
}
