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
              <li class="breadcrumb-item"><a href="#">Manage Student Registration Fee</a></li>
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
                <h3>Search Criteria
                </h3>
              </div>
              <!-- /.card-header -->

              <div class="card-body">
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="year">Year <font style="color:red;">*</font></label>
                      <select id="year_id" class="form-control form-control-sm" name="year_id">
                        <option value="">Select Year</option>
                        @foreach($years as $year)
                        <option value="{{$year->id}}">{{$year->name}}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group col-md-4">
                      <label for="class">Class <font style="color:red;">*</font></label>
                      <select id="class_id" class="form-control form-control-sm" name="class_id">
                        <option value="">Select Class</option>
                        @foreach($classes as $class)
                        <option value="{{$class->id}}">{{$class->name}}</option>
                        @endforeach
                      </select>
                    </div>
                      <div class="form-group col-md-4 " >
                      <a style="margin-top:32px;" id="search" class="btn btn-info btn-sm" >Search</a>
                    </div>
                  </div>
              </div>
              <div class="card-body">
                  <div id="DocumentResults"></div>
                  <script id="document-template" type="text/x-handlebars-template">
                    <table class="table-sm table-bordered table-striped" style="width:100%">

                      <thead>
                      <tr>
                        @{{{thsource}}}
                      </tr>
                      </thead>
                      <tbody>

                      @{{#each this}}
                      <tr>
                      @{{{tdsource}}}
                      </tr>
                      @{{/each}}
                      </tbody>
                    </table>
                  </script>
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
    <script type="text/javascript">
    $(document).on('click','#search',function(){
      var year_id = $('#year_id').val();
      var class_id = $('#class_id').val();
      $('.notifyjs-corner').html('');
      if (year_id=='') {
        $.notify("Year required",{globalPosition: 'top right',className:'error'});
        return false;
      }
      if (class_id=='') {
        $.notify("Class required",{globalPosition: 'top right',className:'error'});
        return false;
      }
      $.ajax({
        url:"{{route('students.reg-fee.get-student')}}",
        type:"get",
        data:{'year_id':year_id,'class_id':class_id},
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
