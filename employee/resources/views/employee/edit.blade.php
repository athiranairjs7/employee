
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> 
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script> 
    <style>
    .card{
    border-collapse: collapse;
    box-shadow: 5px 10px 15px #888888;
    margin-left: 10%;
    margin-top: 5%;
    font-size: 14px;
  }
    </style>
<div class="container">
    <div class="card  pb-5">
    <div class="card-header pb-3 d-flex justify-content-between">
          <h6>Update Employee</h6>
          <a href="/" >Dashboard</a>
      </div>
    <form method="POST" enctype="multipart/form-data" action="{{url('editemployee/{$employee_details->empid}')}}">
        @csrf
        <div class="form-group row pt-5">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Employee ID') }}</label>
                <div class="col-md-6">
                <input type = "text"  id="empid" name = "empid" value = "{{$employee_details->empid}}" readonly class="form-control">
                </div>
            </div><br>
        <div class="form-group row ">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Firstname') }}</label>
            <div class="col-md-6">
                <input id="firstname" type="text" class="form-control" name="firstname" value="{{ $employee_details->firstname }}" autocomplete="name" autofocus>
             
            </div>
        </div><br>
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Lastname') }}</label>
            <div class="col-md-6">
                <input id="lastname" type="text" class="form-control " name="lastname" value="{{$employee_details->lastname}}" autocomplete="name" autofocus>
              
            </div>
        </div><br>
        <div class="form-group row">
            <label for="company_id" class="col-md-4 col-form-label text-md-right">Company</label>
            <div class="col-md-6">
                <select class="form-control" name="company_id" id="company_id">
                       
                        @foreach($company as $result)
                        <option value="{{$result->id}}"  @if($result->id==$employee_details->company_id) selected='selected' @endif>{{$result->name}}</option>
                        @endforeach
                </select>
               
            </div>
        </div><br>
        <div class="form-group row">
            <label for="employee_email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
            <div class="col-md-6">
                <input id="employee_email" type="text" class="form-control " name="employee_email" value="{{$employee_details->employee_email }}" autocomplete="employee_email" autofocus>
     
            </div>
        </div><br>
       
        <div class="form-group row">
            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __(' phone') }}</label>
            <div class="col-md-6">
                <input id="phone" type="text" class="form-control" name="phone" value="{{ $employee_details->phone }}" autocomplete="phone" autofocus>
            </div>
        </div>
        
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
            </div>
        </div>
    </form>
    </div>
</div>
