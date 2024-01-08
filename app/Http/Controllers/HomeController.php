<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function welcome(){

        $blogs = DB::table('blog')->orderByDesc('created_at')->get();
        foreach ($blogs as $key => $b) {
            $blogs[$key]->user = DB::table('users')->where('id', $b->user_id)->first();
        }

        $blogs_populer = DB::table('blog')->orderByDesc('dilihat')->take(5)->get();
        $tanggal_sekarang = date("Y-m-d");
        $pendaftaran = DB::table("pendaftaran")->whereDate("tanggal_buka", "<=", $tanggal_sekarang)->whereDate("tanggal_tutup", ">", $tanggal_sekarang)->first();

        $data = [
            'blogs' => $blogs,
            'blogs_populer' => $blogs_populer,
            'pendaftaran' => $pendaftaran,
        ];

        return view('welcome', $data);

    }

    public function index()
    {
        $user = Auth::user();

        $blogs = DB::table('blog')->orderByDesc('created_at')->get();
        foreach ($blogs as $key => $b) {
            $blogs[$key]->user = DB::table('users')->where('id', $b->user_id)->first();
        }

        $tanggal_sekarang = date("Y-m-d");
        $pendaftaran = DB::table("pendaftaran")->whereDate("tanggal_buka", "<=", $tanggal_sekarang)->whereDate("tanggal_tutup", ">", $tanggal_sekarang)->first();
        $blogs_populer = DB::table('blog')->orderByDesc('dilihat')->take(5)->get();

        $data = [
            'blogs' => $blogs,
            'blogs_populer' => $blogs_populer,
            'pendaftaran' => $pendaftaran,
        ];

        $data = [
            'user' => $user,
            'blogs' => $blogs,
            'blogs_populer' => $blogs_populer,
        ];
        return view('home', $data);
    }

    public function blogDetail($blog_id){
        $user = Auth::user();
        DB::table('blog')->where('id', $blog_id)->increment('dilihat');
        $blog = DB::table('blog')->where('id', $blog_id)->first();

        if(!$user){

            if(!$blog){
                return redirect()->route('index');
            }
            $blogs_populer = DB::table('blog')->orderByDesc('dilihat')->take(5)->get();
            $blog->user = DB::table('users')->where('id', $blog->user_id)->first();

            $data = [
                'blog' => $blog,
                'blogs_populer' => $blogs_populer,
            ];

            return view('detail', $data);

        }else{

            if(!$blog){
                return redirect()->route('home');
            }
            $blogs_populer = DB::table('blog')->orderByDesc('dilihat')->take(5)->get();
            $blog->user = DB::table('users')->where('id', $blog->user_id)->first();

            $data = [
                'user' => $user,
                'blog' => $blog,
                'blogs_populer' => $blogs_populer,
            ];

            return view('blog-detail', $data);


        }
    }

    public function ekstrakulikuler(){
        $ekstrakulikuler = DB::table("ekstrakulikuler")->orderByDesc("judul")->get();
        foreach ($ekstrakulikuler as $key => $e) {
            $ekstrakulikuler[$key]->jumlah_anggota = DB::table('ekstrakulikuler_siswa')->where('ekstrakulikuler_id', $e->id)->count();
        }

        $data = [
            'ekstrakulikuler' => $ekstrakulikuler,
        ];

        return view('app.ekstrakulikuler', $data);
    }

    public function tentang(){
        return view('app.tentang');
    }

    public function fasilitas(){
        $fasilitas = DB::table("fasilitas")->orderByDesc("created_at")->get();

        $data = [
            'fasilitas' => $fasilitas,
        ];

        return view('app.fasilitas', $data);
    }

    public function prestasi(){
        $prestasi = DB::table("prestasi")->orderByDesc("created_at")->get();

        $data = [
            'prestasi' => $prestasi,
        ];

        return view('app.prestasi', $data);
    }


}
