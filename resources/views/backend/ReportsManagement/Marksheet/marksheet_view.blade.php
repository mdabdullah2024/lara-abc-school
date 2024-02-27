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
                <h3>Student Marksheet

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
                        <form method="POST" action="{{route('report.marksheet.get')}}" id="myForm" target="_blank">
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
                              <label>Exam Types</label>
                              <select name="exam_type_id" id="exam_type_id" class="form-control form-control-sm">
                                <option value="">Select Exam Types</option>
                                @foreach($exam_types as $exam)
                                <option value="{{$exam->id}}">{{$exam->name}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="form-group col-md-3">
                              <label>ID No</label>
                              <input type="text" name="id_no" class="form-control form-control-sm" id="id_no" placeholder="ID No">
                            </div>
                            <div class="form-group col-md-3">
                              <button type="submit" id="search" class="btn btn-success btn-sm">Search</button>
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
      exam_type_id: {
        required: true,
      },
      id_no: {
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
   <script type="text/javascript">
    $(document).on('click','#search',function(){
      var start_date = $('#start_date').val();
      var end_date = $('#end_date').val();
      $('.notifyjs-corner').html('');
      if ( start_date =='') {
        $.notify("Start Date required",{globalPosition: 'top right',className:'error'});
        return false;
      }
      if ( end_date =='') {
        $.notify("End Date required",{globalPosition: 'top right',className:'error'});
        return false;
      }
      $.ajax({
        url:"{{route('report.profit.dwise.get')}}",
        type:"GET",
        data:{'start_date': start_date,'end_date':end_date},
        beforeSend: function() {
        },
        success: function(data) {
          var source = $('#document-template').html();
          var template = Handlebars.compile(source);
          var html = template(data);
          $('#DocumentResults').html(html); 
          $('[data-toggle="tooltip"]').tooltip();
        }
      });
    });
  </script>
@endsection
