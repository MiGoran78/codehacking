@extends('layouts.admin')


@section('content')

    @if(Session::has('deleted_user'))
        <p class="bg-danger">{{ session('deleted_user') }}</p>
    @endif

    <h1>Posts</h1>

    <table class="table">
        <thead>
            <tr>
                <th class="text-center">ID</th>
                <th class="text-center">Photo</th>
                <th class="text-center">Owner</th>
                <th class="text-center">Category</th>
                <th class="text-center">Title</th>
                <th class="text-center">Body</th>
                <th class="text-center">Post link</th>
                <th class="text-center">Comment link</th>
                <th class="text-center">Un/approved</th>
                <th class="text-center">Created</th>
                <th class="text-center">Updated</th>
            </tr>
        </thead>

        <tbody>
            @if($posts)
                @foreach($posts as $post)

                    <tr>
                        <td class="text-center">{{$post->id}}</td>
                        <td class="text-center"><img height="40" src="{{$post->photo ? $post->photo->file : 'http://placehold.it/400x400'}}" alt=""></td>
                        <td class="text-center"><a href="{{route('admin.posts.edit', $post->id)}}">{{$post->user->name}}</a></td>
                        <td class="text-center">{{$post->category ? $post->category->name : 'Uncategorized'}}</td>
                        <td class="text-center">{{$post->title}}</td>
                        <td class="text-center">{{str_limit($post->body, 16)}}</td>
                        <td class="text-center"><a href="{{route('home.post', $post->id)}}">View Post</a></td>
                        <td class="text-center"><a href="{{route('admin.comments.show', $post->id)}}">View Comments</a></td>
                        <td class="text-center">
                            {{count($post->comments()->whereIsActive(1)->get())}}  /
                            {{count($post->comments)}}
                        </td>
                        <td class="text-center">{{$post->created_at->diffForHumans()}}</td>
                        <td class="text-center">{{$post->updated_at->diffForHumans()}}</td>
                    </tr>

                @endforeach
            @endif
        </tbody>
    </table>

@stop