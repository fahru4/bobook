@extends('layouts.administrator')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col">
                        <h6 class="m-0 font-weight-bold text-primary">Transaction Borrowing</h6>
                    </div>
                    <div class="col-lg-auto">
                        <a href="{{ route('member-transaction-form') }}" class="btn btn-primary">
                            New booked book
                        </a>

                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                        <table class="table table-bordered data-table" id="empTable">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Year Published</th>
                                <th>Author</th>
                                <th>Approve</th>
                                <th>Photo</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script type="text/javascript">
        $(document).ready( function ()  {

            var table = $('#empTable').dataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('member-transaction') }}",

                columns: [
                            {data: 'title', name: 'title'},
                            {data: 'author', name: 'author'},
                            {data: 'author', name: 'author'},
                            {
                                data: 'span',
                                name: 'span',
                                orderable: false,
                                searchable: false
                            },
                            {
                                data: 'action',
                                name: 'action',
                                orderable: false,
                                searchable: false
                            },
                ]
                
            });

        });
    </script>
@endsection
