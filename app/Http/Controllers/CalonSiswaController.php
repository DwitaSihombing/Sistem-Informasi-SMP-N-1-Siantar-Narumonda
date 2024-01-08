<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalonSiswaController extends Controller
{
    public function informasi(){

        $user = Auth::user();
        $data = [
            'user' => $user,
        ];


        return view('app.calon.siswa', $data);
    }
}
