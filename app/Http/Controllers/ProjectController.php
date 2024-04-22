<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function show($id)
    {
        $data = DB::table('projects')
            ->where('id', $id)
            ->first();
        $users = DB::table('users')
            ->get();
        $deliverables = DB::table('user_kanban_tasks')
            ->where('project_id',$id)
            ->get();
        return view("pages.tasks", compact('data','users','deliverables'));
    }
    
    public function save(){
        if (@$_POST['id'] && @$search = DB::table('projects')->where('id',$_POST['id'])->first()){
            if (
                DB::table('projects')
                ->where('id',$_POST['id'])
                ->update([
                    'project_id' => $_POST['project_id'],
                    'nama' => $_POST['nama_proyek'],
                    'json_details' => json_encode([
                        'manajer_proyek' => $_POST['nama_manager'],
                        'anggota' => json_encode($_POST['anggota']),
                        ]),
                ])
            ){
                return 'updated';
                // return redirect()->to('/myProject');
            }
        } else {
            if (
                DB::table('projects')
                    ->insert([
                        'project_id' => $_POST['project_id'],
                        'nama' => $_POST['nama_proyek'],
                        'json_details' => json_encode([
                            'manajer_proyek' => $_POST['nama_manager'],
                            'anggota' => json_encode($_POST['anggota']),
                        ]),
                ])
            ){
                return 'saved';
                // return redirect()->to('/myProject');
            }
        }
    }

    public function saveDeliverable(){
        // dd($_POST);
        if (@$_POST['id'] && @$search = DB::table('projects')->where('id',$_POST['id'])->first()){
            if (
                DB::table('user_kanban_tasks')
                ->where('id',$_POST['id'])
                ->update([
                        'project_id' => $_POST['project_id'],
                        'title' => $_POST['nama'],
                        'json_details' => json_encode([
                            'kategori' => $_POST['kategori'],
                            'pic' => $_POST['pic'],
                            'deadline' => $_POST['deadline'],
                            'last_update' => $_POST['last_update'],
                            'label' => $_POST['label'],
                            'anggota' => json_encode($_POST['anggota']),
                            'description' => $_POST['description'],
                            // 'cover_img' => $_POST['cover_img'],
                            'level' => 1,
                        ]),
                    ])
            ){
                // return 'updated';
                return redirect()->back();
            }
        } else {
            if (
                DB::table('user_kanban_tasks')
                    ->insert([
                        'project_id' => $_POST['project_id'],
                        'title' => $_POST['nama'],
                        'created_at' => date('Y-m-d'),
                        'created_by' => Auth::user()->username,
                        'json_details' => json_encode([
                            'kategori' => $_POST['kategori'],
                            'pic' => $_POST['pic'],
                            'deadline' => $_POST['deadline'],
                            'last_update' => $_POST['last_update'],
                            'label' => $_POST['label'],
                            'anggota' => json_encode($_POST['anggota']),
                            'description' => $_POST['description'],
                            // 'cover_img' => $_POST['cover_img'],
                            'level' => 1,
                        ]),
                ])
            ){
                // return 'saved';
                return redirect()->back();
            }
        }
    }

    public function fetchDeliverable(){
        // dd($_GET);
        if ($data = DB::table('user_kanban_tasks')
            ->where('id',$_GET['id'])
            ->get()){
            return json_encode($data);
        }
        return "Err";
    }   
}
