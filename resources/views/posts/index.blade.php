@extends('template.master')
@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-10">
            <h2>文章列表</h2>
            <hr>
        </div>
        @foreach($posts as $post)
        <div class="col-xl-8 col-10">
            <h3>{{$post->title}}</h3>
            <div>
                @foreach($post->tags as $tag)
                    <a href="{{route('posts.tag',['tag'=>$tag->id])}}" class="badge badge-info">{{$tag->title}}</a>
                @endforeach
            </div>
            <div>
                <img src="{{asset('storage/images/'.$post->cover)}}" alt="" class="w-100">
            </div>
            <div>
                作者: {{$post->user->name}}
            </div>
            <div>
                分類: <span class="badge badge-secondary">
                   {{$post->category->title}}
                </span>
            </div>
            <div class="content">
                
                {!! Str::limit(strip_tags($post->content),200) !!}
            </div>
            <a href="{{route('posts.show',['post'=>$post->id])}}" class="btn btn-primary">繼續閱讀</a>
           
            <div>最後更新時間 {{$post->updated_at}}</div>
            <div>
                @php Carbon\Carbon::setLocale('zh_TW') @endphp
                最後更新時間 {{ Carbon\Carbon::parse($post->updated_at)->diffForHumans() }}
                建立時間 {{ Carbon\Carbon::parse($post->created_at)->diffForHumans() }}
            </div>
        <hr>
        </div>
        @endforeach
    </div>
</div>
@endsection
