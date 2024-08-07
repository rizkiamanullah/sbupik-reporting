<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use DB;
use Illuminate\Support\Facades\Auth;
use Hash;

class UserController extends Controller
{
    public function changePassword(){
        $this_user_info = DB::table('users')->find(Auth::user()->id);
        $wom = $this->WoM(date('Ymd'));

        return view("pages.user.passwordChange",compact('this_user_info', 'wom'));
    }

    public function changePassword_post(Request $request){
        $up = DB::table('users')
            ->where('id', Auth::user()->id)
            ->update([
                'password' => Hash::make($_POST['passw']),
            ]);

        if ($up) {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/login')->with(['msg' => "Ubah Password Sukses"]);
        } else {
            return redirect()->back()->with(['msg' => "Ubah Password Gagal"]);
        }
    }

    public function saveRencanaMingguan($id_user){
        $exist = DB::table('tb_weekly_progress')
            ->where('id_user', Auth::user()->id)
            ->where('weekNum', $_POST['input_minggu_ke'])
            ->where('year', $_POST['input_tahun_ke'])
            ->first();
        if ($exist){
            return ['status' => 'Success', 'msg' => 'Sudah terdapat rencana minggu ini'];
        }

        $insert = DB::table('tb_weekly_progress')
            ->insert([
                'id_user' => Auth::user()->id,
                'year' => $_POST['input_tahun_ke'],
                'weekNum' => $_POST['input_minggu_ke'],
                'date' => date('Y-m-d H:i:s'),
                'json_data' => json_encode([
                    'input_rencana_sebagai_draft' => @$_POST['input_rencana_sebagai_draft'],
                    'input_terdapat_cuti' => @$_POST['input_terdapat_cuti'],
                    'input_rencana' => $_POST['input_rencana'],
                    'input_output_rencana' => $_POST['input_output_rencana'],
                ])
        ]);

        if ($insert){
            if (@$_POST['input_rencana_sebagai_draft']){
                return ['status' => 'success', 'msg' => 'Draft rencana minggu ' . date('W') . ' tersimpan'];
            }
            return ['status' => 'success', 'msg' => 'Rencana minggu ' . date('W') . ' tersimpan'];
        }
        return ['status' => 'error', 'msg' => 'Rencana minggu ' . date('W') . ' gagal tersimpan'];
    }

    public function getterRencanaHarian($id){
        $exist = DB::table('tb_daily_progress')
            ->find($id);
        return $exist;
    }

