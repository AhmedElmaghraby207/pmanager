@extends('layouts.app')


@section('content')

    @if(Session::has('created_project'))
        <p class="bg-success text-center">{{session('created_project')}}</p>
    @endif

    @if(Session::has('deleted_project'))
        <p class="bg-danger text-center">{{session('deleted_project')}}</p>
    @endif

    @if(Session::has('updated_project'))
        <p class="bg-info text-center">{{session('updated_project')}}</p>
    @endif

<div class="container col-sm-6 col-sm-offset-3">
    <div class="panel panel-primary">
    <div class="panel-heading">Projects Name <a class="pull-right btn btn-success btn-sm" href="{{route('projects.create')}}">Create new project</a></div>
        <div class="panel-body">
            @if($projects)
                @foreach($projects as $project)
                    <ul class="list-group">
                        <li class="list-group-item"><a href={{route('projects.show', $project->id)}}>{{$project->name}}</a></li>
                    </ul>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection