<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    public function user(){

        $user = Auth::user();
        $users = DB::table('users')->orderByDesc('created_at')->get();

        $data = [
            'user' => $user,
            'users' => $users,
        ];

        return view('app.admin.user', $data);

    }

    public function getUserAdd(){
        $user = Auth::user();

        $data = [
            'user' => $user,
        ];

        return view('app.admin.user.add', $data);
    }

    public function postUserAdd(Request $request){

        $this->validate($request, [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'role' => ['required', 'numeric'],
        ]);

        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make("psi07"),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.user');
    }

    public function getUserEdit($user_id){
        $user = Auth::user();
        $tUser = DB::table('users')->where('id', $user_id)->first();

        $data = [
            'user' => $user,
            'tUser' => $tUser,
        ];

        return view('app.admin.user.edit', $data);
    }

    public function postUserEdit(Request $request){

        $this->validate($request, [
            'user_id' => ['required', 'exists:users,id'],
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email,'.$request->user_id.',id'],
            'role' => ['required', 'numeric'],
        ]);

        DB::table('users')->where('id', $request->user_id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make("psi07"),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.user');
    }

    public function getUserDelete($user_id){
        $user = DB::table('users')->where('id', $user_id)->first();
        if(File::exists($user->photo)){
            unlink($user->photo);
        }

        $user = DB::table('users')->where('id', $user_id)->delete();
        return redirect()->route('admin.user');
    }

    public function fasilitas(){

        $user = Auth::user();
        $fasilitas = DB::table('fasilitas')->orderByDesc('created_at')->get();

        $data = [
            'user' => $user,
            'fasilitas' => $fasilitas,
        ];

        return view('app.admin.fasilitas', $data);
    }

    public function getFasilitasAdd(){
        $user = Auth::user();

        $data = [
            'user' => $user,
        ];

        return view('app.admin.fasilitas.add', $data);
    }

    public function postFasilitasAdd(Request $request){

        $this->validate($request, [
            'cover' => ['required', 'image'],
            'keterangan' => ['required', 'string'],
        ]);

        $user = Auth::user();

        $random_code = rand(11111, 99999);
        $file = $user->id ."_". $random_code . "_". strtotime(date("Y-m-d H:i:s")) .".". $request->cover->extension();

        $request->cover->move(public_path('img/fasilitas'), $file);
        if(! file_exists("img/fasilitas/".$file)){
            $v = Validator::make([], []);
            $v->getMessageBag()->add('cover', 'Gagal mengupload cover, silahkan mencoba kembali!');
            return back()->withErrors($v)->withInput();
        }

        DB::table('fasilitas')->insert([
            'cover' => "img/fasilitas/".$file,
            'keterangan' => $request->keterangan,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.fasilitas');
    }

    public function getFasilitasEdit($fasilitas_id){
        $user = Auth::user();
        $fasilitas = DB::table('fasilitas')->where('id', $fasilitas_id)->first();
        if(!$fasilitas){
            return redirect()->route('admin.fasilitas');
        }

        $data = [
            'user' => $user,
            'fasilitas' => $fasilitas,
        ];

        return view('app.admin.fasilitas.edit', $data);
    }

    public function postFasilitasEdit(Request $request){

        $this->validate($request, [
            'fasilitas_id' => ['required', 'exists:fasilitas,id'],
            'keterangan' => ['required', 'string'],
            'cover' => ['nullable', 'image'],
        ]);

        $user = Auth::user();

        if($request->cover){
            $random_code = rand(11111, 99999);
            $file = $user->id ."_". $random_code . "_". strtotime(date("Y-m-d H:i:s")) .".". $request->cover->extension();

            $request->cover->move(public_path('img/fasilitas'), $file);
            if(! file_exists("img/fasilitas/".$file)){
                $v = Validator::make([], []);
                $v->getMessageBag()->add('cover', 'Gagal mengupload cover, silahkan mencoba kembali!');
                return back()->withErrors($v)->withInput();
            }

            $fasilitas = DB::table('fasilitas')->where('id', $request->fasilitas_id)->first();
            if(File::exists($fasilitas->cover)){
                unlink($fasilitas->cover);
            }

            DB::table('fasilitas')->where('id', $request->fasilitas_id)->update([
                'cover' => "img/fasilitas/".$file,
                'keterangan' => $request->keterangan,
                'updated_at' => now(),
            ]);
        }
        else{

            DB::table('fasilitas')->where('id', $request->fasilitas_id)->update([
                'keterangan' => $request->keterangan,
                'updated_at' => now(),
            ]);

        }


        return redirect()->route('admin.fasilitas');
    }

    public function getFasilitasDelete($fasilitas_id){
        $fasilitas = DB::table('fasilitas')->where('id', $fasilitas_id)->first();
        if(File::exists($fasilitas->cover)){
            unlink($fasilitas->cover);
        }

        $fasilitas = DB::table('fasilitas')->where('id', $fasilitas_id)->delete();
        return redirect()->route('admin.fasilitas');
    }


    public function prestasi(){

        $user = Auth::user();
        $prestasi = DB::table('prestasi')->orderByDesc('created_at')->get();

        $data = [
            'user' => $user,
            'prestasi' => $prestasi,
        ];

        return view('app.admin.prestasi', $data);
    }

    public function getPrestasiAdd(){
        $user = Auth::user();

        $data = [
            'user' => $user,
        ];

        return view('app.admin.prestasi.add', $data);
    }

    public function postPrestasiAdd(Request $request){

        $this->validate($request, [
            'cover' => ['required', 'image'],
            'keterangan' => ['required', 'string'],
        ]);

        $user = Auth::user();

        $random_code = rand(11111, 99999);
        $file = $user->id ."_". $random_code . "_". strtotime(date("Y-m-d H:i:s")) .".". $request->cover->extension();

        $request->cover->move(public_path('img/prestasi'), $file);
        if(! file_exists("img/prestasi/".$file)){
            $v = Validator::make([], []);
            $v->getMessageBag()->add('cover', 'Gagal mengupload cover, silahkan mencoba kembali!');
            return back()->withErrors($v)->withInput();
        }

        DB::table('prestasi')->insert([
            'cover' => "img/prestasi/".$file,
            'keterangan' => $request->keterangan,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.prestasi');
    }

    public function getPrestasiEdit($prestasi_id){
        $user = Auth::user();
        $prestasi = DB::table('prestasi')->where('id', $prestasi_id)->first();
        if(!$prestasi){
            return redirect()->route('admin.prestasi');
        }

        $data = [
            'user' => $user,
            'prestasi' => $prestasi,
        ];

        return view('app.admin.prestasi.edit', $data);
    }

    public function postPrestasiEdit(Request $request){

        $this->validate($request, [
            'prestasi_id' => ['required', 'exists:prestasi,id'],
            'keterangan' => ['required', 'string'],
            'cover' => ['nullable', 'image'],
        ]);

        $user = Auth::user();

        if($request->cover){
            $random_code = rand(11111, 99999);
            $file = $user->id ."_". $random_code . "_". strtotime(date("Y-m-d H:i:s")) .".". $request->cover->extension();

            $request->cover->move(public_path('img/prestasi'), $file);
            if(! file_exists("img/prestasi/".$file)){
                $v = Validator::make([], []);
                $v->getMessageBag()->add('cover', 'Gagal mengupload cover, silahkan mencoba kembali!');
                return back()->withErrors($v)->withInput();
            }

            $prestasi = DB::table('prestasi')->where('id', $request->prestasi_id)->first();
            if(File::exists($prestasi->cover)){
                unlink($prestasi->cover);
            }

            DB::table('prestasi')->where('id', $request->prestasi_id)->update([
                'cover' => "img/prestasi/".$file,
                'keterangan' => $request->keterangan,
                'updated_at' => now(),
            ]);
        }
        else{

            DB::table('prestasi')->where('id', $request->prestasi_id)->update([
                'keterangan' => $request->keterangan,
                'updated_at' => now(),
            ]);

        }


        return redirect()->route('admin.prestasi');
    }

    public function getPrestasiDelete($prestasi_id){
        $prestasi = DB::table('prestasi')->where('id', $prestasi_id)->first();
        if(File::exists($prestasi->cover)){
            unlink($prestasi->cover);
        }

        $prestasi = DB::table('prestasi')->where('id', $prestasi_id)->delete();
        return redirect()->route('admin.prestasi');
    }


}
