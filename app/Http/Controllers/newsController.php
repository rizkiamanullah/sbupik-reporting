<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class newsController extends Controller
{
    public function fetchNews(){
        $get = $_GET;
        $data = DB::table('news')
        ->where('id',$get['id'])
        ->first();
        return json_encode($data);
    }

    public function storeNews(){
        $post = $_POST;
        if ($post['type'] = "update"){
            $update = DB::table('news')
            ->where('id',$post['id'])
            ->update([
                "title" => $post['judul_berita'],
                "message" => $post['editordata'],
            ]);
            if ($update){
                return redirect('/news-management');
            }
        }
        $insert = DB::table('news')
        ->insert([
            "title" => $post['judul_berita'],
            "message" => $post['editordata'],
            "type" => $post['type'],
            "created_at" => date('Y-m-d H:i:s'),
            "created_by" => Auth::user()->username,
        ]);
        if ($insert){
            return redirect('/news-management');
        }
        return ['status' => 403, 'message' => 'Insert failed :('];
    }

    public function archiveNews(){
        $post = $_POST;
        // dd($post);
        $json = [
            'archived' => 1,
        ];
        $update = DB::table('news')
            ->where('id', $post['id'])
            ->update([
                "json_details" => json_encode($json),
            ]);
        if ($update) {
            return ['status' => 200, 'message' => 'Archived'];
        }
        return ['status' => 403, 'message' => 'Archive failed :('];
    }
}
