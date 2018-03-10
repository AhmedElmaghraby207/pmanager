@extends('layouts.app')


@section('content')

    <div class="container">

      <!-- Jumbotron -->
        <div class="col-sm-10 pull-left">
            <form method="POST" action="{{route('companies.update', $company->id)}}">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="put">
                <div class="form-group">
                    <label for="company-name">Name<span class="required">*</span></label>
                    <input type="text"
                           placeholder="Enter Company Name"
                           required
                           name="name"
                           spellcheck="false"
                           class="form-control"
                           value="{{$company->name}}"/>
                </div>
                <div class="form-group">
                        <label for="company-name">Description</label>
                        <textarea id="company-content"
                               rows="5" spellcheck="false"
                               name="description"
                               class="form-control">
                               {{$company->description}}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Save Edits"/>
                    </div>

            </form>
            
        </div>
        <div class="col-sm-2 pull-right blog-sidebar" style="background: white">
                <div class="sidebar-module">
                    <div class="sidebar-module">
                        <h4>Actions</h4>
                        <ol class="list-unstyled">
                            <li><a href="{{route('companies.show', $company->id)}}">Show the company</a></li>
                            <li><a href="{{route('companies.index')}}">Companies List</a></li>                            
                        </ol>
                    </div>
                    <h4>Members</h4>
                    <ol class="list-unstyled">
                        <li><a href="#">March 2014</a></li>
                    </ol>
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