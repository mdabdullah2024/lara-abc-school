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
              <li class="breadcrumb-item"><a href="#">Manage Students</a></li>
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
                <h3>Students List
                
                  <a class="btn btn-success float-right btn-sm" href="{{ route('students.registration.create') }}"><i class="fa fa-plus-circle"></i>Add Student</a>
                  
                </h3>
              </div>
              <!-- /.card-header -->

              <div class="card-body">
                <form id="myForm" method="GET" action="{{route('students.class.year.wise')}}">
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="year">Year <font style="color:red;">*</font></label>
                      <select class="form-control form-control-sm" name="year_id">
                        <option value="">Select Year</option>
                        @foreach($years as $year)
                        <option value="{{$year->id}}" {{(@$year_id == $year->id)?"selected":""}}>{{$year->name}}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group col-md-4">
                      <label for="class">Class <font style="color:red;">*</font></label>
                      <select class="form-control form-control-sm" name="class_id">
                        <option value="">Select Class</option>
                        @foreach($classes as $class)
                        <option value="{{$class->id}}" {{(@$class_id == $class->id)?"selected":""}}>{{$class->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                    <button type="submit" name="search" class="btn btn-primary btn-sm" style="margin-top: 32px;">Search</button>
                  </div>
                  </div>

                </form>
              </div>


              <div class="card-body">
                @if(!@$search)
                <table id="example1" class="table table-striped table-bordered table-hover">
                  <thead>
                  <tr>
                    <th width="5%">SL. </th>
                    <th>Name</th>
                    <th>ID No</th>
                    <th>Roll</th>
                    <th>Year</th>
                    <th>Class</th>
                    @if(Auth::user()->role == "admin")
                    <th>Code</th>
                    @endif
                    <th>Image</th>
                    
                    <th >Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($allData as $key => $value)

                  <tr>
                    @if(isset($value['student']))
                    <td>{{$key + 1}}</td>
                    <td>{{ $value['student']['name'] }}</td>
                    <td>{{ $value['student']['id_no'] }}</td>
                    <td>{{ $value->roll}}</td>
                    <td>{{ $value['year']['name'] }}</td>
                    <td>{{ $value['student_class']['name'] }}</td>
                    @if(Auth::user()->role == "admin")
                    <td>{{$value['student']['code']}}</td>
                    @endif
                    @endif
                    <td><img class="img-circle" width="100px" height="100px" src="{{ (!empty($value['student']['image'])?url('public/upload/students_images/'.$value['student']['image']):url('public/upload/no_image.png')) }}">
                    <td>
                      @if(Auth::User()->usertype == "admin")
                      <a title="Edit" class="btn btn-primary" href="{{route('students.registration.edit',$value->student_id)}}"><i class="fa fa-edit"></i></a>
                      <a title="Promotion" class="btn btn-success" href="{{route('students.promotion',$value->student_id)}}"><i class="fa fa-check"></i></a>
                      <a target="_blank" title="Details" class="btn btn-info" href="{{route('students.details',$value->student_id)}}"><i class="fa fa-eye"></i></a>
                      @endif
                    </td>
                  </tr>

                  @endforeach
                  </tbody>
                </table>
                @else
                <table id="example1" class="table table-striped table-bordered table-hover">
                  <thead>
                  <tr>
                    <th width="5%">SL. </th>
                    <th>Name</th>
                    <th>ID No</th>
                    <th>Roll</th>
                    <th>Year</th>
                    <th>Class</th>
                    @if(Auth::user()->role == "admin")
                    <th>Code</th>
                    @endif
                    <th>Image</th>
                    
                    <th >Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($allData as $key => $value)
                  <tr>
                    @if(isset($value['student']))
                    <td>{{$key + 1}}</td>
                    <td>{{ $value['student']['name'] }}</td>
                    <td>{{ $value['student']['id_no'] }}</td>
                    <td>{{ $value->roll}}</td>
                    <td>{{ $value['year']['name'] }}</td>
                    <td>{{ $value['student_class']['name'] }}</td>
                    @if(Auth::user()->role == "admin")
                    <td>{{$value['student']['code']}}</td>
                    @endif
                    @endif
                    <td><img class="img-circle" width="100px" height="100px" src="{{ (!empty($value['student']['image'])?url('public/upload/students_images/'.$value['student']['image']):url('public/upload/no_image.png')) }}">
                    <td>
                      @if(Auth::User()->usertype == "admin")
                      <a title="Edit" class="btn btn-primary" href="{{route('students.registration.edit',$value->student_id)}}"><i class="fa fa-edit"></i></a>
                      <a title="Promotion" class="btn btn-success" href="{{route('students.promotion',$value->student_id)}}"><i class="fa fa-check"></i></a>
                      <a target="_blank" title="Details" class="btn btn-info" href="{{route('students.details',$value->student_id)}}"><i class="fa fa-eye"></i></a>
                      @endif
                    </td>
                  </tr>

                  @endforeach
                  </tbody>
                </table>
                @endif
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
    function yearDataDelete(id){
        if(confirm('Are You Sure Want to Delete student Class ')){
            document.getElementById('year-formdata-'+id).submit();
        }
    }
  </script>

  <script>

$(function () {
 
  $('#myForm').validate({
    rules: {
      year_id: {
        required: true,
      },
      class_id: {
        required: true,
      },
      
    },
    messages: {
      year_id: {
        required: "Please enter year",
        
      },
      class_id: {
        required: "Please enter  class",
        
      },
      terms: "Please accept our terms"
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>
@endsection
