@extends('layout.header')
@section('title','EDMS | User Pannel')
@section('content')
<style>
  table{
    border-collapse: collapse;
    box-shadow: 5px 10px 15px #888888;
  }
  tbody, td, tfoot, th, thead, tr {
    border-color: inherit;
    border-style: none;
    border-width: 0;
}
tr:nth-child(odd){
  background-color: #222;
}
tr:nth-child(even){
  background-color: #111;
}
thead tr{
  background-color: black !important;
}
</style>

@extends('admin.editmodel')


<div class="container">
@if(Session::has('User_deleted'))
<script>
    swal("Great Job","{!!session::get('User_deleted')!!}","success",{
        button:"Done",
    })
</script>
@endif
@if(Session::has('active'))
<script>
    swal("Great Job","{!!session::get('active')!!}","success",{
        button:"Done",
    })
</script>
@endif
<br>
<div>
  <table class="table text-light table-responsive" id="user"> 
    <div class="d-flex justify-content-end"><a class="btn btn-primary btn-sm " href="newuser">Add New User</a></div>
    <thead>
      <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Role</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
</div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
 <script>
  $(document).ready(function() {
    var table = $('#user').DataTable({
        ajax:"{{url('display')}}",
        columns:[
          {"data":"firstname"},
          {"data":"lastname"},
          {"data":"email"},
          {"data":"role"},
          { 
            "data": null,
            render: function(data, type, row) {
                if(row.is_active == 1) {
                    return `<button class="btn btn-sm btn-success" data-id="${row.id}" id="inactive">  Active</button>`;
                } else {
                    return `<button class="btn btn-sm btn-secondary" data-id="${row.id}" id="active">Inactive</button>`;
                }
            }
                    },
          { 
              "data": null,
              render: function(data, type, row) {
              return `<button data-id="${row.id}" class="btn btn-sm text-warning" data-bs-toggle="modal" data-bs-target="#exampleModal" id="edit"><i class="fas fa-pencil-alt"></i></button>&nbsp;<button data-id="${row.id}" class="btn btn-sm text-danger" id="delete"><i class="fas fa-times"></i></button>`;
              }
          },
        ]
    });
    
   
    // delete user
$(document).on('click', '#delete', function() {
  if(confirm('Are you sure you want delete?')){
      $.ajax({
          url: "{{ url('deleteUser') }}",
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
//inactive

} );

</script> 
