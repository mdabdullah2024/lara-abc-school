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
             Edit Grade Point
             @else
             Add Grade Point
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
                    <a class="btn btn-success float-right btn-sm text-light" href="{{ route('marks.grade.index') }}"><i class="fa fa-list"></i> Employee Attendance List</a>
                </h3>
              </div>
              <form id="myForm" action="{{(@$editData)?route('marks.grade.update',$editData->id):route('marks.grade.store')}}" method="post">
                @csrf
                @if(@$editData)
                method('put')
                @endif
                <div class="card-body">
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label>Grade Name</label>
                      <input class="form-control form-control-sm" type="text" name="grade_name" value="{{@$editData->grade_name}}">
                    </div>
                    <div class="form-group col-md-4">
                      <label>Grade Point</label>
                      <input class="form-control form-control-sm" type="text" name="grade_point" value="{{@$editData->grade_point}}">
                    </div>
                    <div class="form-group col-md-4">
                      <label>Start Marks</label>
                      <input class="form-control form-control-sm" type="text" name="start_marks" value="{{@$editData->start_marks}}">
                    </div>
                    <div class="form-group col-md-4">
                      <label>End Marks</label>
                      <input class="form-control form-control-sm" type="text" name="end_marks" value="{{@$editData->end_marks}}">
                    </div>
                    <div class="form-group col-md-4">
                      <label>Start Point</label>
                      <input class="form-control form-control-sm" type="text" name="start_point" value="{{@$editData->start_point}}">
                    </div>
                    <div class="form-group col-md-4">
                      <label>End Point</label>
                      <input class="form-control form-control-sm" type="text" name="end_point" value="{{@$editData->end_point}}">
                    </div>
                    <div class="form-group col-md-4">
                      <label>Remarks</label>
                      <input class="form-control form-control-sm" type="text" name="remarks" value="{{@$editData->remarks}}">
                    </div>
                    <div class="form-group col-md-12"style="padding-top: 32px;">
                      <button type="submit" class="btn btn-success btn-sm" >{{(@$editData)?'Update':'Submit'}}</button>
                    </div>
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
<script>

$(function () {
 
  $('#myForm').validate({
    rules: {
      grade_name: {
        required: true,
      },
      grade_point: {
        required: true,
      },
      start_marks: {
        required: true,
      },
      end_marks: {
        required: true,
      },
      start_point: {
        required: true,
      },
      end_point: {
        required: true,
      },

      remarks: {
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

@endsection