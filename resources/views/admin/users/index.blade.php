@extends('layouts.admin')

@section('content')

    @if(Session::has('action'))

        <p class="bg-danger">{{session('action')}}</p>

    @endif



   <h1>Users</h1>



   <table class="table">
       <thead>
       <tr>
           <th>Image</th>
           <th>ID</th>
           <th>Name</th>
           <th>Email</th>
           <th>Role</th>
           <th>Status</th>
           <th>Created</th>
           <th>Updated</th>

           <th>Action</th>
       </tr>
       </thead>
       <tbody>

       @if($users)
           @foreach($users as $user)
       <tr>
           <td><img height="50" src="{{ $user->photo? $user->photo->file: 'http://placehold.it/400x400' }}"></td>
           <td>{{$user->id}}</td>
           <td><a href="{{route('admin.users.edit', $user->id)}}"> {{$user->name}}</a></td>
           <td>{{$user->email}}</td>
           <td>{{$user->role->name}}</td>
           <td>{{$user->is_active == 0 ? 'not active' : 'active'}}</td>
           <td>{{$user->created_at->diffForHumans()}}</td>
           <td>{{$user->updated_at->diffForHumans()}}</td>

           <td>
               {{ Form::open(['method' => 'DELETE', 'action'=>['AdminUserController@destroy',$user->id], 'files'=>true]) }}

               <div class="form-group">

                    @if($auth->id == $user->id)

                        {{''}}

                   @else

                       {{ Form::submit('Delete', ['class'=>'btn btn-primary']) }}

                   @endif

               </div>


               {{ Form::close() }}
           </td>

       </tr>
            @endforeach
        @endif
       </tbody>
   </table>





@stop