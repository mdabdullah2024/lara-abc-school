

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
              <li class="breadcrumb-item"><a href="#">Manage Employee Salary </a></li>
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
                <h3> Employee Salary  List
                
                  <a class="btn btn-success float-right btn-sm" href="{{ route('employee.accounts.fee.create') }}"><i class="fa fa-plus-circle"></i>
                    
                    Add Employee Salary
                    

                  </a>
                  
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-striped table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>SL. </th>
                    <th>Name</th>
                    <th>ID no.</th>
                    <th>Amount</th>
                    <th>Date</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($all as $key => $value)
                  <tr class="{{$value->id}}">
                    <td>{{$key + 1}}</td>
                    <td>{{$value->amount}}</td>
                    <td>{{$value->amount}}</td>
                    <td>{{$value->amount}}</td>
                    <td>{{date('M Y',strtotime($value->date))}}</td>
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