    public function saveRencanaHarian($id_user){
        if (
            !strip_tags($_POST['input_rencana'][0])
        ) {
            return redirect()->back()->with(
                ['status' => 'error', 'msg' => 'Isian rencana tidak boleh kosong']
            );
        }
                
        $today = DB::table('tb_daily_progress')
        ->where('date', date('Y-m-d'))
        ->first();
        
        if ($today && !$_POST['ids']){
            return redirect()->back()->with(
                ['status' => 'error', 'msg' => 'Sudah terdapat rencana hari ini']
            );
        }

        $exist = DB::table('tb_daily_progress')
        ->find($_POST['ids']);

        $arr_files = [];
        if ($exist){
            $arr_files = @json_decode($exist->progress)->arr_files;
            if (@$_FILES["upload_file"]["name"][0]) {
                $arr_files = [];
                foreach ($_FILES["upload_file"]["name"] as $key => $name) {
                    $filename = date('ymdhis') . "_" . $name;
                    $dir = "docs/users/";
                    if (move_uploaded_file($_FILES['upload_file']['tmp_name'][$key], $dir . $filename)) {
                        array_push($arr_files, $dir . $filename);
                    }
                }
            }

            $update = DB::table('tb_daily_progress')
            ->where('id', $_POST['ids'])
            ->update([
                'progress' => json_encode([
                    'input_rencana' => @$_POST['input_rencana'],
                    'input_realisasi' => @$_POST['input_output_rencana'],
                    'arr_files' => $arr_files,
                ])
            ]);
    
            if ($update){
                return redirect()->back()->with(['status' => 'success', 'msg' => 'Rencana/ realisasi hari ' . date('d/m/Y', strtotime($_POST['date'])) . ' terupdate']);
            }
        } else {
            
            if (@$_FILES["upload_file"]["name"][0]) {
                $arr_files = [];
                foreach ($_FILES["upload_file"]["name"] as $key => $name) {
                    $filename = date('ymdhis') . "_" . $name;
                    $dir = "docs/users/";
                    if (move_uploaded_file($_FILES['upload_file']['tmp_name'][$key], $dir . $filename)) {
                        array_push($arr_files, $dir . $filename);
                    }
                }
            }
    
            $insert = DB::table('tb_daily_progress')
                ->insert([
                    'id_user' => Auth::user()->id,
                    'id_task' => $_POST['id_task'],
                    'date' => date('Y-m-d H:i:s'),
                    'progress' => json_encode([
                        'input_rencana' => $_POST['input_rencana'],
                        'input_realisasi' => $_POST['input_output_rencana'],
                        'arr_files' => $arr_files,
                    ])
            ]);
    
            if ($insert){
                if (@$_POST['input_rencana_sebagai_draft']){
                    return ['status' => 'success', 'msg' => 'Draft rencana hari ' . date('d/m/Y') . ' tersimpan'];
                }
                return redirect()->back()->with(
                    ['status' => 'success', 'msg' => 'Rencana/ realisasi hari ' . date('d/m/Y') . ' tersimpan']
                );
            }
        }
        return redirect()->back()->with(
            ['status' => 'error', 'msg' => 'Rencana/ realisasi hari ' . date('d/m/Y') . ' gagal tersimpan']
        );

    }

    public function realisasiMingguan($id_weekly, $oid){
        $exist = DB::table('tb_weekly_progress')
            ->where('id',$id_weekly)
            ->where('id_user', $oid)
            ->first();
        
        $dailys = DB::table('tb_daily_progress')
            ->where('id_task', $id_weekly)
            ->where('id_user', $oid)
            ->orderBy('date', 'desc')
            ->get();

        $officer = DB::table('users')
            ->find($oid);

        return view('pages.output', compact('oid','id_weekly', 'exist', 'dailys', 'officer'));
    }

    public function logBookHarian($id_weekly, $oid){
        $exist = DB::table('tb_weekly_progress')
            ->where('id',$id_weekly)
            ->where('id_user', $oid)
            ->first();
        
        $dailys = DB::table('tb_daily_progress')
            ->where('id_task', $id_weekly)
            ->where('id_user', $oid)
            ->orderBy('date', 'desc')
            ->get();

        return view('pages.logbook', compact('id_weekly', 'exist', 'dailys'));
    }

