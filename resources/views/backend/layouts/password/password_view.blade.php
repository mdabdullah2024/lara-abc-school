@extends('backend.layouts.master')
@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Change Password

            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Password Change</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-light">
              <div class="card-header">
                <h3>Change Password
                </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="password" action="{{ route('password.update')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card-body">
                  <div class="form-group">
                    <label for="current_password">Current Password</label>
                    <input type="password" name="current_password" class="form-control" id="" placeholder=" Current Password">
                    <font style="color:red;">{{($errors->has('current_password'))?($errors->first('current_password')):""}}</font>
                  </div>
                  <div class="form-group">
                    <label for="new_password">New password</label>
                    <input type="password" name="new_password" class="form-control" id="new_password" placeholder="new password">
                    <font style="color:red;">{{($errors->has('new_password'))?($errors->first('new_password')):""}}</font>
                  </div>
                  <div class="form-group">
                    <label for="confirm_new_Password">Contfirm New Password</label>
                    <input type="password" name="confirm_new_Password" class="form-control" id="password" placeholder="confirm new Password">
                    <font style="color:red;">{{($errors->has('confirm_new_Password'))?($errors->first('confirm_new_Password')):""}}</font>
                  </div>
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Change Password</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<script>
$(function () {
 
  $('#password').validate({
    rules: {
      current_password: {
        required: true,
        minlength: 8
      },
      new_password: {
        required: true,
        minlength: 8
      },
      confirm_new_Password: {
        required: true,
        equalTo: '#new_password'
      },
      
    },
    messages: {
      current_password: {
        required: "Please Enter Current password ",
        minlength: "Your password must be at least 8 characters long"
      },
       new_password: {
        required: "Please Enter a new password",
        minlength: "Your password must be at least 8 characters long"
      },
      confirm_new_Password: {
        required: "Please Enter confirm password",
        equalTo: "Confirm password does not match"
      },
      terms: "Please accept our terms"
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>
@endsection