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
              <li class="breadcrumb-item"><a href="#">Manage Desigantion</a></li>
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
                <h3>Employees List
                
                  <a class="btn btn-success float-right btn-sm" href="{{ route('employees.registration.create') }}"><i class="fa fa-plus-circle"></i>Add Employee</a>
                  
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-striped table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>SL. </th>
                    <th>ID No. </th>
                    <th>Name</th>
                    <th>Mobile No</th>
                    <th>Address</th>
                    <th>Gender</th>
                    <th>Join Date</th>
                    <th>Salary</th>
                    @if(Auth::user()->role == "admin")
                    <th>Code</th>
                    @endif
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($allData as $key => $value)
                  <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{ $value->id_no }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->mobile }}</td>
                    <td>{{ $value->address }}</td>
                    <td>{{ $value->gender }}</td>
                    <td>{{ date('d-m-Y',strtotime($value->join_date)) }}</td>
                    <td>{{ $value->salary }}</td>
                    @if(Auth::user()->role == "admin")
                    <td>{{$value->code}}</td>
                    @endif
                    <td>
                      @if(Auth::User()->usertype == "admin")
                      <a title="Edit" class="btn btn-primary" href="{{route('employees.registration.edit',$value->id)}}"><i class="fa fa-edit"></i></a>
                      <a title="Details" class="btn btn-info" target="_blank" href="{{route('employees.registration.details',$value->id)}}"><i class="fa fa-eye"></i></a>
                      @endif
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
  <script type="text/javascript">
    function employeeDataDelete(id){
        if(confirm('Are You Sure Want to Delete student Class ')){
            document.getElementById('employee-formdata-'+id).submit();
        }
    }
  </script>
@endsection