    public function saveRealisasiMingguan($id_weekly, $oid){
        // checker
        if (
            !$_POST['input_rencana'] || 
            !$_POST['input_output_rencana'] ||
            !$_POST['input_realisasi']
        ) {
            return redirect()->back()->with(
                ['status' => 'error', 'msg' => 'Isian realisasi tidak boleh kosong']
            );
        }

        $exist = DB::table('tb_weekly_progress')
            ->where('id', $id_weekly)
            ->where('id_user', Auth::user()->id)
            ->first();
            
        $arr_files = [];
        if (@$exist){
            $json_data = json_decode($exist->json_data);
            if ($json_data->input_terdapat_cuti){
                return redirect()->to('/reporting')->with(
                    ['status' => 'error', 'msg' => 'Realisasi mingguan gagal tersimpan dikarenakan Cuti']
                );
            }

            $json_data->input_rencana = [$_POST['input_rencana']];
            $json_data->input_output_rencana = [$_POST['input_output_rencana']];
            $json_data->input_realisasi = [$_POST['input_realisasi']];
            $json_data->input_realisasi_time = [date('Y-m-d H:i:s')];
            $json_data->input_realisasi_sebagai_draft = [@$_POST['input_realisasi_sebagai_draft']];

            $json_data->arr_files = @json_decode($exist->json_data)->arr_files;
            if (@$_FILES["upload_file"]["name"][0]){
                $arr_files = [];
                foreach ($_FILES["upload_file"]["name"] as $key => $name){
                    $filename = date('ymdhis')."_".$name;
                    $dir = "docs/users/";
                    if (move_uploaded_file($_FILES['upload_file']['tmp_name'][$key], $dir . $filename)){
                        array_push($arr_files, $dir.$filename);
                    }
                }
                $json_data->arr_files = $arr_files;
            }

            $update = DB::table('tb_weekly_progress')
                ->where('id', $id_weekly)
                ->where('id_user', Auth::user()->id)
                ->update([
                    'json_data' => json_encode($json_data),
                ]);

            if ($update) {
                if (@$_POST['input_realisasi_sebagai_draft']){
                    return redirect()->to('/reporting')->with(
                        ['status' => 'success', 'msg' => 'Draft realisasi minggu ' . $exist->weekNum . ' tersimpan']
                    );
                }
                return redirect()->to('/reporting')->with(
                    ['status' => 'success', 'msg' => 'Realisasi minggu ' . $exist->weekNum . ' tersimpan']
                );
            }
            return ['status' => 'error', 'msg' => 'Realisasi minggu ' . $exist->weekNum . ' gagal tersimpan'];
        }
        return ['status' => 'error', 'msg' => 'Rencana minggu ' . $exist->weekNum . ' tidak tersedia'];
    }

    public function saveRealisasiMingguanKomentar($id_weekly, $oid){
        // checker
        if (
            !$_POST['komentar']
        ) {
            return redirect()->back()->with(
                ['status' => 'error', 'msg' => 'Komentar tidak boleh kosong']
            );
        }

        $exist = DB::table('tb_weekly_progress')
            ->where('id', $id_weekly)
            ->where('id_user', $oid)
            ->first();
        // dd($exist);

        $arr_files = [];
        if (@$exist){
            $json_data = json_decode($exist->json_data);
            if ($json_data->input_terdapat_cuti){
                return redirect()->to('/reporting')->with(
                    ['status' => 'error', 'msg' => 'Realisasi mingguan gagal tersimpan dikarenakan Cuti']
                );
            }

            $json_data->komentar = [$_POST['komentar']];
            $json_data->approved = [$_POST['input_output_rencana']];
            // $json_data->input_realisasi = [$_POST['input_realisasi']];
            // $json_data->input_realisasi_time = [date('Y-m-d H:i:s')];
            // $json_data->input_realisasi_sebagai_draft = [@$_POST['input_realisasi_sebagai_draft']];

            // $json_data->arr_files = @json_decode($exist->json_data)->arr_files;
            // if (@$_FILES["upload_file"]["name"][0]){
            //     $arr_files = [];
            //     foreach ($_FILES["upload_file"]["name"] as $key => $name){
            //         $filename = date('ymdhis')."_".$name;
            //         $dir = "docs/users/";
            //         if (move_uploaded_file($_FILES['upload_file']['tmp_name'][$key], $dir . $filename)){
            //             array_push($arr_files, $dir.$filename);
            //         }
            //     }
            //     $json_data->arr_files = $arr_files;
            // }


            $update = DB::table('tb_weekly_progress')
                ->where('id', $id_weekly)
                ->where('id_user', $oid)
                ->update([
                    'json_data' => json_encode($json_data),
                ]);

            if ($update) {
                if (@$_POST['input_realisasi_sebagai_draft']){
                    return redirect()->to('/list-officer')->with(
                        ['status' => 'success', 'msg' => 'Komentar tersimpan']
                    );
                }
                return redirect()->to('/list-officer')->with(
                    ['status' => 'success', 'msg' => 'Komentar tersimpan']
                );
            }
            return ['status' => 'error', 'msg' => 'Komentar gagal tersimpan'];
        }
        return ['status' => 'error', 'msg' => 'Rencana minggu ' . $exist->weekNum . ' tidak tersedia'];
    }

}
