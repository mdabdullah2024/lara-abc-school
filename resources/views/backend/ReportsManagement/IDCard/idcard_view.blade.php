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
                <h3>Student ID Card Generate

                </h3>
              </div>
              <!-- /.card-header -->
              <div class="content">
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header">
                        <h4 class="card-title">
                          Select Criteria
                        </h4>
                      </div>
                      <div class="card-body">
                        <form method="POST" action="{{route('student.idcard.reports.getidcard')}}" id="myForm" target="_blank">
                          @csrf
                          <div class="form-row">
                            <div class="form-group col-md-3">
                              <label>Year</label>
                              <select name="year_id" id="year_id" class="form-control form-control-sm">
                                <option value="">Select Year</option>
                                @foreach($years as $year)
                                <option value="{{$year->id}}">{{$year->name}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="form-group col-md-3">
                              <label>Class</label>
                              <select name="class_id" id="class_id" class="form-control form-control-sm">
                                <option value="">Select class</option>
                                @foreach($classes as $class)
                                <option value="{{$class->id}}">{{$class->name}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="form-group col-md-3">
                              <button style="margin-top:31px;" type="submit" id="search" class="btn btn-success btn-sm">Search</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
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
