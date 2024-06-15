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

    public function realisasiMingguan($id_weekly){
        $exist = DB::table('tb_weekly_progress')
            ->where('id',$id_weekly)
            ->where('id_user', Auth::user()->id)
            ->first();

        return view('pages.output', compact('id_weekly', 'exist'));
    }

    public function saveRealisasiMingguan($id_weekly){
        $exist = DB::table('tb_weekly_progress')
            ->where('id', $id_weekly)
            ->where('id_user', Auth::user()->id)
            ->first();

            
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
}
