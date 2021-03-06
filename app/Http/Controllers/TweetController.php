<?php

namespace App\Http\Controllers;

//Requestクラスを読み込んでいる
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

//ModelのTweet.phpを呼び出して保存する
use App\Models\Tweet;
use App\Services\CheckFormData;
use App\Http\Requests\StoreTweet;

class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search=$request->input('search');
        //以下の場合はDBの値を全て取得できる(エロくアント ORマッパー)
        // $tweet=Tweet::all();
        //クエリビルダ
        // $tweets = DB::table('tweets')
        // ->select('id','name','title','created_at')
        // ->orderBy('id', 'asc')
        // ->paginate(20);
        
        //検索フォーム用
       $query = DB::table('tweets') ;

       //もしキーワードがあったら
       if($search !==null){
           //全角スペースを半角に
           $search_split = mb_convert_kana($search,'s');

           //空白で区切る
           $search_split2 = preg_split('/[\s]+/',$search_split,-1,PREG_SPLIT_NO_EMPTY);

           //単語をループで回す
           foreach($search_split2 as $value){
               $query->where('name','like','%'.$value.'%');
           }
       };

       $query->select('id','name','title','created_at');
       $query->orderBy('id', 'asc');
       $tweets=$query->paginate(20);
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

   
    public function store(StoreTweet $request)
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

        $gender=CheckFormData::checkGender($tweet);
        $age=CheckFormData::checkAge($tweet);
        

        

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
