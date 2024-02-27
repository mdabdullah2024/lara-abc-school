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
              <li class="breadcrumb-item"><a href="#">Manage profiles</a></li>
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
                <h3>profiles
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="card">
                    
                    <div class="card-body">
                      <table class="table table-striped">
                        <tbody class="m-0">
                          <td style="display:block; position:relative;">
                            <img style="position:absolute; width:200%; height: 150px; border-radius: 20px; padding: 10px;" class="img  d-inline-block" src="{{ (!empty($profiles->image)?url('public/upload/user_images/'.$profiles->image):url('public/upload/no_image.png')) }}" alt="Card image cap">
                          </td>
                          <tr align="center" style="display:block; position: relative;">
                            
                            <td style="display:inline-block;">
                              <img width="180px" height="180px" class="img rounded-circle d-inline-block" src="{{ (!empty($profiles->image)?url('public/upload/user_images/'.$profiles->image):url('public/upload/no_image.png')) }}" alt="Card image cap">
                            </td>
                          </tr class="m-auto">
                          <tr class="m-0">
                            <td class="bg-light d-inline-block">Name :</td>
                            <td>{{$profiles->name}}</td>
                          </tr>

                          <tr class="bg-light m-0">
                            <td class="bg-light d-inline-block">Address :</td>
                            <td>{{$profiles->address}}</td>
                          </tr>
                          <tr class="bg-light m-0">
                            <td class="bg-light d-inline-block">Mobile :</td>
                            <td>{{$profiles->mobile}}</td>
                          </tr>
                          <tr class="bg-light m-0">
                            <td class="bg-light d-inline-block">Gender :</td>
                            <td>{{$profiles->gender}}</td>
                          </tr>
                          
                          <tr class="bg-light m-0">
                            <td class="bg-light d-inline-block">Edit Profile</td>
                           <td > <a class="btn btn-primary d-block" href="{{route('profiles.edit',$profiles->id)}}"><i class="fa fa-edit"></i> Edit Your Profile</a></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
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