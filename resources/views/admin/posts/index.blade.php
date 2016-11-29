@extends('layouts.admin')


@section('content')

    <h1>Posts</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Photo</th>
                <th>Owner</th>
                <th>Category</th>
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
                        <th><img height="40" src="{{$post->photo ? $post->photo->file : 'http://placehold.it/400x400'}}" alt=""></th>
                        <th>{{$post->user->name}}</th>
                        <th>{{$post->category ? $post->category->name : 'Uncategorized'}}</th>
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