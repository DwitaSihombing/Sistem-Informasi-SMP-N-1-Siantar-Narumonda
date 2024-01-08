<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function getDaftar(){

        $tanggal_sekarang = date("Y-m-d");
        $pendaftaran = DB::table("pendaftaran")->whereDate("tanggal_buka", "<=", $tanggal_sekarang)->whereDate("tanggal_tutup", ">", $tanggal_sekarang)->first();
        if(!$pendaftaran){
            return redirect()->route('home');
        }

        return view('auth.r2');
    }

    public function postDaftar(Request $request){

        $this->validate($request, [
            'surat_keterangan' => ['required', 'file'],
            'kartu_keluarga' => ['required', 'file'],
            'akte_lahir' => ['required', 'file'],
            'nama' => ['required'],
            'tempat_lahir' => ['required'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required'],
            'agama' => ['required'],
            'status_dalam_keluarga' => ['required'],
            'anak_ke' => ['required'],
            'alamat' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);


        if(!$user){
            return back();
        }

        $random_code = rand(11111, 99999);
        $file = $user->id ."_". $random_code . "_". strtotime(date("Y-m-d H:i:s")) .".". $request->surat_keterangan->extension();
        $request->surat_keterangan->move(public_path('img/berkas/surat_keterangan'), $file);

        $lokasi_surat_keterangan = null;
        if(file_exists("img/berkas/surat_keterangan/".$file)){
            $lokasi_surat_keterangan = "img/berkas/surat_keterangan/".$file;
        }

        $random_code = rand(11111, 99999);
        $file = $user->id ."_". $random_code . "_". strtotime(date("Y-m-d H:i:s")) .".". $request->kartu_keluarga->extension();
        $request->kartu_keluarga->move(public_path('img/berkas/kartu_keluarga'), $file);

        $lokasi_kartu_keluarga = null;
        if(file_exists("img/berkas/kartu_keluarga/".$file)){
            $lokasi_kartu_keluarga = "img/berkas/kartu_keluarga/".$file;
        }

        $random_code = rand(11111, 99999);
        $file = $user->id ."_". $random_code . "_". strtotime(date("Y-m-d H:i:s")) .".". $request->akte_lahir->extension();
        $request->akte_lahir->move(public_path('img/berkas/akte_lahir'), $file);

        $lokasi_akte_lahir = null;
        if(file_exists("img/berkas/akte_lahir/".$file)){
            $lokasi_akte_lahir = "img/berkas/akte_lahir/".$file;
        }

        DB::table('calon_siswa')->insert([
            'user_id' => $user->id,
            'surat_keterangan' => $lokasi_surat_keterangan,
            'kartu_keluarga' => $lokasi_kartu_keluarga,
            'akte_lahir' => $lokasi_akte_lahir,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'status_dalam_keluarga' => $request->status_dalam_keluarga,
            'anak_ke' => $request->anak_ke,
            'alamat' => $request->alamat,
            'nomor_telepon' => $request->nomor_telepon,
            'sekolah_asal' => $request->sekolah_asal,
            'nama_ayah' => $request->nama_ayah,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'nama_ibu' => $request->nama_ibu,
            'pekerjaan_ibu' => $request->pekerjaan_ibu,
            'alamat_orang_tua' => $request->alamat_orang_tua,
            'nomor_telepon_orang_tua' => $request->nomor_telepon_orang_tua,
            'nama_wali' => $request->nama_wali,
            'alamat_wali' => $request->alamat_wali,
            'nomor_telepon_wali' => $request->nomor_telepon_wali,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        return redirect()->route('login');
    }

    public function getProfile(){

        $user = Auth::user();
        $user->data = DB::table('calon_siswa')->where('user_id', $user->id)->first();


        $data = [
            'user' => $user,
        ];

        return view('app.user', $data);
    }


    public function postEditPhoto(Request $request){

        $user = Auth::user();
        $this->validate($request, [
            'photo' => ['required', 'image'],
        ]);

        $random_code = rand(11111, 99999);
        $file = $user->id ."_". $random_code . "_". strtotime(date("Y-m-d H:i:s")) .".". $request->photo->extension();

        $request->photo->move(public_path('img/photo'), $file);
        if(! file_exists("img/photo/".$file)){
            return back();
        }

        if(File::exists($user->photo)){
            unlink($user->photo);
        }

        DB::table('users')->where('id', $user->id)->update([
            'photo' => "img/photo/" . $file,
        ]);

        return back();
    }

    public function postEditAccount(Request $request){

        $user = Auth::user();
        $this->validate($request, [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email,'.$user->id.',id'],
        ]);

        DB::table('users')->where('id', $user->id)->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('user');
    }

    public function postEditPassword(Request $request){

        $user = Auth::user();
        $this->validate($request, [
            'password' => ['required'],
            'old_password' => ['required'],
        ]);

        if(! Hash::check($request->old_password, $user->password)){
            return redirect()->route('user');
        }

        DB::table('users')->where('id', $user->id)->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user');
    }

    public function postEditCalonSiswa(Request $request){

        $user = Auth::user();

        $this->validate($request, [
            'tempat_lahir' => ['required'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required'],
            'agama' => ['required'],
            'status_dalam_keluarga' => ['required'],
            'anak_ke' => ['required'],
            'alamat' => ['required'],
        ]);

        $dataSiswa = DB::table('calon_siswa')->where('user_id', $user->id)->first();
        if($dataSiswa){
            DB::table('calon_siswa')->where('user_id', $user->id)->update([
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'agama' => $request->agama,
                'status_dalam_keluarga' => $request->status_dalam_keluarga,
                'anak_ke' => $request->anak_ke,
                'alamat' => $request->alamat,
                'nomor_telepon' => $request->nomor_telepon,
                'sekolah_asal' => $request->sekolah_asal,
                'nama_ayah' => $request->nama_ayah,
                'pekerjaan_ayah' => $request->pekerjaan_ayah,
                'nama_ibu' => $request->nama_ibu,
                'pekerjaan_ibu' => $request->pekerjaan_ibu,
                'alamat_orang_tua' => $request->alamat_orang_tua,
                'nomor_telepon_orang_tua' => $request->nomor_telepon_orang_tua,
                'nama_wali' => $request->nama_wali,
                'alamat_wali' => $request->alamat_wali,
                'nomor_telepon_wali' => $request->nomor_telepon_wali,
                'updated_at' => now(),
            ]);
        }else{
            DB::table('calon_siswa')->insert([
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'agama' => $request->agama,
                'status_dalam_keluarga' => $request->status_dalam_keluarga,
                'anak_ke' => $request->anak_ke,
                'alamat' => $request->alamat,
                'nomor_telepon' => $request->nomor_telepon,
                'sekolah_asal' => $request->sekolah_asal,
                'nama_ayah' => $request->nama_ayah,
                'pekerjaan_ayah' => $request->pekerjaan_ayah,
                'nama_ibu' => $request->nama_ibu,
                'pekerjaan_ibu' => $request->pekerjaan_ibu,
                'alamat_orang_tua' => $request->alamat_orang_tua,
                'nomor_telepon_orang_tua' => $request->nomor_telepon_orang_tua,
                'nama_wali' => $request->nama_wali,
                'alamat_wali' => $request->alamat_wali,
                'nomor_telepon_wali' => $request->nomor_telepon_wali,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->route('user');

    }

    public function postEditBerkas(Request $request){

        $this->validate($request, [
            'surat_keterangan' => ['required', 'file'],
            'kartu_keluarga' => ['required', 'file'],
            'akte_lahir' => ['required', 'file'],
        ]);

        $user = Auth::user();

        $calon = DB::table('calon_siswa')->where('user_id', $user->id)->first();
        if(!$calon){
            return back();
        }

        $random_code = rand(11111, 99999);
        $file = $user->id ."_". $random_code . "_". strtotime(date("Y-m-d H:i:s")) .".". $request->surat_keterangan->extension();
        $request->surat_keterangan->move(public_path('img/berkas/surat_keterangan'), $file);

        $lokasi_surat_keterangan = null;
        if(file_exists("img/berkas/surat_keterangan/".$file)){
            unlink($calon->surat_keterangan);
            $lokasi_surat_keterangan = "img/berkas/surat_keterangan/".$file;
        }

        $random_code = rand(11111, 99999);
        $file = $user->id ."_". $random_code . "_". strtotime(date("Y-m-d H:i:s")) .".". $request->kartu_keluarga->extension();
        $request->kartu_keluarga->move(public_path('img/berkas/kartu_keluarga'), $file);

        $lokasi_kartu_keluarga = null;
        if(file_exists("img/berkas/kartu_keluarga/".$file)){
            unlink($calon->kartu_keluarga);
            $lokasi_kartu_keluarga = "img/berkas/kartu_keluarga/".$file;
        }

        $random_code = rand(11111, 99999);
        $file = $user->id ."_". $random_code . "_". strtotime(date("Y-m-d H:i:s")) .".". $request->akte_lahir->extension();
        $request->akte_lahir->move(public_path('img/berkas/akte_lahir'), $file);

        $lokasi_akte_lahir = null;
        if(file_exists("img/berkas/akte_lahir/".$file)){
            unlink($calon->akte_lahir);
            $lokasi_akte_lahir = "img/berkas/akte_lahir/".$file;
        }

        DB::table('calon_siswa')->where('user_id', $user->id)->update([
            'surat_keterangan' => $lokasi_surat_keterangan,
            'kartu_keluarga' => $lokasi_kartu_keluarga,
            'akte_lahir' => $lokasi_akte_lahir,
            'updated_at' => now(),
        ]);

        return back();
    }
}
