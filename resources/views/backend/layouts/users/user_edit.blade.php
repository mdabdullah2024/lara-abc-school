@extends('backend.layouts.master')
@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Edit</li>
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
                <h3 >User Edit
                    <a class="btn btn-success float-right btn-sm" href="{{ route('users.index') }}">Back</a>
                </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="userdata" action="{{ route('users.update',$user->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card-body">
                	<div class="form-group">
	                    <label for="role">User Type</label>
	                    <select class="form-control" name="role">
	                    	<option value="">Select User Role</option>
	                    	<option value="admin" {{ ($user->role == 'admin')?"selected" : ""}}>Admin</option>
	                    	<option value="operator"{{ ($user->role == 'operator')?"selected" : ""}}>Operator</option>
	                    </select>
                      
                      <font style="color:red;">{{($errors->has('role'))?($errors->first('role')):""}}</font>
                      
                  	</div>
                	<div class="form-group">
	                    <label for="name">Name</label>
	                    <input type="text" name="name" class="form-control" id="" value="{{$user->name}}">
                      <font style="color:red;">{{($errors->has('name'))?($errors->first('name')):""}}</font>
                  	</div>
                  <div class="form-group">
                    <label for="Email">Email address</label>
                    <input type="email" name="email" class="form-control" id="" value="{{$user->email}}">
                    <font style="color:red;">{{($errors->has('email'))?($errors->first('email')):""}}</font>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
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