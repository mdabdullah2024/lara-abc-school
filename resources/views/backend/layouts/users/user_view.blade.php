@extends('backend.layouts.master')
@section('content')
  <!-- Main content -->
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ __('Dashboard') }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Manage Users</a></li>
              <li class="breadcrumb-item active">{{ __('Dashboard') }}</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3>Users List
                  <a class="btn btn-success float-right btn-sm" href="{{ route('users.create') }}"><i class="fa fa-plus-circle"></i>Add</a>
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-striped table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>SL. </th>
                    <th>User Role</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Code</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($users as $key => $user)
                  <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{ $user->usertype }}</td>
                    <td>{{$user->name}}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->code }}</td>
                    <td>
                      <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}"><i class="fa fa-edit"></i></a>

                        @if(Auth::User()->name)

                      <a id="" onclick="dataDelete({{ $user->id }})" class="btn btn-danger" href="#"><i class="fa fa-trash"></i></a>

                      <form id="formdata-{{ $user->id }}" method="post" action="{{route('users.destroy',$user->id)}}" >
                        @csrf
                        @method('delete')
                        @endif
                      </form>
                    </td>
                  </tr>

                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
