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
             Edit Employee Leave
             @else
             Add Employee Leave
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
                    <a class="btn btn-success float-right btn-sm text-light" href="{{ route('employees.leave.index') }}"><i class="fa fa-list"></i> Employee Leave List</a>
                </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="userdata" action="{{(@$editData)?route('employees.leave.update',$editData->id):route('employees.leave.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                @if(@$editData)
                @method('put')

                @endif
                <div class="card-body">
                  <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="name">Employee Name</label>
                    <select id="employee_id" type="text" name="employee_id" class="form-control form-control-sm" id="">
                      <option value=""> Select Employee</option>
                      @foreach($employee as $key => $value)
                      <option value="{{ $value->id }}" {{ (@$editData)?'selected':'' }}>{{$value->name}}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group col-md-6">
                    <label for="name">Start Date</label>
                    <input type="text" name="start_date" class="form-control form-control-sm singledatepicker" autocomplete="off" value="{{@$editData->start_date}}" >
                  </div>
                  <div class="form-group col-md-6">
                    <label for="name">Leave Purpose</label>
                    <select id="leave_purpose_id" name="leave_purpose_id" class="form-control form-control-sm" id="">
                      <option value=""> Select Leave Purpose</option>
                      @foreach($leave_purpose as $key => $value)
                      <option value="{{ $value->id }}"{{ (@$editData)?'selected':'' }}>{{$value->name}}</option>
                      @endforeach
                      <option value="0">New Purpose</option>
                    </select>
                    <input type="text" name="name" id="add_others" class="form-control form-control-sm" style="display: none;">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="name">End Date</label>
                    <input type="text" name="end_date" class="form-control form-control-sm singledatepicker" autocomplete="off" value="{{@$editData->end_date}}">
                  </div>
                  

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">{{ (@$editData)?'Update':'Submit' }}</button>
                </div>
                </div>
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
@endsection