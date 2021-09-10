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
          <h6>Update Company</h6>
          <a href="/" >Dashboard</a>
      </div>
      <form method="POST" enctype="multipart/form-data" action="{{url('editcompany/{$company_details->id}')}}">
      {{ csrf_field() }}
      
            <div class="form-group row pt-5">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Company ID') }}</label>
                <div class="col-md-6">
                <input type = "text"  id="id" name = "id" value = "{{$company_details->id}}" readonly class="form-control">
                </div>
            </div><br>
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Company Name') }}</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" value="{{ $company_details->name }}" autocomplete="name" autofocus>
                </div>
            </div><br>
            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Company email') }}</label>
                <div class="col-md-6">
                    <input id="email" type="text" class="form-control " name="email" value="{{ $company_details->email }}" autocomplete="email" autofocus>
                </div>
            </div><br>
            <div class="form-group row">
                <label for="website" class="col-md-4 col-form-label text-md-right">{{ __('Company website') }}</label>
                <div class="col-md-6">
                    <input id="website" type="text" class="form-control" name="website" value="{{ $company_details->website }}" autocomplete="website" autofocus>
                </div>
            </div><br>
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-dark btn-sm">Save Changes</button>
                </div>
            </div>
        </form>
        </div>
    </div>