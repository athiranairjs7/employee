@extends('app')
@section('title','Employee')
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
    <h4 class="p-3">Employee Details</h4>

<div class="card-body bg-white mt-1">   
<div class="d-flex justify-content-end" ><a style="font-size:10px" class="btn btn-success btn-sm " href="createemployee">Add New Employee</a></div>
<table class="table mt-1" id="dataTableemployee">
    <thead>
        <tr style="font-size:10px">
            <th>Employee ID</th>
            <th>First Name</th>
            <th>last Name</th>
            <th>Company Name</th>
            <th>Email</th>
            <th>Phone</th>
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
        var table = $('#dataTableemployee').DataTable({
            ajax:"{{url('ajaxemployee')}}",
            pageLength : 10,
            lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']],
            "order": [[ 3, "desc" ]],
            columns:[
                
                {"data":"empid"},
                {"data":"firstname",},
                {"data":"lastname"},
                {"data":"name"},
                {"data":"employee_email"},
                {"data":"phone"},
          { 
              "data": null,
              render: function(data, type, row) {
              return `<a  class="btn btn-sm text-info" href="editemployee/${row.empid}" id="edit"><i class="fas fa-pencil-alt"></i></a>&nbsp;<button data-id="${row.empid}" class="btn btn-sm text-danger" id="deleteemployee"><i class="fas fa-times"></i></button>`;
              }
          },

            ]
        });
        $(document).on('click', '#deleteemployee', function() {
        if(confirm('Are you sure you want delete?')){
        $.ajax({
          url: "{{ url('deleteemployee') }}",
          type: "post",
          dataType: 'json',
          data: {
              "_token": "{{ csrf_token() }}",
              "empid": $(this).attr('data-id')
          },
          success: function(response) {
              table.ajax.reload();
          swal("Deleted","{!!session::get('message')!!}","success",{
          button:"Done",
    })

          }
      })
  }
})
    })
</script>
@endsection