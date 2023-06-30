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
                    <a href="{{ route('admin-member-form') }}" class="btn btn-primary">
                        Create New Member
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered data-table" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                                <th>Name</th>
                                <th>Username</th>
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
                ajax: "{{ route('admin-member-index') }}",
                columns: [
                      {data: 'name', name: 'name'},
                      {data: 'username', name: 'username'},
                    {
                        data: 'photo',
                        name: "photo",
                        render: function(data, type, full, meta) {
                            return '<img src="{{ asset('storage/member/') }}/' + data +
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


            $('body').on('click', '.deleteMember', function (){
            var member = $(this).data("id");
            var result = confirm("Are You sure want to delete member!");
            if(result){
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: "DELETE",
                    url: 'delete-member/'+ member,
                    data: {'member': member, '_method': 'DELETE'}, 

                    success: function (data) {
                        table.draw();
                        alert(data.success);
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        alert(data.error);

                    }
                });
            }else{
                return false;
            }
        });

        });
    </script>

@endsection
