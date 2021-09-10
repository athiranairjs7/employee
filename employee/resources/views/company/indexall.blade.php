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
<div class="card-body bg-white mt-1">
    <h4 class="mb-4">All Company List</h4>
<table class="table mt-3" id="dataTable">
    <thead>
        <tr style="font-size:10px">
            <th data-toggle="tooltip" data-placement="top" title="click to sort">Company ID</th>
            <th>Logo</th>
            <th data-toggle="tooltip" data-placement="top" title="click to sort">Name</th>
            <th data-toggle="tooltip" data-placement="top" title="click to sort">Email</th>
            <th data-toggle="tooltip" data-placement="top" title="click to sort">Website</th>
            <th>Status</th>
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
            ajax:"{{url('allajaxcompany')}}",
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
                if(row.is_deleted == 0) {
                    return `<p class="text-success">Active</p>`;
                } else { 
                    return `<button data-id="${row.id}" class="btn btn-sm btn-danger" id="active">Inactive</button>`;
                }
            }
         },
            ]
        });
//active
$(document).on('click', '#active', function() {
  if(confirm('Are you sure you want activate?')){
      $.ajax({
          url: "{{ url('active') }}",
          type: "post",
          dataType: 'json',
          data: {
              "_token": "{{ csrf_token() }}",
              "id": $(this).data('id')
          },
          success: function(response) {
              table.ajax.reload();
          swal("Activated","{!!session::get('active')!!}","success",{
          button:"Done",
    })

          }
      })
  }
})

    })
</script>
@endsection