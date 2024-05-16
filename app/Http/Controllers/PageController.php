<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PageController extends Controller
{
    /**
     * Display all the static pages when authenticated
     *
     * @param string $page
     * @return \Illuminate\View\View
     */

    
    public function index(string $page)
    {
        // dd($page, view()->exists("pages.{$page}"));
        if (view()->exists("pages.{$page}")) {
            $data = [];
            $dataRoles = [];
            if (Auth::user()->user_role_id == 99){
                if ($page == "project-management"){
                    $data = DB::table("projects")
                    ->get();
                    return view("pages.{$page}", compact('data', 'dataRoles'));
                }
                if ($page == "user-management"){
                    $data = DB::table("users")
                    ->get();
                    $dataRoles = DB::table("user_roles")
                    ->get();
                    return view("pages.{$page}", compact('data', 'dataRoles'));

                }
                if ($page == "customer-management"){
                    $data = DB::table("customers")
                    ->get();
                    return view("pages.{$page}", compact('data', 'dataRoles'));

                }
                if ($page == "role-management"){
                    $data = DB::table("user_roles")
                    ->get();
                    return view("pages.{$page}", compact('data', 'dataRoles'));
                }
                if ($page == "news-management") {
                    $news = DB::table('news')
                        ->where('type', 1)
                        ->get();
                    $announ = DB::table('news')
                        ->where('type', 2)
                        ->get();
                    return view("pages.{$page}", compact('news', 'announ'));
                }
                if ($page == "my-message") {
                    $data = DB::table("users")
                        ->get();
                    $messages = DB::table('direct_messages')
                        ->get();
                    return view("pages.{$page}", compact('data', 'messages'));

                }
            }
            if ($page == "my-message"){
                $data = DB::table("users")
                ->where('id','!=',Auth::user()->id)
                ->get();
                $messages = DB::table('direct_messages')
                ->where('sender_user_id', Auth::user()->id)
                ->orWhere('receiver_user_id', Auth::user()->id)
                ->get();
                return view("pages.{$page}", compact('data', 'messages'));
                
            }
            if ($page == "news-management") {
                $news = DB::table('news')
                    ->where('type', 1)
                    ->get();
                $announ = DB::table('news')
                    ->where('type', 2)
                    ->get();
                return view("pages.{$page}", compact('news', 'announ'));
            }
            if ($page == "project-management") {
                $data = DB::table("projects")
                    ->get();
                return view("pages.{$page}", compact('data', 'dataRoles'));
            }
            if ($page == "reporting") {
                $dataToday = DB::table("tb_daily_progress")
                    ->where('id_user',Auth::user()->id)
                    ->where('date',date('Y-m-d'))
                    ->first();
                $dataOther = DB::table("tb_daily_progress")
                    ->where('id_user', Auth::user()->id)
                    ->where('date','<',date('Y-m-d'))
                    ->get();
                return view("pages.{$page}", compact('dataToday', 'dataOther'));
            }
            if ($page == "monthly") {
                $dataToday = DB::table("tb_daily_progress")
                    ->where('id_user',Auth::user()->id)
                    ->where('date',date('Y-m-d'))
                    ->first();
                $dataOther = DB::table("tb_daily_progress")
                    ->where('id_user', Auth::user()->id)
                    ->where('date','<',date('Y-m-d'))
                    ->get();
                return view("pages.{$page}", compact('dataToday', 'dataOther'));
            }
            if ($page == "pm-report") {
                $dataUser = DB::table('users')
                ->where('user_role_id', 1)
                ->where('username','!=',Auth::user()->username)
                ->get();

                $dataOther = DB::table("tb_daily_progress")
                    ->where('id_user', Auth::user()->id)
                    ->where('date','<',date('Y-m-d'))
                    ->get();
                return view("pages.{$page}", compact('dataUser', 'dataOther'));
            }
            if ($page == "list-officer") {
                $dataUser = DB::table('users')
                ->where('user_role_id', 1)
                ->get();

                $dataOther = DB::table("tb_daily_progress")
                    ->where('id_user', Auth::user()->id)
                    ->where('date','<',date('Y-m-d'))
                    ->get();
                return view("pages.{$page}", compact('dataUser', 'dataOther'));
            }
        }
        return abort(404);
    }

    public function updateRowData(){
        if ($_POST['type'] == 'user'){
            $update = DB::table('users')
            ->where('id', $_POST['id'])
            ->update([
                'username' => $_POST['nama'],
                'user_role_id' => $_POST['role'],
                'email' => $_POST['email'],
            ]);
        }
        if ($_POST['type'] == 'role'){
            $update = DB::table('user_roles')
            ->where('id', $_POST['id'])
            ->update([
                'nama' => $_POST['nama'],
            ]);
        }
        if ($_POST['type'] == 'customer'){
            $update = DB::table('customers')
            ->where('id', $_POST['id'])
            ->update([
                'nama' => $_POST['nama'],
            ]);
        }

        if ($update){
            return ['status' => 200, 'msg' => 'Updated'];
        }
        return ['status' => 403, 'msg' => 'Error'];
    }
    public function saveRowData(){
        if ($_POST['type'] == 'user'){
            $insert = DB::table('users')
            ->insert([
                'username' => $_POST['nama'],
                'user_role_id' => $_POST['role'],
                'email' => $_POST['email'],
                'created_at' => date('Y-m-d H:i:s'),
                'password' => Hash::make($_POST['password']),
            ]);
        }
        if ($_POST['type'] == 'role'){
            $insert = DB::table('user_roles')
            ->insert([
                'nama' => $_POST['nama'],
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => Auth::user()->email,
            ]);
        }
        if ($_POST['type'] == 'customer'){
            $insert = DB::table('customers')
            ->insert([
                'nama' => $_POST['nama'],
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => Auth::user()->email,
            ]);
        }

        if ($insert){
            return ['status' => 200, 'msg' => 'Saved'];
        }
        return ['status' => 403, 'msg' => 'Error'];
    }

    public function deleteRowData(){
        if ($_POST['type'] == 'user'){
            $delete = DB::table('users')
            ->where('id', $_POST['id'])
            ->delete();
        }
        if ($_POST['type'] == 'role'){
            $delete = DB::table('user_roles')
            ->where('id', $_POST['id'])
            ->delete();
        }
        if ($_POST['type'] == 'customer'){
            $delete = DB::table('customers')
            ->where('id', $_POST['id'])
            ->delete();
        }

        if ($delete){
            return ['status' => 200, 'msg' => 'Deleted'];
        }
        return ['status' => 403, 'msg' => 'Error'];
    }
}
