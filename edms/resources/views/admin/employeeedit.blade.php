
<!--edit Modal -->
<div  class="modal fade " id="exModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-secondary text-white">
        <h5 class="modal-title" id="exampleModalLabel">Employee updation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    <div class="container">
    <div class="row">
        <div class="col-md-12 bg-light p-5">
            <form  id="employeeedit"> 
            @csrf
                <div class="result">
                @if(Session::get('User_update'))
                <script>
                swal("Great Job","{!!session::get('User_update')!!}","success",{
                    button:"Done",
                })
                </script>
                @endif
                </div>
            <input type="hidden" name="id">
            <div class="row">
              <div class="col-md-6">
              <div class="form-group mb-3">
                <label for="firstname">Firstname</label>
                <input type="text" name="firstname"class="form-control" class="firstname">
            </div>
              </div>
              <div class="col-md-6">
              <div class="form-group mb-3">
                <label for="lastname">lastname</label>
                <input type="text" name="lastname" class="form-control">
            </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
              <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" name="email"class="form-control">
            </div>
              </div>
              <div class="col-md-6">
              <div class="form-group mb-3">
                <label for="dateofjoining">Date of Joining</label>
                <input type="date" class="form-control" name="dateofjoining">
            </div>
              </div>
            </div> 
            <div class="form-group mb-3">
                <label for="gender">Gender</label>
                <input name="gender" id="gender" class="form-control">
                  <!-- <option value="female">Female</option>
                  <option value="male">Male</option>
                  <option value="other">Other</option> -->
                
            </div>
            <div class="row">
              <div class="col-md-6">
              <div class="form-group mb-3">
                <label for="country">Country</label>
                <select name="country_id" id="country" class="form-control">
                @foreach($country as $con)
                  <option value="{{$con->country_id}}">{{$con->country_name}}</option>
                @endforeach
                </select>
            </div>
              </div>
              <div class="col-md-6">
              <div class="form-group mb-3">
                <label for="state">State</label>
                <select name="state_id" id="state" class="form-control">
                @foreach($state as $con)
                  <option value="{{$con->state_id}}">{{$con->state_name}}</option>
                @endforeach
                </select>
            </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <label for="city">City</label>
                  <input type="text" name="city" class="form-control">
                </div>
              </div>
              <div class="col-md-6">
              <div class="form-group mb-3">
                  <label for="pincode">Pincode</label>
                  <input type="text" name="pincode" class="form-control">
                </div>
              </div>
            </div>
            <div class="form-group" style="float: right;">
                <button type="submit" class="btn btn-secondary text-white" id="updateemp">Save Changes</button>
                <button type="reset" class="btn btn-danger text-white">Cancel</button>
            </div> 
            </form>
            </div>    
        </div>
        </div>
    </div>
  </div>
</div>
<script>
    $(document).on('click', '#updateemp', function() {
   
        $.ajax({
            url: "{{ url('updateEmployees') }}",
            type: "post",
            dataType: "json",
            data: $('#employeeedit').serialize(),
            success: function(response) {
                $('#employeeedit')[0].reset();
                table.ajax.reload();
                swal("Great Job","{!!session::get('User_update')!!}","success",{
                    button:"Done",
                })
                $('#exModal').model('hide')
            }
        })
})
</script>