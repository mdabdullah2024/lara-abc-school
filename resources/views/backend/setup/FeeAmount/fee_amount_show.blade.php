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
              <li class="breadcrumb-item"><a href="#">Manage Fee Amount Details</a></li>
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
                <h3>Fee Amount Details
                  
                  <a class="btn btn-success float-right btn-sm" href="{{ route('setup.fee.amount.index') }}"><i class="fa fa-list"></i> List</a>
                  
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table  class="table table-striped table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>SL. </th>
                    <th>Class</th>
                    <th>Amount</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($editData as $key => $value)

                  <tr class="{{$value->id}}">
                    <td>{{$key + 1}}</td>
                    <td>{{$value['student_class']['name']}}</td>
                    <td>{{$value->amount}}</td>
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
