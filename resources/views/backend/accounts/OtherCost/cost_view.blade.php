

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
              <li class="breadcrumb-item"><a href="#">Manage Other Cost </a></li>
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
                <h3> Other Cost List
                
                  <a class="btn btn-success float-right btn-sm" href="{{ route('cost.fee.create') }}"><i class="fa fa-plus-circle"></i>
                    
                    Add Other Cost  
                    

                  </a>
                  
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-striped table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>SL. </th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Description</th>
                    <th>image</th>
                    <th>action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($allData as $key => $value)
                  <tr class="{{$value->id}}">
                    <td>{{$key + 1}}</td>
                    <td>{{date('M Y',strtotime($value->date))}}</td>
                    <td>{{$value->amount}}</td>
                    <td>{{$value->description}}</td>
                    <td>
                      <img class="image rounded-circle" width="150px" height="150px" src="{{ (!empty($value->image))?url('public/upload/cost_images/'.$value->image):url('public/upload/no_image.png') }}">
                    </td>
                    <td>
                      <a href="{{route('cost.fee.edit',$value->id)}}" class="btn btn-info btn-sm" title="Edit" ><i class="fa fa-edit"></i></a>
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
