@extends('backend.layouts.master')
@section('content')

<style type="text/css">
  .switch-toggle{
    width: auto;
  }
  .switch-toggle label:not(.disabled){cursor: pointer;}
  .switch-candy a{border:1px solid #333;border-radius: 3px;box-shadow: 0 1px 1px rgba(0, 0, 0, 0.2),inset 0 1px 1px rgba(255, 255, 255, .45);background-color: #fff;background-image: -webkit-linear-gradient(top,rgba(255,255,255,.2),transparent);background-image: linear-gradient(to bottom,rgba(255,255,255,.2),transparent);color:#fff;}
  .switch-toggle.switch-candy, .switch-light.switch-candy>span {
    background-color: #5a6268;
    color:#fff;
    border-radius: 3px;
    box-shadow:inset 0 2px  6px rgba(0,0,0,.3),0 1px 0 rgba(255,255,255,.2);
  }
</style>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> 
             @if(isset($editData))
             Edit Employee Attendance
             @else
             Add Employee Attendance
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
                    <a class="btn btn-success float-right btn-sm text-light" href="{{ route('employees.attendance.index') }}"><i class="fa fa-list"></i> Employee Attendance List</a>
                </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="myForm" action="{{route('employees.attendance.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                @if(isset($editData))
                <div class="card-body">
                  <div class="form-group col-md-4">
                    <label for="name">Employee Name</label>
                    <input type="text" name="date" class="form-control form-control-sm checkdate" autocomplete="off" value="{{$editData['0']['date']}}" readonly>
                  </div>
                  <table class="table table-striped table-bordered dt-responsive" style="width:100%">
                    <thead>
                      <tr>
                        <th rowspan="2" class="text-center" style="vertical-align: middle;">SL.</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle;">Employee Name</th>
                        <th colspan="3" class="text-center" style="vertical-align: middle;width: 25%;">Attendace Status</th>
                      </tr>
                      <tr>
                        <th class="text-center present_all btn " style="display:table-cell;background-color: #114190; color: #fff;">Present</th>
                        <th class="text-center leave_all btn " style="display:table-cell;background-color: #114190; color: #fff;">Leave</th>
                        <th class="text-center absent_all btn " style="display:table-cell;background-color: #114190; color: #fff; ">Absent</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($editData as $key => $employee)
                      <tr class="text-center" id="div{{$employee->id}}">
                        <input type="hidden" name="employee_id[]" value="{{$employee->employee_id}}" class="employee_id">
                        <td>{{$key+1}}</td>
                        <td>{{$employee['employee']['name']}}</td>
                        <td colspan="3" class="text-left">
                          <div class="switch-toggle switch-3 switch-candy">
                            <input type="radio" id="present{{$key}}" class="present" name="attend_status{{$key}}" value="Present" {{($employee->attend_status=='Present')?'checked':''}}>
                            <label for="present{{$key}}">Present</label>

                            <input type="radio" id="leave{{$key}}" class="leave" name="attend_status{{$key}}" value="Leave" {{($employee->attend_status=='Leave')?'checked':''}} >
                            <label for="leave{{$key}}">Leave</label>

                            <input type="radio" id="absent{{$key}}" class="absent" name="attend_status{{$key}}" value="Absent" {{($employee->attend_status=='Absent')?'checked':''}}>
                            <label for="absent{{$key}}">Absent</label>
                            <a></a>
                          </div>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <div class="card-footer">
                  <button type="submit" class="btn btn-primary">{{ (@$editData)?'Update':'Submit' }}</button>
                </div>
                </div>
                @else
                <div class="card-body">
                  <div class="form-group col-md-6">
                    <label for="name">Employee Name</label>
                    <input type="text" name="date" id="date" class="form-control form-control-sm singledatepicker checkdate" autocomplete="off" placeholder="Attendance Date" >
                  </div>
                  <table class="table table-striped table-bordered dt-responsive" style="width:100%">
                    <thead>
                      <tr>
                        <th rowspan="2" class="text-center" style="vertical-align: middle;">SL.</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle;">Employee Name</th>
                        <th colspan="3" class="text-center" style="vertical-align: middle;width: 25%;">Attendace Status</th>
                      </tr>
                      <tr>
                        <th class="text-center present_all btn " style="display:table-cell;background-color: #114190; color: #fff;">Present</th>
                        <th class="text-center leave_all btn " style="display:table-cell;background-color: #114190; color: #fff;">Leave</th>
                        <th class="text-center absent_all btn " style="display:table-cell;background-color: #114190; color: #fff; ">Absent</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($employee as $key => $employee)
                      <tr class="text-center" id="div{{$employee->id}}">
                        <input type="hidden" name="employee_id[]" value="{{$employee->id}}" class="employee_id">
                        <td>{{$key+1}}</td>
                        <td>{{$employee->name}}</td>
                        <td colspan="3" class="text-left">
                          <div class="switch-toggle switch-3 switch-candy">
                            <input type="radio" class="present" name="attend_status{{$key}}" value="Present" checked="checked">
                            <label for="present{{$key}}">Present</label>

                            <input type="radio" class="leave" name="attend_status{{$key}}" value="Leave" >
                            <label for="leave{{$key}}">Leave</label>

                            <input type="radio" class="absent" name="attend_status{{$key}}" value="Absent" >
                            <label for="absent{{$key}}">Absent</label>
                            <a></a>
                          </div>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">{{ (@$editData)?'Update':'Submit' }}</button>
                </div>
                </div>
                
                 @endif
                 
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<script type="text/javascript">
  $(document).ready(function(){
     $(document).on('change','#leave_purpose_id',function(){
      var leave_purpose_id = $(this).val();
      if(leave_purpose_id=='0'){
        $('#add_others').show();
      }else{
        $('#add_others').hide();
      }
     });
  });
</script>
<script>

$(function () {
 
  $('#myForm').validate({
    rules: {
      date: {
        required: true,
      },
    },
    messages: {
      date: {
        required: "Please enter date",
        
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
<script type="text/javascript">
  $(document).on('click','.present',function(){
    $(this).parents('tr').find('.datetime').css('pointer-events','none').css('background-color','#dee2e6').css('color','#495057');
  });


  $(document).on('click','.leave',function(){
    $(this).parents('tr').find('.datetime').css('pointer-events','').css('background-color','#fff').css('color','#495057');
  });

  $(document).on('click','.absent',function(){
    $(this).parents('tr').find('.datetime').css('pointer-events','none').css('background-color','#dee2e6').css('color','#495057');
  });

</script>

<script type="text/javascript">

  $(document).on('click','.present_all',function(){
    $("input[value=Present]").prop('checked',true);
    $('.datetime').css('pointer-events','none').css('background-color','#dee2e6').css('color','#495057');
  });

$(document).on('click','.leave_all',function(){
    $("input[value=Leave]").prop('checked',true);
    $('.datetime').css('pointer-events','none').css('background-color','#fff').css('color','#495057');
  });

$(document).on('click','.absent_all',function(){
    $("input[value=Absent]").prop('checked',true);
    $('.datetime').css('pointer-events','none').css('background-color','#dee2e6').css('color','#dee2e6');
  });
</script>
@endsection