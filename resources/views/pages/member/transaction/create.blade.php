@extends('layouts.administrator')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('member-transaction-store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group{{ $errors->has('date_loan') ? ' has-error' : '' }}">
                        <label for="date_loan" class="control-label">Tanggal Pinjam</label>
                        <input id="date_loan" type="date" class="form-control" name="date_loan"
                            value="{{ date('Y-m-d', strtotime(Carbon\Carbon::today()->toDateString())) }}" required
                            @if (Auth::guard('member')) readonly @endif>

                        @if ($errors->has('date_loan'))
                            <span class="help-block">
                                <strong>{{ $errors->first('date_loan') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('date_return') ? ' has-error' : '' }}">
                        <label for="date_return" class="control-label">Tanggal Kembali</label>
                        <input id="date_return" type="date" class="form-control" name="date_return"
                            value="{{ date('Y-m-d',strtotime(Carbon\Carbon::today()->addDays(5)->toDateString())) }}"
                            required="" @if (Auth::guard('member')) readonly @endif>
                        @if ($errors->has('date_return'))
                            <span class="help-block">
                                <strong>{{ $errors->first('date_return') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('book_id') ? ' has-error' : '' }}">
                        <label for="book_id" class="control-label">Buku</label>
                            <div class="row">
                                <div class="col">
                                    <input id="title" type="text" class="form-control" readonly="" required>
                                    <input id="book_id" type="hidden" name="book_id" value="{{ old('book_id') }}"
                                        required readonly="">
                                </div>
                                <div class="col-lg-auto">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-info btn-secondary" data-toggle="modal"
                                            data-target="#myModal"><b>Cari Buku</b> <span
                                                class="fa fa-search"></span></button>
                                    </span>

                                </div>
                            </div>

                        @if ($errors->has('book_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('book_id') }}</strong>
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

    <div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="background: #fff;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cari Buku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="lookup" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Year Published</th>
                                <th>Author</th>
                                <th>Photo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $data)
                                <tr class="pilih" data-buku_id="<?php echo $data->id; ?>" data-buku_judul="<?php echo $data->title; ?>">
                                    <td>{{ $data->title }}</td>
                                    <td>{{ $data->pub_year }}</td>
                                    <td>{{ $data->author }}</td>
                                    <td>...</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script type="text/javascript">
        $(document).on('click', '.pilih', function(e) {
            document.getElementById("title").value = $(this).attr('data-buku_judul');
            document.getElementById("book_id").value = $(this).attr('data-buku_id');
            $('#myModal').modal('hide');
        });



        $("#lookup").dataTable();
    </script>
@endsection
