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
              <li class="breadcrumb-item"><a href="#">Manage Student Account fee </a></li>
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
                <h3> Student Account fee  List
                
                  <a class="btn btn-success float-right btn-sm" href="{{ route('students.accounts.fee.create') }}"><i class="fa fa-plus-circle"></i>
                    
                    Add Student Account fee 
                    

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
                    <th>Year</th>
                    <th>Class</th>
                    <th>Fee Type</th>
                    <th>Amounts</th>
                    <th>Date</th>
                    <th>Remarks</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($allData as $key => $value)
                  <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$value['student']['name']}}</td>
                    <td>{{$value['student']['id_no']}}</td>
                    <td>{{$value['year']['name']}}</td>
                    <td>{{$value['student_class']['name']}}</td>
                    <td>{{$value['fee_category']['name']}}</td>
                    <td>{{$value->amount}} TK</td>
                    <td>{{date('M Y',strtotime($value->date))}}</td>
                    <td>{{$value->start_point}}-{{$value->end_point}}</td>
                    <td>{{$value->remarks}}</td>
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
