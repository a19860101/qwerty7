@extends('template.master')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-10 mx-auto">
            <h2>編輯文章</h2>
            <form action="{{route('posts.update',['post'=>$post->id])}}" method="post">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="title">文章標題</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{$post->title}}">
                </div>
                <div class="form-group">
                    <label for="category_id">文章分類</label>
                    <select name="category_id" id="category_id" class="form-control">
                        @foreach($categories as $cate)
                        <option value="{{$cate->id}}"
                            {{$post->category_id == $cate->id ? "selected" : ""}}
                        >{{$cate->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="content">內文</label>
                    <textarea name="content" id="content" cols="30" rows="10" class="form-control">{{$post->content}}</textarea>
                </div>
                <input type="submit" class="btn btn-primary" value="儲存文章">
                <input type="button" class="btn btn-danger" value="取消" onclick="history.back()">
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.ckeditor.com/4.15.1/full/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content');
</script>
@endsection