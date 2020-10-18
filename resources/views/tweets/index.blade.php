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
                    <!-- <a href="{{ route('tweets.create')}}">新規登録</a> -->
                    <form method="GET" action="{{ route('tweets.create') }}">
                    <button type="submit" class="btn btn-primary">新規登録
                    </button>
                    </form>
                    <form method="GET" action="{{route('tweets.index')}}" class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" name="search" type="search" placeholder="検索" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">検索する</button>
                    </form>
                    <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">id</th>
                        <th scope="col">氏名</th>
                        <th scope="col">タイトル</th>
                        <th scope="col">登録日時</th>
                        <th scope="col">詳細</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($tweets as $tweet)
                        <tr>
                        <th>{{$tweet->id}}</th>
                        <td>{{$tweet->name}}</td>
                        <td>{{$tweet->title}}</td>
                        <td>{{$tweet->created_at}}</td>
                        <td><a href="{{ route('tweets.show',['id' => $tweet->id ]) }}">詳細を見る</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                    </table>
                    {{ $tweets->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
