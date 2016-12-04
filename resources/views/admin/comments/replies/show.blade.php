@extends('layouts.admin')



@section('content')

    @if($replies)

        <h1>Replies</h1>

        <table class="table">
            <thead>
            <tr>
                <th class="text-center">ID</th>
                <th class="text-center">Photo</th>
                <th class="text-center">Author</th>
                <th class="text-center">Email</th>
                <th class="text-center">Body</th>
                <th class="text-center">Post link</th>
                <th class="text-center">Status</th>
                <th class="text-center">Delete</th>
            </tr>
            </thead>

            <tbody>
            @foreach($replies as $reply)
                <tr>
                    <td class="text-center">{{$reply->id}}</td>
                    <td class="text-center"><img height="40" src="{{$reply->comment->post->photo ? $reply->comment->post->photo->file : 'http://placehold.it/400x400'}}" alt=""></td>
                    <td class="text-center">{{$reply->author}}</td>
                    <td class="text-center">{{$reply->email}}</td>
                    <td class="text-center">{{$reply->body}}</td>
                    <td class="text-center"><a href="{{route('home.post', $reply->comment->post->id)}}">View post</a></td>

                    <td class="text-center">

                        @if($reply->is_active == 1)

                            {!! Form::open(['method'=>'PATCH', 'action'=> ['CommentRepliesController@update', $reply->id]]) !!}
                            <input type="hidden" name="is_active" value="0">

                            <div class="form-group">
                                {!! Form::submit('Un-approve', ['class'=>'btn btn-success']) !!}
                            </div>
                            {!! Form::close() !!}

                        @else

                            {!! Form::open(['method'=>'PATCH', 'action'=> ['CommentRepliesController@update', $reply->id]]) !!}
                            <input type="hidden" name="is_active" value="1">

                            <div class="form-group">
                                {!! Form::submit('Approve', ['class'=>'btn btn-info']) !!}
                            </div>
                            {!! Form::close() !!}

                        @endif
                    </td>
                    <td class="text-center">
                        {!! Form::open(['method'=>'DELETE', 'action'=> ['CommentRepliesController@destroy', $reply->id]]) !!}
                        <div class="form-group">
                            {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>

    @else
        <h1 class="text-center">No Replies</h1>
    @endif


@stop