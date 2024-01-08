<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GuruController extends Controller
{
    public function ekstrakulikuler(){

        $user = Auth::user();
        $ekstrakulikuler = DB::table("ekstrakulikuler")->orderByDesc("created_at")->get();
        foreach ($ekstrakulikuler as $key => $e) {
            $ekstrakulikuler[$key]->jumlah_anggota = DB::table('ekstrakulikuler_siswa')->where('ekstrakulikuler_id', $e->id)->count();
        }

        $data = [
            'user' => $user,
            'ekstrakulikuler' => $ekstrakulikuler,
        ];

        return view('app.guru.ekstrakulikuler', $data);
    }

    public function getAddEkstrakulikuler(){

        $user = Auth::user();

        $data = [
            'user' => $user,
        ];

        return view('app.guru.ekstrakulikuler.add', $data);
    }

    public function postAddEkstrakulikuler(Request $request){

        $this->validate($request, [
            'judul' => ['required', 'string'],
            'terbuka' => ['numeric'],
            'deskripsi' => ['required', 'string'],
        ]);

        $user = Auth::user();

        DB::table('ekstrakulikuler')->insert([
            'user_id' => $user->id,
            'judul' => $request->judul,
            'terbuka' => $request->terbuka,
            'deskripsi' => $request->deskripsi,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('guru.ekstrakulikuler');
    }


    public function getDeleteEkstrakulikuler($ekstrakulikuler_id){

        $user = Auth::user();

        $ekstrakulikuler = DB::table('ekstrakulikuler')->where('user_id', $user->id)->where('id', $ekstrakulikuler_id)->first();
        if(!$ekstrakulikuler){
            return redirect()->route('guru.ekstrakulikuler');
        }

        DB::table('ekstrakulikuler_siswa')->where('ekstrakulikuler_id', $ekstrakulikuler_id)->delete();
        DB::table('ekstrakulikuler')->where('id', $ekstrakulikuler_id)->delete();
        return redirect()->route('guru.ekstrakulikuler');

    }

    public function getEditEkstrakulikuler($ekstrakulikuler_id){

        $user = Auth::user();

        $ekstrakulikuler = DB::table('ekstrakulikuler')->where('user_id', $user->id)->where('id', $ekstrakulikuler_id)->first();
        if(!$ekstrakulikuler){
            return redirect()->route('guru.ekstrakulikuler');
        }


        $data = [
            'ekstrakulikuler' => $ekstrakulikuler,
            'user' => $user,
        ];

        return view('app.guru.ekstrakulikuler.edit', $data);

    }

    public function postEditEkstrakulikuler(Request $request){

        $this->validate($request, [
            'ekstrakulikuler_id' => ['required', 'exists:ekstrakulikuler,id'],
            'judul' => ['required', 'string'],
            'terbuka' => ['numeric'],
            'deskripsi' => ['required', 'string'],
        ]);

        $user = Auth::user();
        $ekstrakulikuler = DB::table('ekstrakulikuler')->where('user_id', $user->id)->where('id', $request->ekstrakulikuler_id)->first();
        if(!$ekstrakulikuler){
            return redirect()->route('guru.ekstrakulikuler');
        }

        DB::table('ekstrakulikuler')->where('id', $request->ekstrakulikuler_id)->update([
            'judul' => $request->judul,
            'terbuka' => $request->terbuka,
            'deskripsi' => $request->deskripsi,
            'updated_at' => now(),
        ]);

        return redirect()->route('guru.ekstrakulikuler');
    }

    public function getAnggotaEkstrakulikuler($ekstrakulikuler_id){

        $user = Auth::user();
        $ekstrakulikuler = DB::table('ekstrakulikuler')->where('user_id', $user->id)->where('id',$ekstrakulikuler_id)->first();
        if(!$ekstrakulikuler){
            return redirect()->route('guru.ekstrakulikuler');
        }

        $ekstrakulikuler->jumlah_anggota = DB::table('ekstrakulikuler_siswa')->where('ekstrakulikuler_id', $ekstrakulikuler->id)->count();

        $anggota = DB::table('users')->where('role', 1)->whereIn('id', function($q) use ($ekstrakulikuler_id){
            $q->select('user_id')->from(DB::table('ekstrakulikuler_siswa'))->where('ekstrakulikuler_id', $ekstrakulikuler_id);
        })->orderBy('name')->get();

        foreach ($anggota as $key => $a) {
            $anggota[$key]->data = DB::table('siswa')->where('user_id', $a->id)->first();
            if(! $anggota[$key]->data){
                unset($anggota[$key]);
                continue;
            }
        }

        $data = [
            'user' => $user,
            'anggota' => $anggota,
            'ekstrakulikuler' => $ekstrakulikuler,
        ];

        return view('app.guru.ekstrakulikuler.anggota', $data);

    }

    public function getDeleteAnggotaEkstrakulikuler($ekstrakulikuler_id, $anggota_id){

        $user = Auth::user();
        $ekstrakulikuler = DB::table('ekstrakulikuler')->where('user_id', $user->id)->where('id',$ekstrakulikuler_id)->first();
        if(!$ekstrakulikuler){
            return redirect()->route('guru.ekstrakulikuler');
        }

        DB::table('ekstrakulikuler_siswa')->where('user_id', $anggota_id)->where('ekstrakulikuler_id',$ekstrakulikuler_id)->delete();
        return redirect()->route('guru.ekstrakulikuler.anggota', ['ekstrakulikuler_id'=>$ekstrakulikuler_id]);

    }

}
