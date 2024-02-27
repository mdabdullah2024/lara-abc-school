@extends('backend.layouts.master')
@section('content')
  <!-- Main content -->
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3>Employees Salary log info
                  <a class="btn btn-success float-right btn-sm text-light" href="{{ route('employees.salary.index') }}"><i class="fa fa-list"></i> Employee Salary List</a>
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="" class="table table-striped table-bordered table-hover">
                  <h5><strong>Name:</strong>{{$details->name}}</h5>
                  <h5> <strong>ID:</strong>{{$details->id_no}}</h5>
                  <thead>
                  <tr>
                    <th>SL. </th>
                    <th>Salary Effected Date</th>
                    <th>Previous Salary</th>
                    <th>Present Salary</th>
                    <th>Increment</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($salary_log as $key => $value)
                  <tr>
                    @if($key=='0')
                    <td class="text-center" colspan="5"><strong>Joining Salary: </strong>{{ $value->previous_salary }} TK</td>
                    @else
                    <td>{{$key + 1}}</td>
                    <td>{{ date('d-m-Y',strtotime($value->effected_date)) }}</td>
                    <td>{{ $value->previous_salary }} TK</td>
                    <td>{{ $value->present_salary }} TK</td>
                    <td>{{ $value->increment_salary }} TK</td>
                    @endif
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
