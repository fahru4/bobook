@extends('layouts.administrator')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

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
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                        <table class="table table-bordered data-table" id="transTable">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Published</th>
                                <th>Author</th>
                                <th>Approve</th>
                                <th>Photo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $book)
                            <tr>
                               <td>{{ $book->title }}</td>
                               <td>{{ $book->pub_year }}</td>
                               <td>{{ $book->author }}</td>
                               <td> 
                                  <input data-id="{{$book->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" 
                                  data-toggle="toggle" data-on="IsApprove" data-off="NoApprovee" {{ $book->approve ? 'checked' : '' }}> 
                               </td>
                               <td>
                                    <img src="{{ asset('storage/book/'.$book->photo) }}" style="height: 50px;width:100px; margin-top:5px;">
                                </td>
                            </tr>
                         </tbody>
                         @endforeach
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {

        $('.toggle-class').change(function() { 
           var approve = $(this).prop('checked') == true ? 1 : 0;  
           var transaction_id = $(this).data('id');  
           var stock = $(this).data('stock');
           let status = 0;  
           $.ajax({ 
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST", 
                dataType: "json",
                url: 'transaction/status/'+ transaction_id,
                data: {'approve': approve, 'transaction_id': transaction_id, 'stock':stock}, 
                success: function(data){ 
                    
                    console.log(data) 
            } 
         }); 
        }) 

        // $('#transTable').DataTable({
        //         pageLength: 5,
        //         processing: true,
        //         serverSide: true,
        //         ajax: "{{ route('admin-transaction-index') }}",

        //         columns: [
        //                     {data: 'title', name: 'title'},
        //                     {data: 'author', name: 'author'},
        //                     {data: 'author', name: 'author'},
        //                     {
        //                         data: 'span',
        //                         name: 'span',
        //                         orderable: false,
        //                         searchable: false
        //                     },
        //                     {
        //                         data: 'action',
        //                         name: 'action',
        //                         orderable: false,
        //                         searchable: false
        //                     },
        //         ]
        //     });

        });
    </script>
@endsection
