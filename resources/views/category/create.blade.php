@extends('template.master')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-8">
            <h2>新增分類</h2>
            <form action="{{route('category.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="">標題</label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">slug</label>
                    <input type="text" name="slug" class="form-control">
                </div>
                <input type="submit" value="新增分類" class="btn btn-primary">
            </form>
        </div>
        <div class="col-4">
            <h2>分類列表</h2>
            <ul class="list-group mt-4">
                @foreach($categories as $cate)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{$cate->title}}
                    <form action="{{route('category.destroy',['category'=>$cate->id])}}" method="post">
                        @csrf
                        @method('delete')
                        <input type="submit" value="刪除" onclick="return confirm('確認刪除？')" class="btn btn-danger">
                    </form>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection