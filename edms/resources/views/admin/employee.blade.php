@extends('layout.header')
@section('title','EDMS | Employee Pannel')
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
@if(Session::has('User_deleted'))
<script>
    swal("Great Job","{!!session::get('User_deleted')!!}","success",{
        button:"Done",
    })
</script>
@endif
<div class="container mt-3">
    <div class="d-flex justify-content-end"><a class="btn btn-primary btn-sm " href="newemployee">Add New Employee</a></div>
    <table class="table text-light table-responsive" id="employee"> 
    <thead>
      <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Gender</th>
        <th>Joining Date</th>
        <th>Country</th>
        <th>State</th>
        <th>Pincode</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
</div>

@endsection
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
<script>
     $(document).ready(function() {
    var table = $('#employee').DataTable({
        ajax:"{{url('displayemployee')}}",
        columns:[
          {"data":"firstname"},
          {"data":"lastname"},
          {"data":"email"},
          {"data":"gender"},
          {"data":"dateofjoining"},
          {"data":"country_name"},
          {"data":"state_name"},
          {"data":"pincode"},
          { 
              "data": null,
              render: function(data, type, row) {
              return `<button data-id="${row.id}" class="btn btn-sm text-warning" data-bs-toggle="modal" data-bs-target="#exModal" id="editemp"><i class="fas fa-pencil-alt"></i></button>&nbsp;<button data-id="${row.id}" class="btn btn-sm text-danger" id="deleteemp"><i class="fas fa-times"></i></button>`;
              }
          },
        ]
    });
    
     $(document).on('click', '#deleteemp', function() {
  if(confirm('Are you sure you want delete?')){
      $.ajax({
          url: "{{ url('deleteEmployee') }}",
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
});
//edit
  // edit
  $(document).on('click', '#editemp', function() {
        $.ajax({
            url: "{{ url('getEmployeeById') }}",
            type: "post",
            dataType: 'json',
            data: {
                "_token": "{{ csrf_token() }}",
                "id": $(this).data('id')
            },
            success: function(response) {
                $('input[name="id"]').val(response.data.id);
                $('select[name="country_id"]').val(response.data.country_id);
                $('select[name="state_id"]').val(response.data.state_id);
                $('input[name="gender"]').val(response.data.gender);
                $('input[name="firstname"]').val(response.data.firstname);
                $('input[name="lastname"]').val(response.data.lastname);
                $('input[name="email"]').val(response.data.email);
                $('input[name="city"]').val(response.data.city);
                $('input[name="pincode"]').val(response.data.pincode);
                $('input[name="dateofjoining"]').val(response.data.dateofjoining);
                
            }
        })
    })
  
</script>
@extends('admin.employeeedit')