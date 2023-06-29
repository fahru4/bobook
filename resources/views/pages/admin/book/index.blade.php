@extends('layouts.administrator')

@section('content')

<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col">
                    <h6 class="m-0 font-weight-bold text-primary">Master Book</h6>
                </div>
                <div class="col-lg-auto">
                    <a href="{{ route('admin-book-form') }}" class="btn btn-primary">
                        Create New Book
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered data-table" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Title</th>
                                <th>Year Published</th>
                                <th>Author</th>
                                <th>Stock</th>
                                <th>Photo</th>
                                <th>Action</th>
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
        $(function() {

            var table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin-book-index') }}",
                columns: [
                      {data: 'title', name: 'title'},
                      {data: 'pub_year', name: 'pub_year'},
                      {data: 'author', name: 'author'},
                      {data: 'stock', name: 'stock'},

                    {
                        data: 'photo',
                        name: "photo",
                        render: function(data, type, full, meta) {
                            return '<img src="{{ asset('storage/book/') }}/' + data +
                                '" width="150px" height="150px">';
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $('.modelClose').on('click', function(){
            $('#EditArticleModal').hide();
            });
            var id;
            $('body').on('click', '#getBook', function(e) {
                // e.preventDefault();
                $('.alert-danger').html('');
                $('.alert-danger').hide();
                id = $(this).data('id');
                $.ajax({
                   url: "book/edit/"+id+"",
                    method: 'GET',
                    dataType: 'html',
                    // data: {
                    //     id: id,
                    // },
                    success: function(result) {
                        console.log(result);
                        $('#EditArticleModalBody').html(result);
                        $('#EditArticleModal').show();
                    }
                });
            });


            $('body').on('click', '.deleteBook', function (){
            var book = $(this).data("id");
            var result = confirm("Are You sure want to delete !");
            if(result){
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: "DELETE",
                    url: 'delete-book/'+ book,
                    data: {'book': book, '_method': 'DELETE'}, 

                    success: function (data) {
                        table.draw();
                        alert(data.success);
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }else{
                return false;
            }
        });

        });
    </script>

@endsection
