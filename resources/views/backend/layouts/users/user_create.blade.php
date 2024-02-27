@extends('backend.layouts.master')
@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add User

            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Register</li>
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
                <h3>User Registration Form
                    <a class="btn btn-success float-right btn-sm" href="{{ route('users.index') }}">Back</a>
                </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="userdata" action="{{ route('users.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                	<div class="form-group">
	                    <label for="role">User Role</label>
	                    <select class="form-control" name="role">
	                    	<option value="">Select User Role</option>
	                    	<option value="admin">Admin</option>
	                    	<option value="operator">Operator</option>
	                    </select>
                      
                      <font style="color:red;">{{($errors->has('usertype'))?($errors->first('usertype')):""}}</font>
                      
                  	</div>
                	<div class="form-group">
	                    <label for="name">Name</label>
	                    <input type="text" name="name" class="form-control" id="" placeholder="Enter Name">
                      <font style="color:red;">{{($errors->has('name'))?($errors->first('name')):""}}</font>
                  	</div>
                  <div class="form-group">
                    <label for="Email">Email address</label>
                    <input type="email" name="email" class="form-control" id="" placeholder="Enter email">
                    <font style="color:red;">{{($errors->has('email'))?($errors->first('email')):""}}</font>
                  </div>
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
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

@endsection