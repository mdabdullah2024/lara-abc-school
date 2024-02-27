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
              <li class="breadcrumb-item"><a href="#">Manage Marks Entry</a></li>
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
                <h3>Student Marks Entry
                </h3>
              </div>
              <!-- /.card-header -->

              <div class="card-body">
                <form id="rollForm" method="POST" action="{{route('marks.entry.store')}}">
                  @csrf
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

                    <div class="form-group col-md-4">
                      <label >Subject <font style="color:red;">*</font></label>
                      <select id="assign_subject_id"  class="form-control form-control-sm" name="assign_subject_id">
                        <option value="">Select Subject</option>
                      </select>
                    </div>
                     <div class="form-group col-md-4">
                      <label for="exam">Exam Types <font style="color:red;">*</font></label>
                      <select id="exam_type_id" class="form-control form-control-sm" name="exam_type_id">
                        <option value="">Select exam</option>
                        @foreach($exam_types as $exam)
                        <option value="{{$exam->id}}">{{$exam->name}}</option>
                        @endforeach
                      </select>
                    </div>
                      <div class="form-group col-md-4 " >
                      <a style="margin-top:32px;" id="search" class="btn btn-info btn-sm" >Search</a>
                    </div>
                  </div><br>
                    <div class="row d-none" id="marks-entry">
                       <div class="col-md-12">
                         <table class="table table-bordered table-striped dt-responsive" style="width:100%;">
                           <thead>
                             <tr>
                               <th>ID No</th>
                               <th>Student Name</th>
                               <th>Father's Name</th>
                               <th>Gender</th>
                               <th>Marks</th>
                             </tr>
                           </thead>
                           <tbody id="marks-entry-tr">
                            
                           </tbody>
                         </table>
                       </div>
                    </div>
                    <button type="submit" class="btn btn-success btn-sm">Marks Entry</button>
                </form>
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
 
  $('#rollForm').validate({
    rules: {
      "marks[]": {
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
      var year_id = $('#year_id').val();
      var class_id = $('#class_id').val();
      var class_id = $('#class_id').val();
      var exam_type_id = $('#exam_type_id').val();
      var assign_subject_id = $('#assign_subject_id').val();
      $('.notifyjs-corner').html('');
      if (year_id=='') {
        $.notify("Year required",{globalPosition: 'top right',className:'error'});
        return false;
      }
      if (class_id=='') {
        $.notify("Class required",{globalPosition: 'top right',className:'error'});
        return false;
      }

      if (assign_subject_id=='') {
        $.notify("Subject required",{globalPosition: 'top right',className:'error'});
        return false;
      }
      if (exam_type_id=='') {
        $.notify("Exam required",{globalPosition: 'top right',className:'error'});
        return false;
      }
      $.ajax({
        url: "{{route('get.student.search')}}",
        type:"GET",
        data:{'year_id':year_id,'class_id':class_id},
        success:function(data){
          $('#marks-entry').removeClass('d-none');
          var html = '';
          $.each(data,function(key,v){
            html +=
            '<tr>'+ 
              '<td>'+v.student.id_no+'<input type="hidden" name="student_id[]" value="'+v.student_id+'" ><input type="hidden" name="id_no[]" value="'+v.student.id_no+'" ></td>'+
              '<td>'+v.student.name+'</td>'+
              '<td>'+v.student.fname+'</td>'+
              '<td>'+v.student.gender +'</td>'+
              '<td><input type="text" class="form-control form-control-sm" name="marks[]" value=""></td>'+
            '</tr>';
          });

          html = $('#marks-entry-tr').html(html);
        }
      });
    });
  </script>
  <script type="text/javascript">
    $(function(){
         $(document).on('change','#class_id',function(){
          var class_id =$('#class_id').val();
          $.ajax({
            url:"{{route('get.student.subject')}}",
            type:"get",
            data:{'class_id':class_id},
            success:function(data){
              var html= '<option value="">Select Subject</option>';
          $.each(data,function(key,v){
            html +='<option value="'+v.id+'">'+v.subject.name+'</option>';
          });
          $('#assign_subject_id').html(html);
        }
      });
         });
    });
  </script>


      
@endsection
