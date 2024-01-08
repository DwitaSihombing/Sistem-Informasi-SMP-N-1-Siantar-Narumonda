<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ManageController extends Controller
{
    public function blog(){

        $user = Auth::user();
        $blogs = DB::table('blog')->orderByDesc('created_at')->get();
        foreach ($blogs as $key => $b) {
            $blogs[$key]->user = DB::table('users')->where('id', $b->user_id)->first();
        }


        $data = [
            'user' => $user,
            'blogs' => $blogs,
        ];

        return view('app.manage.blog', $data);

    }

    public function getBlogAdd(){
        $user = Auth::user();

        $data = [
            'user' => $user,
        ];

        return view('app.manage.blog.add', $data);
    }

    public function postBlogAdd(Request $request){

        $this->validate($request, [
            'judul' => ['required', 'string'],
            'cover' => ['required', 'image'],
            'isi' => ['required', 'string'],
        ]);

        $user = Auth::user();


        if(! $request->cover){
            return redirect()->back();
        }

        $random_code = rand(11111, 99999);
        $file = $user->id ."_". $random_code . "_". strtotime(date("Y-m-d H:i:s")) .".". $request->cover->extension();

        $request->cover->move(public_path('img/blog'), $file);
        if(! file_exists("img/blog/".$file)){
            $v = Validator::make([], []);
            $v->getMessageBag()->add('cover', 'Gagal mengupload cover, silahkan mencoba kembali!');
            return back()->withErrors($v)->withInput();
        }

        $lampiran = null;
        if($request->lampiran){
            $random_code = rand(11111, 99999);
            $lampiran = $user->id ."_". $random_code . "_". strtotime(date("Y-m-d H:i:s")) .".". $request->lampiran->extension();

            $request->lampiran->move(public_path('img/lampiran'), $lampiran);
            if(file_exists("img/lampiran/".$lampiran)){
                $lampiran = "img/lampiran/".$lampiran;
            }
        }



        DB::table('blog')->insert([
            'judul' => $request->judul,
            'cover' => "img/blog/".$file,
            'isi' => $request->isi,
            'user_id' => $user->id,
            'lampiran' => $lampiran,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('manage.blog');
    }

    public function getBlogEdit($blog_id){
        $user = Auth::user();
        $blog = DB::table('blog')->where('id', $blog_id)->first();
        if(!$blog){
            return redirect()->route('manage.blog');
        }

        $data = [
            'user' => $user,
            'blog' => $blog,
        ];

        return view('app.manage.blog.edit', $data);
    }

    public function postBlogEdit(Request $request){

        $this->validate($request, [
            'id' => ['required', 'exists:blog,id'],
            'judul' => ['required', 'string'],
            'cover' => ['nullable', 'image'],
            'isi' => ['required', 'string'],
        ]);

        $user = Auth::user();

        $blog = DB::table('blog')->where('id', $request->id)->first();

        $lampiran = null;
        if($request->lampiran){
            $random_code = rand(11111, 99999);
            $lampiran = $user->id ."_". $random_code . "_". strtotime(date("Y-m-d H:i:s")) .".". $request->lampiran->extension();
            $request->lampiran->move(public_path('img/lampiran'), $lampiran);
            if(file_exists("img/lampiran/".$lampiran)){
                $lampiran = "img/lampiran/".$lampiran;
                if(File::exists($blog->lampiran)){
                    unlink($blog->lampiran);
                }
            }
        }



        if($request->cover){
            $random_code = rand(11111, 99999);
            $file = $user->id ."_". $random_code . "_". strtotime(date("Y-m-d H:i:s")) .".". $request->cover->extension();

            $request->cover->move(public_path('img/blog'), $file);
            if(! file_exists("img/blog/".$file)){
                $v = Validator::make([], []);
                $v->getMessageBag()->add('cover', 'Gagal mengupload cover, silahkan mencoba kembali!');
                return back()->withErrors($v)->withInput();
            }

            if(File::exists($blog->cover)){
                unlink($blog->cover);
            }

            DB::table('blog')->where('id', $request->id)->update([
                'judul' => $request->judul,
                'cover' => "img/blog/".$file,
                'isi' => $request->isi,
                'user_id' => $user->id,
                'lampiran' => $lampiran,
                'updated_at' => now(),
            ]);
        }
        else{

            DB::table('blog')->where('id', $request->id)->update([
                'judul' => $request->judul,
                'isi' => $request->isi,
                'user_id' => $user->id,
                'lampiran' => $lampiran,
                'updated_at' => now(),
            ]);

        }


        return redirect()->route('manage.blog');
    }

    public function getBlogDelete($blog_id){
        $blog = DB::table('blog')->where('id', $blog_id)->first();
        if(File::exists($blog->cover)){
            unlink($blog->cover);
        }

        $blog = DB::table('blog')->where('id', $blog_id)->delete();
        return redirect()->route('manage.blog');
    }

}
