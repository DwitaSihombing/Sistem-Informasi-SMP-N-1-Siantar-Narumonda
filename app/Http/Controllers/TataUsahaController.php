<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use stdClass;

class TataUsahaController extends Controller
{

    public function getPendaftar(){

        $user = Auth::user();
        $studentCandidates = DB::table('calon_siswa')->orderByDesc('created_at')->get();

    }

    public function murid(){

        $user = Auth::user();
        $users = DB::table('users')->where('role', 1)->orderByDesc('created_at')->get();
        foreach ($users as $key => $u) {
            $users[$key]->dataDiri = DB::table('siswa')->where('user_id', $u->id)->count();
        }

        $data = [
            'user' => $user,
            'users' => $users,
        ];

        return view('app.tatausaha.murid', $data);
    }

    public function getEditMurid($user_id){

        $tUser = DB::table('users')->where('id', $user_id)->first();
        if(! $tUser){
            return redirect()->route('tatausaha.murid');
        }

        $tUser->data = DB::table('siswa')->where('user_id', $tUser->id)->first();

        $user = Auth::user();

        $data = [
            'user' => $user,
            'tUser' => $tUser,
        ];

        return view('app.tatausaha.murid.edit', $data);

    }

    public function postEditMurid(Request $request){

        $this->validate($request, [
            'user_id' => ['required'],
            'nama' => ['required'],
            'tempat_lahir' => ['required'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required'],
            'agama' => ['required'],
            'status_dalam_keluarga' => ['required'],
            'anak_ke' => ['required'],
            'alamat' => ['required'],
        ]);

        $user = DB::table('users')->where('id', $request->user_id)->where('role', 1)->first();
        if(!$user){
            return back();
        }

        DB::table('users')->where('id', $request->id)->update([
            'name' => $request->nama,
        ]);

        $dataSiswa = DB::table('siswa')->where('user_id', $request->user_id)->first();
        if($dataSiswa){
            DB::table('siswa')->where('user_id', $request->user_id)->update([
                'nisn' => $request->nisn,
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
        }else{
            DB::table('siswa')->insert([
                'user_id' => $user->id,
                'nisn' => $request->nisn,
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



        return redirect()->route('tatausaha.murid');
    }

    public function pendaftaran(){

        $user = Auth::user();
        $pendaftaran = DB::table('pendaftaran')->orderByDesc('created_at')->get();

        $data = [
            'user' => $user,
            'pendaftaran' => $pendaftaran,
        ];

        return view('app.tatausaha.pendaftaran', $data);
    }

    public function getAddPendaftaran(){

        $user = Auth::user();

        $data = [
            'user' => $user,
        ];

        return view('app.tatausaha.pendaftaran.add', $data);

    }

    public function postAddPendaftaran(Request $request){
        $this->validate($request, [
            'judul' => ['required', 'string'],
            'tanggal_buka' => ['required', 'date'],
            'tanggal_tutup' => ['required', 'date'],
        ]);

        DB::table('pendaftaran')->insert([
            'judul' => $request->judul,
            'tanggal_buka' => $request->tanggal_buka,
            'tanggal_tutup' => $request->tanggal_tutup,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('tatausaha.pendaftaran');
    }


    public function getEditPendaftaran($pendaftaran_id){

        $user = Auth::user();
        $pendaftaran = DB::table('pendaftaran')->where('id', $pendaftaran_id)->first();
        if(!$pendaftaran){
            return redirect()->route('tatausaha.pendaftaran');
        }

        $data = [
            'user' => $user,
            'pendaftaran' => $pendaftaran,
        ];

        return view('app.tatausaha.pendaftaran.edit', $data);

    }

    public function getVerefiedCalonSiswa($user_id, $pendaftaran_id, $action){

        $pendaftaran = DB::table('pendaftaran')->where('id', $pendaftaran_id)->first();
        if(!$pendaftaran){
            return redirect()->route('tatausaha.pendaftaran');
        }

        $user = DB::table('users')->where('id', $user_id)->first();
        if(! $user){
            return redirect()->route('tatausaha.pendaftaran');
        }

        if($action > 0){

            if($user->is_verified == 1){
                DB::table('users')->where('id', $user_id)->update(['role'=> 1]);

                $calon_siswa = DB::table('calon_siswa')->where('user_id', $user_id)->first();
                if($calon_siswa){
                    DB::table('siswa')->insert([
                        'user_id' => $user->id,
                        'tempat_lahir' => $calon_siswa->tempat_lahir,
                        'tanggal_lahir' => $calon_siswa->tanggal_lahir,
                        'jenis_kelamin' => $calon_siswa->jenis_kelamin,
                        'agama' => $calon_siswa->agama,
                        'status_dalam_keluarga' => $calon_siswa->status_dalam_keluarga,
                        'anak_ke' => $calon_siswa->anak_ke,
                        'alamat' => $calon_siswa->alamat,
                        'nomor_telepon' => $calon_siswa->nomor_telepon,
                        'sekolah_asal' => $calon_siswa->sekolah_asal,
                        'nama_ayah' => $calon_siswa->nama_ayah,
                        'pekerjaan_ayah' => $calon_siswa->pekerjaan_ayah,
                        'nama_ibu' => $calon_siswa->nama_ibu,
                        'pekerjaan_ibu' => $calon_siswa->pekerjaan_ibu,
                        'alamat_orang_tua' => $calon_siswa->alamat_orang_tua,
                        'nomor_telepon_orang_tua' => $calon_siswa->nomor_telepon_orang_tua,
                        'nama_wali' => $calon_siswa->nama_wali,
                        'alamat_wali' => $calon_siswa->alamat_wali,
                        'nomor_telepon_wali' => $calon_siswa->nomor_telepon_wali,
                        'surat_keterangan' => $calon_siswa->surat_keterangan,
                        'kartu_keluarga' => $calon_siswa->kartu_keluarga,
                        'akte_lahir' => $calon_siswa->akte_lahir,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    DB::table('calon_siswa')->where('user_id', $user_id)->delete();
                }

            }elseif ($user->is_verified == 0){
                DB::table('users')->where('id', $user_id)->update(['is_verified'=> 1]);
            }

        }else{
            DB::table('users')->where('id', $user_id)->update(['is_verified'=>-1]);
        }

        return redirect()->route('tatausaha.siswa.calon', ['pendaftaran_id'=>$pendaftaran_id]);

    }

    public function postEditPendaftaran(Request $request){
        $this->validate($request, [
            'pendaftaran_id' => ['required', 'exists:pendaftaran,id'],
            'judul' => ['required', 'string'],
            'tanggal_buka' => ['required', 'date'],
            'tanggal_tutup' => ['required', 'date'],
        ]);

        DB::table('pendaftaran')->where('id', $request->pendaftaran_id)->update([
            'judul' => $request->judul,
            'tanggal_buka' => $request->tanggal_buka,
            'tanggal_tutup' => $request->tanggal_tutup,
            'updated_at' => now(),
        ]);

        return redirect()->route('tatausaha.pendaftaran');
    }

    public function getDeletePendaftaran($pendaftaran_id){

        DB::table('pendaftaran')->where('id', $pendaftaran_id)->delete();
        return redirect()->route('tatausaha.pendaftaran');

    }

    public function calonSiswa($pendaftaran_id){

        $user = Auth::user();

        $pendaftaran = DB::table("pendaftaran")->where('id', $pendaftaran_id)->first();
        if(! $pendaftaran){
            return redirect()->route('tatausaha.pendaftaran');
        }

        $users = DB::table('users')->where('role', 0)->whereDate('created_at', '>=', $pendaftaran->tanggal_buka)->whereDate('created_at', '<', $pendaftaran->tanggal_tutup)->orderByDesc('created_at')->get();
        foreach ($users as $key => $u) {
            $users[$key]->data = DB::table('calon_siswa')->where('user_id', $u->id)->first();
        }

        $data = [
            'user' => $user,
            'users' => $users,
            'pendaftaran' => $pendaftaran,
        ];

        return view('app.tatausaha.calon', $data);
    }

    public function buatLaporan($pendaftaran_id){

        $user = Auth::user();

        $pendaftaran = DB::table("pendaftaran")->where('id', $pendaftaran_id)->first();
        if(! $pendaftaran){
            return redirect()->route('tatausaha.pendaftaran');
        }

        $users = DB::table('users')->where('is_verified', 1)->where('role', 0)->whereDate('created_at', '>=', $pendaftaran->tanggal_buka)->whereDate('created_at', '<', $pendaftaran->tanggal_tutup)->orderByDesc('created_at')->get();
        foreach ($users as $key => $u) {
            $users[$key]->dataDiri = DB::table('calon_siswa')->where('user_id', $u->id)->count();
        }

        $data = [
            'user' => $user,
            'users' => $users,
            'pendaftaran' => $pendaftaran,
        ];

        return view('app.tatausaha.laporan', $data);

    }

    public function getViewCalonSiswa($user_id, $pendaftaran_id){

        $pendaftaran = DB::table("pendaftaran")->where('id', $pendaftaran_id)->first();
        if(! $pendaftaran){
            return redirect()->route('tatausaha.pendaftaran');
        }

        $tUser = DB::table('users')->where('id', $user_id)->whereDate('created_at', '>=', $pendaftaran->tanggal_buka)->whereDate('created_at', '<', $pendaftaran->tanggal_tutup)->first();
        if(! $tUser){
            return redirect()->route('tatausaha.calon');
        }

        $tUser->data = DB::table('calon_siswa')->where('user_id', $tUser->id)->first();

        $user = Auth::user();

        $data = [
            'user' => $user,
            'tUser' => $tUser,
            'pendaftaran' => $pendaftaran,
        ];

        return view('app.tatausaha.calon.view', $data);

    }

    public function getEditCalonSiswa($user_id, $pendaftaran_id){

        $pendaftaran = DB::table("pendaftaran")->where('id', $pendaftaran_id)->first();
        if(! $pendaftaran){
            return redirect()->route('tatausaha.pendaftaran');
        }

        $tUser = DB::table('users')->where('id', $user_id)->whereDate('created_at', '>=', $pendaftaran->tanggal_buka)->whereDate('created_at', '<', $pendaftaran->tanggal_tutup)->first();
        if(! $tUser){
            return redirect()->route('tatausaha.calon');
        }

        $tUser->data = DB::table('calon_siswa')->where('user_id', $tUser->id)->first();

        $user = Auth::user();

        $data = [
            'user' => $user,
            'tUser' => $tUser,
            'pendaftaran' => $pendaftaran,
        ];

        return view('app.tatausaha.calon.edit', $data);

    }

    public function postEditCalonSiswa(Request $request){

        $this->validate($request, [
            'pendaftaran_id' => ['required'],
            'user_id' => ['required'],
            'nama' => ['required'],
            'tempat_lahir' => ['required'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required'],
            'agama' => ['required'],
            'status_dalam_keluarga' => ['required'],
            'anak_ke' => ['required'],
            'alamat' => ['required'],
        ]);

        $user = DB::table('users')->where('id', $request->user_id)->where('role', 0)->first();
        if(!$user){
            return back();
        }

        DB::table('users')->where('id', $request->id)->update([
            'name' => $request->nama,
        ]);

        $dataSiswa = DB::table('calon_siswa')->where('user_id', $request->user_id)->first();
        if($dataSiswa){
            DB::table('calon_siswa')->where('user_id', $request->user_id)->update([
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
                'user_id' => $user->id,
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

        return redirect()->route('tatausaha.siswa.calon', ['pendaftaran_id'=>$request->pendaftaran_id]);
    }



}
