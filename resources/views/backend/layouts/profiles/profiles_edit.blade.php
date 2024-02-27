@extends('backend.layouts.master')
@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">profile Edit</li>
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
                <h3 >profile Edit
                    <a class="btn btn-success float-right btn-sm" href="{{ route('profiles.index') }}">Back</a>
                </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="profiledata" action="{{route('profiles.update')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card-body">
                	<div class="form-group">
	                    <label for="name">Name</label>
	                    <input type="text" name="name" class="form-control" id="" value="{{$profiles->name}}">
                      <font style="color:red;">{{($errors->has('name'))?($errors->first('name')):""}}</font>
                  	</div>
                  <div class="form-group">
                    <label for="Email">Email address</label>
                    <input type="email" name="email" class="form-control" id="" value="{{$profiles->email}}">
                    <font style="color:red;">{{($errors->has('email'))?($errors->first('email')):""}}</font>
                  </div>
                  <div class="form-group">
                    <label for="mobile">Mobile</label>
                    <input type="text" name="mobile" class="form-control" id="" value="{{$profiles->mobile}}">
                    <font style="color:red;">{{($errors->has('mobile'))?($errors->first('mobile')):""}}</font>
                  </div>

                  <div class="form-group">
                    <label for="address">address</label>
                    <input type="text" name="address" class="form-control" id="" value="{{$profiles->address}}">
                    <font style="color:red;">{{($errors->has('address'))?($errors->first('address')):""}}</font>
                  </div>
                  <div class="form-group">
                    <label for="gender">gender</label>
                    <select class="form-control" name="gender">
                    	<option value="">Select Gender</option>
                    	<option value="Male" {{($profiles->gender =='Male')?"selected":""}}>Male</option>
                    	<option value="Female" {{($profiles->gender=='Female')?"selected":""}}>Female</option>
                    	<option value="Others"{{($profiles->gender=='Others')?"selected":""}}> Others</option>
                    </select>
                    <font style="color:red;">{{($errors->has('gender'))?($errors->first('gender')):""}}</font>
                  </div>
                  <div class="form-group">
                    <label for="image">image</label>
                    <input id="image" type="file" name="image" class="form-control" id="" value="{{$profiles->image}}">
                    <font style="color:red;">{{($errors->has('image'))?($errors->first('image')):""}}</font>

                  </div>
                  <div class="form-group">
                    
                    <img id="ImageShow" style="border:1px solid black;width: 120px ; height: 120px;"  src="{{ (!empty($profiles->image))? url('public/upload/user_images/'.$profiles->image): url('public/upload/no_image.png')}}">
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

