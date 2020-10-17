@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    editです
                    <form method="POST" action="{{ route('tweets.update',['id'=>$tweet->id ]) }}">
                    @csrf

                    氏名
                    <input type="text" name="name" value="{{ $tweet->name }}">
                    <br>
                    件名
                    <input type="text" name="title" value="{{ $tweet->title }}">
                    <br>
                    メールアドレス
                    <input type="email" name="email" value="{{ $tweet->email }}">
                    <br>
                    ホームページ
                    <input type="url" name="url" value="{{ $tweet->url }}">
                    <br>
                    性別
                    <input type="radio" name="gender" value="0" @if($tweet->gender === 0) checked @endif >男性
                    <input type="radio" name="gender" value="1" @if($tweet->gender === 1) checked @endif >女性
                    <br>
                    年齢
                    <select name="age">
                    <option value="">選択してください</option>
                    <option value="1" @if($tweet->age === 1) selected @endif>~19歳</option>
                    <option value="2" @if($tweet->age === 2) selected @endif>20歳~29歳</option>
                    <option value="3" @if($tweet->age === 3) selected @endif>30歳~39歳</option>
                    <option value="4" @if($tweet->age === 4) selected @endif>40歳~49歳</option>
                    <option value="5" @if($tweet->age === 5) selected @endif>50歳~59歳</option>
                    <option value="6" @if($tweet->age === 6) selected @endif>60歳~</option>
                    </select>
                    <br>
                    お問い合わせ
                    <textarea name="contact" >{{ $tweet->contact }}</textarea>
                    <br>

                    <input type="checkbox" name="caution" value="1">注意事項に同意する
                    <br>
                    
                    <input class="btn btn-info" type="submit" value="更新する">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
