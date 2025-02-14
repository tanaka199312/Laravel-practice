<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Author;

use DB;
use Log;


class PostController extends Controller
{

    public function index()
    {
         $posts = [
            (object) [
                'id' => 1,
                'title' => '投稿タイトル1',
                'content' => '投稿内容1',
                'author_id' => 1,
                'author_name' => '著者名1',
            ],
            (object) [
                'id' => 2,
                'title' => '投稿タイトル2',
                'content' => '投稿内容2',
                'author_id' => 2,
                'author_name' => '著者名2',
            ],
        ];

        return view('index', compact('posts'));

    }

    public function store(Request $request){
        $post = new Post();
        $post->storePost($request);
    }

    public function showCreate()
    {
    $authors = [
        (object) ['id' => 1, 'author_name' => '著者名1'],
        (object) ['id' => 2, 'author_name' => '著者名2'],
        (object) ['id' => 3, 'author_name' => '著者名3'],
    ];

    return view('create', compact('authors'));
    }


    public function storePost(Request $request){
    $model = new Post();

    try{
        DB::beginTransaction();
        $model->storePost($request);
        DB::commit();
    } catch(\Exception $e){
        Log::error($e);
        DB::rollback();
        return redirect()->route('index');
    }

    return redirect()->route('index');
    }

    public function showEdit($id){
    $post = (object) [
        'id' => 1,
        'title' => '投稿タイトル1',
        'content' => '投稿内容1',
        'author_id' => 1,
    ];

    $authors = [
        (object) ['id' => 1, 'author_name' => '著者名1'],
        (object) ['id' => 2, 'author_name' => '著者名2'],
    ];

    return view('show', compact('post', 'authors'));
    }

    public function registEdit(Request $request, $id){
        $model = new Post();
        try{
            DB::beginTransaction();
            $model->updatePost($request, $id);
            DB::commit();
        } catch(\Exception $e){
            Log::error($e);
            DB::rollback();
            return redirect()->route('index');
        }
        return redirect()->route('index');
    }

    public function deletePost($id){
        $model = new Post();
        try{
            DB::beginTransaction();
            $model->deletePost($id);
            DB::commit();
        } catch(\Exception $e){
            Log::error($e);
            DB::rollback();
            return redirect()->route('index');
        }
        return redirect()->route('index');
    }
}
