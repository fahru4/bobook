@extends('layouts.administrator')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin-book-store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="title" class="control-label">Title</label>
                        <input id="title" type="text" class="form-control" name="title" placeholder="Enter Title" required>

                        @if ($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('puby_year') ? ' has-error' : '' }}">
                        <label for="date" class="control-label">Publish Year</label>
                        <input id="pub_year" type="date" class="form-control" name="pub_year" required>

                        @if ($errors->has('puby_year'))
                            <span class="help-block">
                                <strong>{{ $errors->first('puby_year') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('author') ? ' has-error' : '' }}">
                        <label for="author" class="control-label">Author Name</label>
                        <input id="author" type="text" class="form-control" name="author" placeholder="Enter author name" required>

                        @if ($errors->has('author'))
                            <span class="help-block">
                                <strong>{{ $errors->first('author') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('stock') ? ' has-error' : '' }}">
                        <label for="stock" class="control-label">Stock</label>
                        <input id="stock" type="number" class="form-control" name="stock" placeholder="Enter stock" required>

                        @if ($errors->has('stock'))
                            <span class="help-block">
                                <strong>{{ $errors->first('stock') }}</strong>
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
