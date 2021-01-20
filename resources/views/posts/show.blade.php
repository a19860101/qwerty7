@extends('template.master')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-10">
            <h3>{{$post->title}}</h3>
            <div>
                分類: <span class="badge badge-secondary">
                   {{$post->category->title}}
                </span>
            </div>
            <div class="content">
                {!! $post->content !!}
            </div>
            <div>最後更新時間 {{$post->updated_at}}</div>
            <hr>
            <a href="#" class="btn btn-outline-info" onclick="history.back()">回上頁</a>
            <form action="{{route('posts.destroy',['post'=>$post->id])}}" method="post" class="d-inline-block">
                @csrf
                @method('delete')
                <input type="submit" class="btn btn-outline-danger" value="刪除" onclick="return confirm('確認刪除？')">
            </form>
            <a href="{{route('posts.edit',['post' => $post->id])}}" class="btn btn-outline-success">編輯</a>
        </div>
    </div>
</div>
@endsection
