@extends('layouts.app')
<style>
    .card-body{
    border-collapse: collapse;
    box-shadow: 5px 10px 15px #888888;
  }
</style>
@extends('company.edit')
<div class="result">
@if(Session::get('User_update'))
<script>
swal("Great Job","{!!session::get('User_update')!!}","success",{
    button:"Done",
})
</script>
@endif
</div>
@section('content')
<body class="bg-light" >
<div class="container"style="font-size:12px">
    <div class="card-body bg-white mt-1">
    <table class="table" id="company" > 
            <div class="d-flex justify-content-end" ><a style="font-size:10px" class="btn btn-primary btn-sm " href="newcompany">Add New </a></div>
            <thead>
                <tr style="color:grey; font-size:10px">
                    <th>ID</th>
                    <th>LOGO</th>
                    <th>NAME</th>
                    <th>EMAIL</th>
                    <th>WEBSITE</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody style="color:black; font-size:12px"></tbody>
    </table>
    </div>
</div>
</body>

 <script>
  $(document).ready(function() {
    
    var table = $('#company').DataTable({
        ajax:"{{url('ajaxcompany')}}",
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
              return `<button data-id="${row.id}" class="btn btn-sm text-info" data-bs-toggle="modal" data-bs-target="#exampleModal" id="edit"><i class="fas fa-pencil-alt"></i></button>&nbsp;<button data-id="${row.id}" class="btn btn-sm text-danger" id="delete"><i class="fas fa-times"></i></button>`;
              }
          },
        ]
    });
    $(document).on('click', '#edit', function() {
        $.ajax({
            url: "{{ url('getCompanyById') }}",
            type: "post",
            dataType: 'json',
            data: {
                "_token": "{{ csrf_token() }}",
                "id": $(this).data('id')
            },
            success: function(response) {
                // $('input[name="company_id"]').val(response.data.id);
                $('input[name="name"]').val(response.data.name);
                $('input[name="email"]').val(response.data.email);
                $('input[name="website"]').val(response.data.website);
            }
        })
    })
    $(document).on('click', '#update', function() {
        $.ajax({
            url: "{{ url('updateCompany') }}",
            type: "post",
            dataType: "json",
            data: $('#modeleditform').serialize(),
            success: function(response) {
                $('#modeleditform')[0].reset();
                table.ajax.reload();
                swal("Great Job","{!!session::get('User_update')!!}","success",{
                    button:"Done",
                })
                $('#exampleModal').model('hide')
            }
        }) 
})
   //delete user
$(document).on('click', '#delete', function() {
  if(confirm('Are you sure you want delete?')){
      $.ajax({
          url: "{{ url('deleteCompany') }}",
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
  </script>
@endsection
