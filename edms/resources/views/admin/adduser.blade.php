@extends('layout.header')
@section('title','EDMS | New User')
@section('content')

<div class="container">
    <div class="row p-5 pt-1">
        <div class="col-md-12 bg-light p-5 pt-2">
            <form action="{{route('admin.create')}}" method="POST" id="adduserform">
                @csrf
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
                    <h3 class="mb-4 mt-3">User Registration</h3><hr>
                <div class="form-group mb-3">
                    <label for="firstname">Firstname</label>
                    <input type="text" id="firstName" name="firstname"class="form-control" placeholder="Enter firstname" value="{{old('firstname')}}"  onkeyup="ValidateFirstname();">
                    <span class="text-danger" id="lblErrorFirstname">@error('firstname'){{$message }} @enderror</span>
                </div>
                <div class="form-group mb-3">
                    <label for="lastname">lastname</label>
                    <input type="text" name="lastname" class="form-control" placeholder="Enter lastname" value="{{old('lastname')}}">
                    <span class="text-danger">@error('lastname'){{$message }} @enderror</span>
                </div>
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email"id="txtEmail" name="email"class="form-control" placeholder="Enter email" value="{{old('email')}}"  onkeyup="ValidateEmail();">
                    <span id="lblErrorEmail" class="text-danger">@error('email'){{$message }} @enderror</span>
                </div>
                <div class="form-group mb-3">
                    <label for="password">Password</label>
                    <input type="password" name="password"class="form-control" placeholder="Enter password" value="{{old('password')}}">
                    <span class="text-danger">@error('password'){{$message }} @enderror</span>
                </div>
                <div class="form-group mb-5">
                    <label for="role">Role</label>
                    <select name="role_id" class="form-control">
                        <!-- <option value="1">HR</option>
                        <option value="2" selected>Auditor</option> -->
                        @foreach ($role as $userrole)
                        <option value="{{$userrole->id}}">{{$userrole->role}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" style="float: right;">
                    <button type="submit" class="btn btn-secondary text-white">Save</button>
                    <button type="reset" class="btn btn-danger text-white">Cancel</button>
                </div>
            </form>
        </div>    
    </div>
</div>
@endsection
<script>
function ValidateFirstname(){
    let firstname = document.getElementById("firstName").value;
    let lblError = document.getElementById("lblErrorFirstname");
    lblError.innerHTML = "";
    let expr =/^[a-zA-Z]+$/;
    if(!expr.test(firstname)){
        lblError.innerHTML = "Invalid Firstname";
    }
}
function ValidateEmail() {
    var email = document.getElementById("txtEmail").value;
    var lblError = document.getElementById("lblErrorEmail");
    lblError.innerHTML = "";
    var expr = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if (!expr.test(email)) {
        lblError.innerHTML = "Invalid email address";
    }
}


</script>