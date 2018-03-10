@extends('layouts.app')


@section('content')

    @if(Session::has('created_company'))
        <p class="bg-success text-center">{{session('created_company')}}</p>
    @endif

    @if(Session::has('deleted_company'))
        <p class="bg-danger text-center">{{session('deleted_company')}}</p>
    @endif

    @if(Session::has('updated_company'))
        <p class="bg-info text-center">{{session('updated_company')}}</p>
    @endif

<div class="container col-sm-6 col-sm-offset-3">
    <div class="panel panel-primary">
    <div class="panel-heading">Companies Name <a class="pull-right btn btn-success btn-sm" href="{{route('companies.create')}}">Create new company</a></div>
        <div class="panel-body">
            @if($companies)
                @foreach($companies as $company)
                    <ul class="list-group">
                        <li class="list-group-item"><a href={{route('companies.show', $company->id)}}>{{$company->name}}</a></li>
                    </ul>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection