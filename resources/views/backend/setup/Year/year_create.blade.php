@extends('backend.layouts.master')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> 
             @if(isset($editData))
             Edit Year
             @else
             Add Year
             @endif
              
              
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Setup Year </li>
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
                <h3>
                    <a class="btn btn-success float-right btn-sm text-light" href="{{ route('setup.student.year.index') }}"><i class="fa fa-list"></i> Year List</a>
                </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="userdata" action="{{ (@$editData)?route('setup.student.year.update',$editData->id):route('setup.student.year.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @if(isset($editData))
                @method('put')
              
                @endif
                <div class="card-body">
                  <div class="form-group">
                    <label for="name"> Year/Session</label>
                    <input id="name" type="text" name="name" class="form-control" id="" value="{{ (@$editData)? $editData->name:''}}">
                    <font style="color:red;">{{($errors->has('name'))?($errors->first('name')):""}}</font>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">{{ (@$editData)?'Update':'Submit' }}</button>
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