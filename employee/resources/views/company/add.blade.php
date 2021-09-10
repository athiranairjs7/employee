@extends('app')
@section('title','New Company')
@section('content')
    <div class="container">
        <div class="card  pb-5">
      <div class="card-header pb-3">Add New Company</div>
      <form method="POST" enctype="multipart/form-data" action="{{route('company.create')}}">
            @csrf
            <div class="form-group row pt-5">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Company Name') }}</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div><br>
            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Company email') }}</label>
                <div class="col-md-6">
                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div><br>
            <div class="form-group row">
                <label for="website" class="col-md-4 col-form-label text-md-right">{{ __('Company website') }}</label>
                <div class="col-md-6">
                    <input id="website" type="text" class="form-control @error('website') is-invalid @enderror" name="website" value="{{ old('website') }}" autocomplete="website" autofocus>
                    @error('website')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div><br>
            <div class="form-group row">
                <label for="logo" class="col-md-4 col-form-label text-md-right">{{ __('Company logo') }}</label>
                <div class="col-md-6">
                    <input id="image" type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                    @error('image')
                        <span class="invalid-feedback" role="alert" >
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