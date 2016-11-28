@extends('layouts.admin')


@section('content')

    <h1>Posts</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>User</th>
                <th>Category</th>
                <th>Photo</th>
                <th>Title</th>
                <th>Body</th>
                <th>Created</th>
                <th>Updated</th>
            </tr>
        </thead>
        <tbody>
            @if($posts)
                @foreach($posts as $post)
                    <tr>
                        <th>{{$post->id}}</th>
                        <th>{{$post->user_id}}</th>
                        <th>{{$post->category_id}}</th>
                        <th>{{$post->photo_id}}</th>
                        <th>{{$post->title}}</th>
                        <th>{{$post->body}}</th>
                        <th>{{$post->created_at->diffForHumans()}}</th>
                        <th>{{$post->updated_at->diffForHumans()}}</th>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

@stop