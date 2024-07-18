<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index(){
        $projects = DB::table('projects')->orderBy('id','desc')->get();
        $users = DB::table('users')->get();
        return view('pages.projects', compact('projects', 'users'));
    }

    public function getterProject($id){
        $data = DB::table('projects')->find($id);
        return $data;
    }

    public function saveProject(){
        $insert = DB::table('projects')
        ->insert([
            'nama' => $_POST['nama_proyek'],
            'nilai' => $_POST['total_biaya_proyek'],
            'nilai_real' => (float) $_POST['total_biaya_proyek'],
            'json_details' => json_encode([
                'status_proyek' => $_POST['status_proyek'],
                'klien_proyek' => $_POST['klien_proyek'],
                'tanggal_mulai_proyek' => $_POST['tanggal_mulai_proyek'],
                'tenggat_waktu_proyek' => $_POST['tenggat_waktu_proyek'],
                'deskripsi_proyek' => $_POST['deskripsi_proyek'],
                'anggota_proyek' => $_POST['anggota_proyek'],
            ]),
            'created_by' => Auth::user()->firstname,
            'created_at' => date('Y-m-d H:i:s'),

        ]);

        if ($insert){
            return redirect()->back()->with(['status' => 'success', 'msg' => 'Proyek Baru Ditambahkan!']);
        }
        return redirect()->back()->with(['status' => 'error', 'msg' => 'Proyek Gagal Ditambahkan']);
    }

    public function editProject($id){
        $projects = DB::table('projects')->find($id);
        $users = DB::table('users')->get();
        return view('pages.edit-projects', compact('projects', 'users'));
    }

    public function saveEditProject($id)
    {
        $previous = DB::table('projects')->where('id',$id)->first();
        $anggota_proyek = (@$_POST['anggota_proyek']) ?: json_decode($previous->json_details,true)['anggota_proyek'];
        $deskripsi_proyek = (@$_POST['deskripsi_proyek']) ?: json_decode($previous->json_details,true)['deskripsi_proyek'];

        $update = DB::table('projects')
            ->where('id', $id)
            ->update([
                'nama' => $_POST['nama_proyek'],
                'nilai' => $_POST['total_biaya_proyek'],
                'nilai_real' => (float) $_POST['total_biaya_proyek'],
                'json_details' => json_encode([
                    'status_proyek' => $_POST['status_proyek'],
                    'klien_proyek' => $_POST['klien_proyek'],
                    'tanggal_mulai_proyek' => $_POST['tanggal_mulai_proyek'],
                    'tenggat_waktu_proyek' => $_POST['tenggat_waktu_proyek'],
                    'deskripsi_proyek' => $deskripsi_proyek,
                    'anggota_proyek' => $anggota_proyek,
                ]),
                'created_by' => Auth::user()->firstname,
                'created_at' => date('Y-m-d H:i:s'),

            ]);

        if ($update) {
            return redirect()->to('/projects')->with(['status' => 'success', 'msg' => 'Ubahan Proyek Tersimpan!']);
        }
        return redirect()->back()->with(['status' => 'error', 'msg' => 'Proyek Gagal Disimpan']);
    }

    public function monitoringProject($id){
        $projects = DB::table('projects')->find($id);
        $users = DB::table('users')->get();
        $events = DB::table('project_deliverables')
            ->where('project_id', $id)
            ->get();

        foreach ($events as $event) {
            $obj[] = json_decode($event->json_details, true);
        }
        // $obj = json_encode($obj);
        return view('pages.project-monitoring', compact('projects', 'users', 'obj'));
    }

    public function fetchActivities($id){
        $events = DB::table('project_deliverables')
        ->where('project_id',$id)
        ->get();

        foreach ($events as $event){
            $obj[] = json_decode($event->json_details,true);
        }

        return $obj;
    }

    public function fetchEvent($id){
        $event = DB::table('project_deliverables')
        ->where('project_id',$id)
        ->where('id', $_GET['id'])
        ->whereRaw('DATE_FORMAT(durasi, "%Y-%m-%d") = "'. date('Y-m-d',strtotime($_GET['date'])).'"')
        ->first();

        return $event;
    }

    public function saveActivities($id_project){
        $insert = DB::table('project_deliverables')
        ->insert([
            'project_id' => $id_project,
            'nama' => $_POST['nama_kegiatan'],
            'nilai' => $_POST['nilai_rab_kegiatan'],
            'deskripsi' => $_POST['deskripsi_kegiatan'],
            'json_details' => json_encode([
                'title' => $_POST['nama_kegiatan'],
                'start' => $_POST['mulai_kegiatan'],
                'end' => $_POST['akhir_kegiatan'],
                // 'eventColor' => $_POST['warna_kegiatan'],
                'bobot_kegiatan' => $_POST['bobot_kegiatan'],
            ]),
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => Auth::user()->firstname,
        ]);

        if ($insert) {
            return redirect()->to('/projects/monitoring/'.$id_project)->with(['status' => 'success', 'msg' => 'Kegiatan Tersimpan!']);
        }
        return redirect()->back()->with(['status' => 'error', 'msg' => 'Proyek Gagal Disimpan']);

    }

}
