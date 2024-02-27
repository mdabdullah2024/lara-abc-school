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
                <h3>Monthly Profit

                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label class="control-label">Start Date </label>
                    <input type="text" name="start_date" id="start_date" class="form-control form-control-sm singledatepicker" autocomplete="off" placeholder="Start Date" readonly>
                  </div>
                  <div class="form-group col-md-4">
                    <label class="control-label">End Date </label>
                    <input type="text" name="end_date" id="end_date" class="form-control form-control-sm singledatepicker" autocomplete="off" placeholder="End Date" readonly>
                  </div>
                  <div class="form-group col-md-2">
                    <a class="btn btn-success btn-sm btn-block " name="search" id="search" style="margin-top:31px;color:white;">Search</a>
                  </div>
                </div>
              </div>
              <div class="card-body">
                  <div id="DocumentResults"></div>
                  <script id="document-template" type="text/x-handlebars-template">
                    <table class="table-sm table-bordered table-striped" style="width:100%">
                      <thead>
                      <tr class="text-center">
                        @{{{thsource}}}
                      </tr>
                      </thead>
                      <tbody>
                      <tr class="text-center">
                      @{{{tdsource}}}
                      </tr>
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
