@extends('layouts.admin')

@section('content')



    <h3>Posts</h3>


    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Poster</th>
            <th>Category</th>
            <th>Title</th>
            <th>Body</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>

        @if($posts)

            @foreach($posts as $post)
                <tr>

                    <td>{{$post->id}}</td>
                    <td>
                        <img height="50" src="{{$post->photo_id ? $post->photo->file : 'http://placehold.it/400x400'}}">
                    </td>
                    <td>{{$post->user->name}}</td>
                    <td>{{$post->category_id ? $post->category->name : 'uncategorized'}}</td>

                    <td>{{$post->title}}</td>
                    <td>{{$post->body}}</td>
                    <td>{{$post->created_at->diffForHumans()}}</td>
                    <td>{{$post->updated_at->diffForHumans()}}</td>

                    <td>
                        {{ Form::open(['method' => 'DELETE', 'action'=>['PostController@destroy',$post->id], 'files'=>true]) }}

                        <div class="form-group">

                                {{ Form::submit('Delete', ['class'=>'btn btn-primary']) }}

                        </div>


                        {{ Form::close() }}
                    </td>

                </tr>

            @endforeach

        @endif



        </tbody>
    </table>


@stop