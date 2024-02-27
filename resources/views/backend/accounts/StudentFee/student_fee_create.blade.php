@extends('backend.layouts.master')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> 
             @if(isset($editData))
             Edit Student Account fee
             @else
             Add Student Account fee
             @endif
              
              
            </h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-light">
              <div class="card-header">
                <h3>
                  Student Account Fee collection
                    <a class="btn btn-success float-right btn-sm text-light" href="{{ route('students.accounts.fee.index') }}"><i class="fa fa-list"></i> Employee Student Account Fee List</a>
                </h3>
              </div>
            </div>
            <!-- /.card -->
            </div>
              <div class="card-body">
                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label for="year_id">Select Year</label>
                    <select name="year_id" id="year_id" class="form-control form-control-sm">
                      <option value="">Select Year</option>
                      @foreach($years as $value)
                      <option value="{{$value->id}}">{{$value->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="class_id">Select Class</label>
                    <select name="class_id" id="class_id" class="form-control form-control-sm">
                      <option value="">Select Class</option>
                      @foreach($classes as $value)
                      <option value="{{$value->id}}">{{$value->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="fee_category_id">Select Fee Category</label>
                    <select name="fee_category_id" id="fee_category_id" class="form-control form-control-sm">
                      <option value="">Select Fee Category</option>
                      @foreach($fee_categories as $value)
                      <option value="{{$value->id}}">{{$value->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="date">Date</label>
                    <input type="text" name="date" id="date" class="form-control form-control-sm singledatepicker" autocomplete="off" placeholder="DD-MM-YYYY">
                  </div>
                  <div class="form-group col-md-3">
                    <a id="search" name="search" class="btn btn-primary btn-sm">Search</a>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div id="DocumentResults"></div>
                <script id="document-template" type="text/x-handlebars-template">
                  <form action="{{route('students.accounts.fee.store')}}" method="post">
                    @csrf
                    <table id="example2" class="table table-striped table-bordered table-hover">
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
                    <button type="submit" class="btn btn-primary btn-sm " style="margin-top:10px">Submit</button>
                  </form>
                </script>
              </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<script type="text/javascript">
    $(document).on('click','#search',function(){
      var year_id = $('#year_id').val();
      var class_id = $('#class_id').val();
      var fee_category_id = $('#fee_category_id').val();
      var date = $('#date').val();
      $('.notifyjs-corner').html('');
      if (year_id=='') {
        $.notify("Year required",{globalPosition: 'top right',className:'error'});
        return false;
      }
      if (class_id=='') {
        $.notify("Class required",{globalPosition: 'top right',className:'error'});
        return false;
      }

      if (fee_category_id=='') {
        $.notify("Fee Category required",{globalPosition: 'top right',className:'error'});
        return false;
      }
      if (date=='') {
        $.notify("date required",{globalPosition: 'top right',className:'error'});
        return false;
      }
      $.ajax({
        url: "{{route('students.accounts.fee.getStduent')}}",
        type:"get",
        data:{'year_id':year_id,'class_id':class_id,'fee_category_id':fee_category_id,'date':date},
        beforeSend:function(){

        },
        success:function(data){
          var source = $("#document-template").html();
          var template = Handlebars.compile(source);
          var html = template(data);
          $('#DocumentResults').html(html);
          $('[data-toggle="tooltip"]').tooltip();
        }
      });
    });
  </script>
@endsection