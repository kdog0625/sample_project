<?php

namespace App\Http\Controllers;

//Requestクラスを読み込んでいる
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

//ModelのTweet.phpを呼び出して保存する
use App\Models\Tweet;

class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //以下の場合はDBの値を全て取得できる(エロくアント ORマッパー)
        // $tweet=Tweet::all();
        //クエリビルダ
        $tweets = DB::table('tweets')
        ->select('id','name','title','created_at')
        ->orderBy('created_at', 'asc')
        ->get();
        return view('tweets.index',compact('tweets'));
        // return view('tweets.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tweets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //Requestクラス(Requestはインスタンス化したもの)を使ってデータを持ってくる事ができる。
    public function store(Request $request)
    {
        //Tweetのインスタンス化作成(これによりTweetを読み込ませる)
        $tweet=new Tweet;
        //インスタンス化したものを矢印で代入する
        $tweet->name=$request->input('name');
        $tweet->title=$request->input('title');
        $tweet->email=$request->input('email');
        $tweet->url=$request->input('url');
        $tweet->gender=$request->input('gender');
        $tweet->age=$request->input('age');
        $tweet->contact=$request->input('contact');

        //保存はsaveというメソッド関数を使う
        $tweet->save();
        //保存した後に強制的に最初の画面に戻す
        return redirect('tweet/index ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $tweet=Tweet::find($id);

        if($tweet->gender===0){
            $gender='男性';
        }
        if($tweet->gender===1){
            $gender='女性';
        }

        if($tweet->age===1){
            $age='~19歳';
        }
        if($tweet->age===2){
            $age='20歳~29歳';
        }
        if($tweet->age===3){
            $age='30歳~39歳';
        }
        if($tweet->age===4){
            $age='40歳~49歳';
        }
        if($tweet->age===5){
            $age='50歳~59歳';
        }
        if($tweet->age===6){
            $age='60歳~';
        }

        return view('tweets.show',
        compact('tweet','gender','age'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $tweet=Tweet::find($id);
        return view('tweets.edit',
        compact('tweet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $tweet=Tweet::find($id);
        //インスタンス化したものを矢印で代入する
        $tweet->name=$request->input('name');
        $tweet->title=$request->input('title');
        $tweet->email=$request->input('email');
        $tweet->url=$request->input('url');
        $tweet->gender=$request->input('gender');
        $tweet->age=$request->input('age');
        $tweet->contact=$request->input('contact');

        //保存はsaveというメソッド関数を使う
        $tweet->save();
        //保存した後に強制的に最初の画面に戻す
        return redirect('tweet/index ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $tweet=Tweet::find($id);
        $tweet->delete();
        return redirect('tweet/index');
    }
}
