@extends('layout.header')
@section('title','EDMS | New Employee')
@section('content')

<form action="{{route('employee.create')}}" method="POST">
<div class="result">
    @if(Session::get('success'))
    <script>
        swal("Great Job","{!!session::get('success')!!}","success",{
            button:"Done",
        })
    </script>
    @endif
    @if(Session::get('fail'))
    <div class="alert alert-danger">
            {{Session::get('fail')}}
    </div>
    @endif
</div>
  @csrf
<div class="container pt-5 pb-5 bg-light">
<h2 class="pt-3 pb-5">Employee Registration Form</h2>
<hr><br>
<div class="row g-3">
 
  <div class="col-md-3">
      <label for="">Salutation</label>
      <select name="salutation" class="form-control" >
        <option value="Mr">Mr</option>
        <option value="Mrs">Mrs</option>
        <option value="Miss">Miss</option>
      </select>
  </div>
  <div class="col-md-3">
      <label for="">First Name</label>
      <input type="text" class="form-control"  placeholder="Firstname"  name="firstname">
      <span class="text-danger" id="lblErrorFirstname">@error('firstname'){{$message }} @enderror</span>
  </div>
  <div class="col-md-3">
    <label for="">Last name</label>
    <input type="text" class="form-control"  placeholder="Lastname" name="lastname">
    <span class="text-danger">@error('lastname'){{$message }} @enderror</span>

  </div>
  <div class="col-md-3">
    <label for="">Address</label>
    <input type="text" class="form-control"  placeholder="address"  name="address">
    <span class="text-danger">@error('address'){{$message }} @enderror</span>
  </div>
</div>
<br>
<!-- end of row 1 -->

<div class="row g-3 ">
  <div class="col-md-4">
      <label for="">Email</label>
      <input type="email" class="form-control"  placeholder="Email"  name="email">
      <span class="text-danger">@error('email'){{$message }} @enderror</span>
  </div>
  <div class="col-md-4">
      <label for="">Gender</label>
      <div class=" d-flex">
           <div class="form-check">
           <input type="radio" name="gender" value="Male">
              <label class="form-check-label">Male&nbsp;&nbsp;</label>
            </div>
            <div class="form-check">
            <input type="radio" name="gender" value="Female">
              <label class="form-check-label" >Female&nbsp;&nbsp; </label>
            </div>
            <div class="form-check">
            <input type="radio" name="gender" value="other">
              <label class="form-check-label">Other</label>
            </div>
            
      </div>
      <span class="text-danger">@error('gender'){{$message }} @enderror</span>
  </div>
  <div class="col-md-4">
      <label for="">Date of Joining</label> 
      <input type="date" class="form-control"  placeholder="Date of Joining"  name="dateofjoining">
      <span class="text-danger">@error('dateofjoining'){{$message }} @enderror</span>
  </div>
  <!-- <div class="col-md-3">
      <label for="">Resume</label>
      <input type="file" class="form-control"  placeholder="Resume"  name="resume">
  </div> -->
</div><br>
<!-- end of row2 -->

<div class="row g-3">
  <div class="col-md-3">
    <label for="">Country</label>
    <select class="form-control" name="country" id="country">
    <option value="">Select Country</option>
    @foreach ($country as $countr) 
        <option value="{{$countr->country_id}}">{{$countr->country_name}}</option>
    @endforeach
  </select>
  <span class="text-danger">@error('country'){{$message }} @enderror</span>
  </div>
  <div class="col-md-3">
    <label for="">State</label>
    <select class="form-control" name="state" id="state">
    <span class="text-danger">@error('state'){{$message }} @enderror</span>
  </select>
  </div> 
  
  
  <div class="col-md-3">
    <label for="">City</label>
    <input type="text" class="form-control"  placeholder="City" name="city">
    <span class="text-danger">@error('city'){{$message }} @enderror</span>
  </div>
  <div class="col-md-3">
    <label for="">Pincode</label>
    <input type="text" class="form-control"  placeholder="Pincode"  name="pincode">
    <span class="text-danger">@error('pincode'){{$message }} @enderror</span>
  </div>
</div>
<br>
<!-- end of row3 -->
<div class="row ">
  <div class="col">
    <button type="submit" class="btn"style="background-color: teal;color:white" name="add_employee">Submit</button>
    <button type="reset" class="btn btn-danger">Cancel</button>
  </div>
</div>
</form>
@endsection
<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script> -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    $('#country').on('change', function() {
      var country_id = this.value;
      $("#state").html('');
      $.ajax({
        url:"{{url('get-states-by-country')}}",
        type: "POST",
        data: {
          country_id: country_id,
          _token: '{{csrf_token()}}' 
        },
        dataType : 'json',
        success: function(result){
          $('#state').html('<option value="">Select State</option>'); 
          $.each(result.states,function(key,value){
            $("#state").append('<option value="'+value.state_id+'">'+value.state_name+'</option>');
          });
        }
      });
    });    
  });
</script>
