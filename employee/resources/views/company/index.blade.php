@extends('app')
@section('title','Company')
@section('content')


@if(Session::has('message'))
<script>
    swal("Great Job","{!!session::get('message')!!}","success",{
        button:"Done",
    })
</script>
@endif

<div class="container" style="font-size:12px">
<div class="card">
    <h4 class="p-3">Company List</h4>
<div class="card-body bg-white mt-1">
<div class="d-flex justify-content-end" ><a style="font-size:10px" class="btn btn-success btn-sm " href="createcompany">Add New company</a></div>
<table class="table mt-1" id="dataTable">
    <thead>
        <tr style="font-size:10px">
            <th data-toggle="tooltip" data-placement="top" title="click to sort">Company ID</th>
            <th>Logo</th>
            <th data-toggle="tooltip" data-placement="top" title="click to sort">Name</th>
            <th data-toggle="tooltip" data-placement="top" title="click to sort">Email</th>
            <th data-toggle="tooltip" data-placement="top" title="click to sort">Website</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody style="color:black; font-size:12px">
    </tbody>
</table>
</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script>
    $(document).ready(function(){
        var table = $('#dataTable').DataTable({
            ajax:"{{url('ajaxcompany')}}",
            pageLength : 10,
            lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']],
            "order": [[ 3, "desc" ]],
            columns:[
                
                {"data":"id"},
                {"data":"image",
            render: function(data, type, row) {
              return `<img src='upload/${row.image}' class='rounded-circle' style='width:50px;height:50px'>`;
            }
          },
          {"data":"name"},
          {"data":"email"},
          {"data":"website",
            render: function(data, type, row) {
              return `<a href="#">${row.website}</a>`;
            }
          },
          { 
              "data": null,
              render: function(data, type, row) {
              return `<a  class="btn btn-sm text-info" href="editcompany/${row.id}" id="edit"><i class="fas fa-pencil-alt"></i></a>&nbsp;<button data-id="${row.id}" class="btn btn-sm text-danger" id="delete"><i class="fas fa-times"></i></button>`;
              }
          },

            ]
        });
        $(document).on('click', '#delete', function() {
  if(confirm('Are you sure you want delete?')){
      $.ajax({
          url: "{{ url('deletecompany') }}",
          type: "post",
          dataType: 'json',
          data: {
              "_token": "{{ csrf_token() }}",
              "id": $(this).data('id')
          },
          success: function(response) {
              table.ajax.reload();
          swal("Deleted","{!!session::get('User_deleted')!!}","success",{
          button:"Done",
    })

          }
      })
  }
})
    })
</script>
@endsection