@extends('backend.layouts.master')
@section('content')
  <!-- Main content -->
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      
    </div>
    <!-- /.content-header -->
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3>Employees Attendance Details Information 
                  <a class="btn btn-success float-right btn-sm text-light" href="{{ route('employees.attendance.index') }}"><i class="fa fa-list"></i> Employee Attendance List</a>
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-striped table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>SL. </th>
                    <th>ID No. </th>
                    <th>Name </th>
                    <th>Date</th>
                    <th>Attendance Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($details as $key => $value)
                  <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$value['employee']['id_no']}}</td>
                    <td>{{$value['employee']['name']}}</td>
                    <td>{{date('d-m-Y',strtotime($value->date))}}</td>
                    <td>{{$value->attend_status}}</td>
                    
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
