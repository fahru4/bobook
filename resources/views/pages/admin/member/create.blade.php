@extends('layouts.administrator')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">New Member</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin-member-store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="control-label">Name</label>
                        <input id="name" type="text" class="form-control" name="name" placeholder="Enter Full Name" required>

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>


                    <div class="form-group{{ $errors->has('author') ? ' has-error' : '' }}">
                        <label for="username" class="control-label">Username</label>
                        <input id="username" type="text" class="form-control" name="username" placeholder="Enter username" required>

                        @if ($errors->has('username'))
                            <span class="help-block">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="control-label">Password</label>
                        <input id="password" type="password" class="form-control" name="password" placeholder="Enter Password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                
                    <div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">
                        <label for="photo" class="control-label">Photo</label>
                        <input id="photo" type="file" class="form-control" name="photo" placeholder="Enter photo" required>

                        @if ($errors->has('photo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('photo') }}</strong>
                            </span>
                        @endif
                    </div>

                    <input type="hidden" name="action" value="create">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-danger">
                        Reset
                    </button>
                    <a href="#" class="btn btn-warning pull-right">Back</a>

                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

@endsection
