@extends('app')
@section('title','New Employee')
@section('content')
    <div class="container">
        <div class="card  pb-5">
      <div class="card-header pb-3 ml-5">Add New Employee</div>
      <form method="POST" enctype="multipart/form-data" action="{{route('employee.create')}}">
            @csrf
            <div class="form-group row pt-5">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Firstname') }}</label>
                <div class="col-md-6">
                    <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" autocomplete="name" autofocus>
                    @error('firstname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div><br>
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Lastame') }}</label>
                <div class="col-md-6">
                    <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" autocomplete="name" autofocus>
                    @error('lastname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div><br>
            <div class="form-group row">
                <label for="employee_email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                <div class="col-md-6">
                    <input id="employee_email" type="text" class="form-control @error('employee_email') is-invalid @enderror" name="employee_email" value="{{ old('employee_email') }}" autocomplete="employee_email" autofocus>
                    @error('employee_email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div><br>
            <div class="form-group row">
                <label for="company_id" class="col-md-4 col-form-label text-md-right">Company</label>
                <div class="col-md-6">
                    <select class="form-control" name="company_id" id="company_id">
                            @foreach($company as $result)
                            <option value="{{$result->id}}">{{$result->name}}</option>
                            @endforeach
                    </select>
                    @error('company_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div><br>
            <div class="form-group row">
                <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __(' phone') }}</label>
                <div class="col-md-6">
                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" autocomplete="phone" autofocus>
                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div><br>
           
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-dark btn-sm">Submit</button>
                </div>
            </div>
        </form>
        </div>
    </div>
@endsection