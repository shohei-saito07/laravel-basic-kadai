<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\posts;

class PostController extends Controller
{
    public function index() {
        // postsテーブルからすべてのデータを取得し、変数$postsに代入する
        $posts = DB::table('posts')->get();

        // 変数$postsをposts/index.blade.phpファイルに渡す
        return view('/posts/index', compact('posts'));
    }

    public function show($id) {

        $post = posts::find($id);

        return view('posts.show', compact('post'));
    }

    public function create() {
        return view('posts.create');
    } 

    public function store(Request $request) {

        // バリデーションを設定する
        $request->validate([
            'title' => 'required|max:20',
            'content' => 'required|max:200'
        ]);

        // フォームの入力内容をもとに、テーブルにデータを追加する
        $posts = new posts();
        $posts->title = $request->input('title');
        $posts->content = $request->input('content');
        $posts->save();

        // リダイレクトさせる
        return redirect("/posts");
    }  
}
