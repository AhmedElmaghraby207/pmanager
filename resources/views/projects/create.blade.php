@extends('layouts.app')


@section('content')

    <div class="container">



      <!-- Jumbotron -->
        <div class="col-sm-10 pull-left">
            <form method="POST" action="{{route('projects.store')}}">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="project-name">Name<span class="required">*</span></label>
                    <input type="text"
                           placeholder="Enter Project Name"
                           required
                           name="name"
                           spellcheck="false"
                           class="form-control"
                    />
                </div>

                <div class="form-group">
                    <label for="project-days">Number of days</label>
                    <input class="form-control"
                            type="number"
                            name="days"
                    />
                </div>

                @if($companies == null)
                <div class="form-group">
                    <input class="form-control"
                            type="hidden"
                            name="company_id"
                            value="{{$company_id}}"
                    />
                </div>
                @endif

                @if($companies != null)
                <div>
                    <label for="project-name">Select Company</label>
                    <select name="company_id" class="form-control">
                        @foreach($companies as $company)
                            <option value="{{$company->id}}">{{$company->name}}</option>
                        @endforeach
                    </select>
                </div>
                @endif

                <div class="form-group">
                        <label for="project-name">Description</label>
                        <textarea id="project-content"
                               rows="5" spellcheck="false"
                               name="description"
                               class="form-control">
                        </textarea>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Create"/>
                    </div>

            </form>
        </div>



        <div class="col-sm-2 pull-right blog-sidebar" style="background: white">
            <div class="sidebar-module">
                <div class="sidebar-module">
                    <h4>Actions</h4>
                    <ol class="list-unstyled">
                        <li><a href="{{route('projects.index')}}">Projects List</a></li>                            
                    </ol>
                </div>
                {{--  <h4>Members</h4>
                <ol class="list-unstyled">
                    <li><a href="#">March 2014</a></li>
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