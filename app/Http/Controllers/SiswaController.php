<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use League\CommonMark\Extension\Table\Table;

class SiswaController extends Controller
{
    public function ekstrakulikuler(){

        $user = Auth::user();
        $ekstrakulikuler = DB::table("ekstrakulikuler")->orderByDesc("created_at")->get();
        foreach ($ekstrakulikuler as $key => $e) {
            $ekstrakulikuler[$key]->jumlah_anggota = DB::table('ekstrakulikuler_siswa')->where('ekstrakulikuler_id', $e->id)->count();
        }

        $ekstraKu = DB::table('ekstrakulikuler_siswa')->where('user_id', $user->id)->first();

        $data = [
            'user' => $user,
            'ekstrakulikuler' => $ekstrakulikuler,
            'ekstraKu' => $ekstraKu,
        ];

        return view('app.siswa.ekstrakulikuler', $data);
    }

    public function getDetailEkstrakulikuler($ekstrakulikuler_id){

        $user = Auth::user();
        $ekstrakulikuler = DB::table("ekstrakulikuler")->where('id', $ekstrakulikuler_id)->first();
        if(!$ekstrakulikuler){
            return redirect()->route('siswa.ekstrakulikuler');
        }

        $ekstrakulikuler_siswa = DB::table("ekstrakulikuler_siswa")->where('user_id', $user->id)->where('ekstrakulikuler_id', $ekstrakulikuler_id)->first();
        if(!$ekstrakulikuler_siswa){
            return redirect()->route('siswa.ekstrakulikuler');
        }

        $ekstrakulikuler->jumlah_anggota = DB::table('ekstrakulikuler_siswa')->where('ekstrakulikuler_id', $ekstrakulikuler->id)->count();

        $anggota = DB::table('users')->where('role', 1)->whereIn('id', function($q) use ($ekstrakulikuler_id){
            $q->select('user_id')->from(DB::table('ekstrakulikuler_siswa'))->where('ekstrakulikuler_id', $ekstrakulikuler_id);
        })->orderBy('name')->get();

        foreach ($anggota as $key => $a) {
            $anggota[$key]->data = DB::table('siswa')->where('user_id', $a->id)->first();
            if(! $anggota[$key]->data){
                DB::table('ekstrakulikuler_siswa')->where('user_id', $a->id)->delete();
                unset($anggota[$key]);
                continue;
            }
        }

        $data = [
            'user' => $user,
            'ekstrakulikuler' => $ekstrakulikuler,
            'anggota' => $anggota,
        ];

        return view('app.siswa.ekstrakulikuler.detail', $data);
    }

    public function getJoinEkstrakulikuler($ekstrakulikuler_id){

        $ekstrakulikuler = DB::table("ekstrakulikuler")->where('id', $ekstrakulikuler_id)->first();
        if(!$ekstrakulikuler){
            return redirect()->route('siswa.ekstrakulikuler');
        }

        $allAnggota = DB::table('ekstrakulikuler_siswa')->where('ekstrakulikuler_id', $ekstrakulikuler->id)->get();
        foreach ($allAnggota as $a) {
            $akun = DB::table('users')->where('id', $a->user_id)->count();
            if(!$akun){
                DB::table('ekstrakulikuler_siswa')->where('user_id', $a->user_id)->delete();
            }
        }

        $user = Auth::user();
        $ekstraKu = DB::table('ekstrakulikuler_siswa')->where('user_id', $user->id)->count();

        if($ekstraKu <= 0){
            DB::table('ekstrakulikuler_siswa')->insert([
                'user_id' => $user->id,
                'ekstrakulikuler_id' => $ekstrakulikuler_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->route('siswa.ekstrakulikuler');
    }

}
