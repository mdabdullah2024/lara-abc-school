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
             Edit Employee Account Salary
             @else
             Add Employee Account Salary
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
                  Employee Account Salary
                    <a class="btn btn-success float-right btn-sm text-light" href="{{ route('employee.accounts.fee.index') }}"><i class="fa fa-list"></i> Employee Account Salary List</a>
                </h3>
              </div>
            </div>
            <!-- /.card -->
            </div>
              <div class="card-body " style="margin: 0px 40px;">
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="date">Date</label>
                    <input type="text" name="date" id="date" class="form-control form-control-sm singledatepicker" autocomplete="off" placeholder="DD-MM-YYYY">
                  </div>
                  <div class="form-group col-md-6">
                    <a id="search" name="search" class="btn btn-primary btn-sm" style="    margin-top: 31px;">Search</a>
                  </div>
                </div>
              </div>
              <br><br>
              <div class="card-body">
                <div id="DocumentResults"></div>
                <script id="document-template" type="text/x-handlebars-template">
                  <form action="{{route('employee.accounts.fee.store')}}" method="post">
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
      var date = $('#date').val();
      $('.notifyjs-corner').html('');
      if (date=='') {
        $.notify("date required",{globalPosition: 'top right',className:'error'});
        return false;
      }
      $.ajax({
        url: "{{route('employee.accounts.fee.getemployee')}}",
        type:"get",
        data:{'date':date},
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