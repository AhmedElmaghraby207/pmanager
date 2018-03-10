@extends('layouts.app')


@section('content')

    @if(Session::has('updated_company'))
        <p class="bg-info text-center">{{session('updated_company')}}</p>
    @endif


    <div class="container">

      <!-- Jumbotron -->
        <div class="col-sm-10 pull-left">
            <div class="jumbotron">
                <h1>{{$company->name}}</h1>
                <p class="lead">{{$company->description}}</p>
                {{--  <p><a class="btn btn-lg btn-success" href="#" role="button">Get started today</a></p>  --}}
            </div>

            <!-- Example row of columns -->
            <div class="row">
                <a class="btn btn-success btn-block" href="{{route('projects.create')}}">Add new project</a>
            </div>
            <div class="row" style="background: white; margin: 10px">
                @if($company->projects)
                    @foreach($company->projects as $project)
                        <div class="col-lg-4">
                            <h2>{{$project->name}}</h2>
                            <p class="text-danger">{{$project->description}}</p>
                            <p><a class="btn btn-primary" href="{{route('projects.show', $project->id)}}" role="button">View Project &raquo;</a></p>
                        </div>
                    @endforeach
                @endif
            </div>
            {{--  ===================================================================================  --}}
            <br>
            <hr>
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <!-- Fluid width widget -->        
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="fas fa-comment-alt"></i> Recent Comments
                            </h3>
                        </div>
                        <div class="panel-body">
                        @if($company->comments)
                            @foreach($company->comments as $comment)
                            <ul class="media-list">
                                <li class="media">
                                    <div class="media-left">
                                        <img src="http://placehold.it/60x60" class="img-circle">
                                    </div>
                                    <div class="media-body">
                                            <h3>{{$comment->user->name}}</h3>
                                            <small class="text-danger">
                                                commented on {{$comment->created_at->diffForHumans()}}</a>
                                            </small>
                                        <h4>{{$comment->body}}</h4>
                                        <p>URL: {{$comment->url}}</p>
                                    </div>
                                </li>
                            </ul>
                            @endforeach
                        @endif
                        </div>
                    </div>
                    <!-- End fluid width widget --> 
                </div>
            </div>

        {{--  ============================================================================  --}}
            <div class="row container-fluid" style="background: white; margin: 10px">
                <form method="POST" action="{{route('comments.store')}}">
                    {{ csrf_field() }}

                    <input type="hidden" name="commentable_type" value="App\Company">
                    <input type="hidden" name="commentable_id" value="{{$company->id}}">

                    <div class="form-group">
                        <label for="comment-content">Comment</label>
                        <textarea placeholder="Enter your comment"
                                id="comment-content"
                                rows="3" spellcheck="false"
                                name="body"
                                class="form-control">
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="comment-name">Proof of work done (url/photos)</label>
                        <textarea placeholder="Enter url or screenshots"
                                id="comment-content"
                                rows="2" spellcheck="false"
                                name="url"
                                class="form-control">
                        </textarea>
                    </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Add Comment"/>
                        </div>
                    </form>
            </div>
            {{--  ===================================================================================  --}}
        </div>
        <div class="col-sm-2 pull-right blog-sidebar" style="background: white">
                <div class="sidebar-module">
                    <div class="sidebar-module">
                        <h3>Actions</h3>
                        <ol class="list-unstyled">
                            <li><a href="{{route('companies.index')}}">Companies List</a></li>  
                            <li><a href="{{route('companies.create')}}">Create new company</a></li>                          
                            <li><a href="{{route('projects.create')}}">Add new project</a></li>
                            <hr>
                            <h4>Company Options</h4>
                            <li><a class="text-warning" href="{{route('companies.edit', $company->id)}}"><i class="fas fa-edit"></i> Edit</a></li>
                            <li>
                                <a href="#" class="text-danger bold"
                                    onclick="
                                        var result = confirm('Are you sure you want to delete this company?');
                                            if(result)
                                            {
                                                event.preventDefault();
                                                document.getElementById('delete-form').submit();
                                            }
                                            "
                                            >
                                            <i class="fas fa-trash-alt"></i>
                                        Delete
                                </a>
                                <form id="delete-form" action="{{route('companies.destroy', $company->id)}}" method="POST" style="display: none">
                                    <input type="hidden" name="_method" value="delete">
                                    {{csrf_field()}}
                                </form>
                            </li>
                        </ol>
                    </div>
                    {{--  <hr>
                    <h4>Members</h4>
                    <ol class="list-unstyled">
                        @if($company)
                            @foreach($company->user as $user)
                                <li><a href="#">{{$user->id}}</a></li>
                            @endforeach
                        @endif
                    </ol>  --}}
                </div>
            </div>

    </div> <!-- /container -->

    <!-- Site footer -->
    <footer class="footer">
        <p class="text-center">&copy; {{date("Y")}} Pmanager, Inc.</p>
    </footer>


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
@endsection