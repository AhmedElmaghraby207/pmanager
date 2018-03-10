@extends('layouts.app')


@section('content')

    @if(Session::has('created_comment'))
        <p class="bg-success text-center">{{session('created_comment')}}</p>
    @endif

    @if(Session::has('user_added'))
        <p class="bg-success text-center">{{session('user_added')}}</p>
    @endif

    @if(Session::has('user_notAdded'))
        <p class="bg-success text-center">{{session('user_added')}}</p>
    @endif

    @if(Session::has('user_exists'))
        <p class="bg-success text-center">{{session('user_exists')}}</p>
    @endif


    <div class="container">

      <!-- Jumbotron -->
        <div class="col-sm-9 pull-left">
            <div class="well well-lg">
                <h1>{{$project->name}}</h1>
                <p class="lead">{{$project->description}}</p>
                {{--  <p><a class="btn btn-lg btn-success" href="#" role="button">Get started today</a></p>  --}}
            </div>

            <!-- Example row of columns -->
            
            <br>
            <hr>
            {{--  ============================================================================  --}}
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
                        @if($project->comments)
                            @foreach($project->comments as $comment)
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

                    <input type="hidden" name="commentable_type" value="App\Project">
                    <input type="hidden" name="commentable_id" value="{{$project->id}}">

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
        </div>
        <div class="col-sm-3 pull-right blog-sidebar" style="background: white">
                <div class="sidebar-module">
                    <div class="sidebar-module">
                        <h3>Navigations</h3>
                        <ol class="list-unstyled">
                            <li><a href="{{route('projects.index')}}">Projects List</a></li>  
                            <li><a href="{{route('projects.create')}}">Create new project</a></li>                          
                            <hr>
                            <h4>Project Options</h4>
                            <li><a class="text-warning" href="{{route('projects.edit', $project->id)}}"><i class="fas fa-edit"></i> Edit</a></li>
                            <li>
                                <a href="#" class="text-danger bold"
                                    onclick="
                                        var result = confirm('Are you sure you want to delete this project?');
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
                                <hr>
                                <h4>Add member for project</h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form id="add-user" action="{{route('projects.adduser')}}" method="POST">
                                                {{csrf_field()}}
                                            <div class="input-group">
                                                <input type="hidden" class="form-control" name="project_id" value="{{$project->id}}">
                                                <input type="text" class="form-control" name="email" placeholder="Email">
                                                <span class="input-group-btn">
                                                <button class="btn btn-success" type="submit">Add!</button>
                                                </span>
                                            </div><!-- /input-group -->
                                        </form>
                                    </div><!-- /.col-lg-6 -->
                                </div><!-- /.row -->
                                <br>
                                <h4>Project Members</h4>
                                <ol class="list-unstyled">
                                    @foreach($project->users as $users)
                                        <li><a href="#">{{$users->email}}</a></li>
                                    @endforeach
                                </ol>

                                <form id="delete-form" action="{{route('projects.destroy', $project->id)}}" method="POST" style="display: none">
                                    <input type="hidden" name="_method" value="delete">
                                    {{csrf_field()}}
                                </form>
                            </li>
                        </ol>
                    </div>
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