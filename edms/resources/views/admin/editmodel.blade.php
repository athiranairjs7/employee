
<!--edit Modal -->
<div  class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-secondary text-white">
        <h5 class="modal-title" id="exampleModalLabel">User updation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    <div class="container">
    <div class="row">
        <div class="col-md-12 bg-light p-5">
            <form  id="modeleditform"> 
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
            <input type="hidden" name="id" id="id">
            <div class="form-group mb-3">
                <label for="firstname">Firstname</label>
                <input type="text" name="firstname"class="form-control" class="firstname">
            </div>
            <div class="form-group mb-3">
                <label for="lastname">lastname</label>
                <input type="text" name="lastname" class="form-control">
            </div>
            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" name="email"class="form-control">
            </div>
            
            <div class="form-group mb-5">
                <label for="role">Role</label>
                <select class="form-control" name="role_id">
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->role}}</option>
                @endforeach
                </select>
            </div>
            <div class="form-group" style="float: right;">
                <button type="submit" class="btn btn-secondary text-white" id="update">Save Changes</button>
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
    // edit
    $(document).on('click', '#edit', function() {
        $.ajax({
            url: "{{ url('getUserById') }}",
            type: "post",
            dataType: 'json',
            data: {
                "_token": "{{ csrf_token() }}",
                "id": $(this).data('id')
            },
            success: function(response) {
                $('input[name="id"]').val(response.data.id);
                $('select[name="role_id"]').val(response.data.role_id);
                $('input[name="firstname"]').val(response.data.firstname);
                $('input[name="lastname"]').val(response.data.lastname);
                $('input[name="email"]').val(response.data.email);
                
            }
        })
    })
    $(document).on('click', '#update', function() {
    if(confirm('Are you sure you want update?')){
        $.ajax({
            url: "{{ url('updateUser') }}",
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
    }
})
</script>