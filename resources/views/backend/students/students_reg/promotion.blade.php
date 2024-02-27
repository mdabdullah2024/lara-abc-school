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
             Promotion Edit
             @else
             Add Student
             @endif
              
              
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Students</li>
            </ol>
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
                    <a class="btn btn-success float-right btn-sm text-light" href="{{ route('students.registration.index') }}"><i class="fa fa-list"></i> Students List</a>
                </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="student-data" action="{{route('students.promotion',$editData->student_id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{@$editData->id}}">
                @if(isset($editData))
                @method('put')
              
                @endif
                <div class="card-body">
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="name">Student Name <font style="color:red;">*</font></label>
                      <input id="name" type="text" name="name" class="form-control form-control-sm" id="" value="{{ (@$editData)? $editData['student']['name']:''}}">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="fname">Father's Name <font style="color:red;">*</font></label>
                      <input id="fname" type="text" name="fname" class="form-control form-control-sm" id="" value="{{ (@$editData)? $editData['student']['fname']:''}}">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="mname">Mother's Name <font style="color:red;">*</font></label>
                      <input id="mname" type="text" name="mname" class="form-control form-control-sm" id="" value="{{ (@$editData)? $editData['student']['mname']:''}}">
                    </div>

                    <div class="form-group col-md-4">
                      <label for="mobile">Mobile No. <font style="color:red;">*</font></label>
                      <input id="mobile" type="text" name="mobile" class="form-control form-control-sm" id="" value="{{ (@$editData)? $editData['student']['mobile']:''}}">
                    </div>

                    <div class="form-group col-md-4">
                      <label for="address">Address <font style="color:red;">*</font></label>
                      <input id="address" type="text" name="address" class="form-control form-control-sm" id="" value="{{ (@$editData)? $editData['student']['address']:''}}">
                    </div>

                    <div class="form-group col-md-4">
                      <label for="gender">Gender <font style="color:red;">*</font></label>
                      <select class="form-control form-control-sm" name="gender">
                        <option value="">Select Gender</option>
                        <option value="Male" {{(@$editData['student']['gender'] == 'Male')?'selected':''}} >Male</option>
                        <option value="Female" {{(@$editData['student']['gender'] == 'Female')?'selected':''}} >Female</option>
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="religion">Religion <font style="color:red;">*</font></label>
                      <select class="form-control form-control-sm" name="religion">
                        <option value="">Select Religion</option>
                        <option value="Islam" {{(@$editData['student']['religion'] == 'Islam')?'selected':''}}  >Islam</option>
                        <option value="Hinduism" {{(@$editData['student']['religion'] == 'Hinduism')?'selected':''}} >Hinduism</option>
                        <option value="Cristianity" {{(@$editData['student']['religion'] == 'Cristianity')?'selected':''}}>Cristian</option>
                      </select>
                    </div>
                      <div class="form-group col-md-4">
                        <label for="dob">Date Of Birth <font style="color:red;">*</font></label>
                        <input type="text" id="demo" name="dob"   class="form-control form-control-sm singledatepicker" value="{{ (@$editData)?$editData['student']['dob']:'' }}" autocomplete="off" />
                    </div>
                    <div class="form-group col-md-4">
                      <label for="discount">Discount</label>
                      <input id="discount" type="text" name="discount" class="form-control form-control-sm" id="" value="{{ (@$editData)? $editData['discount']['discount']:''}}">
                    </div>
                    
                      <div class="form-group col-md-4">
                      <label for="year">Year <font style="color:red;">*</font></label>
                      <select class="form-control form-control-sm" name="year_id">
                        <option value="">Select Year</option>
                        @foreach($years as $year)
                        <option value="{{$year->id}}" {{(@$editData->year_id == $year->id)?"selected":""}}>{{$year->name}}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group col-md-4">
                      <label for="class">Class <font style="color:red;">*</font></label>
                      <select class="form-control form-control-sm" name="class_id">
                        <option value="">Select Class</option>
                        @foreach($classes as $class)
                        <option value="{{$class->id}}" {{(@$editData->class_id == $class->id)?"selected":""}}> {{$class->name}}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group col-md-4">
                      <label for="group">Group</label>
                      <select class="form-control form-control-sm" name="group_id">
                        <option value="">Select Group</option>
                        @foreach($groups as $group)
                        <option value="{{$group->id}}" {{(@$editData->group_id == $group->id)?"selected":""}}>{{$group->name}}</option>
                        @endforeach
                      </select>
                    </div>

                      <div class="form-group col-md-4">
                      <label for="shift">Shift</label>
                      <select class="form-control form-control-sm" name="shift_id">
                        <option value="">Select Shift</option>
                        @foreach($shifts as $shift)
                        <option value="{{$shift->id}}" {{(@$editData->shift_id == $shift->id)?"selected":""}}>{{$shift->name}}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group col-md-4">
                    <label for="image">image</label>
                    <input id="image" type="file" name="image" class="form-control form-control-sm" placeholder="Select Your Image">
                    <font style="color:red;">{{($errors->has('image'))?($errors->first('image')):""}}</font>
                  </div>
                  <div class="form-group col-md-4">
                    
                    <img id="ImageShow" style="border:1px solid rgba(0, 0, 0,.2);width: 100px ; height: 110px;"  src="{{ (!empty($editData['student']['image'])?url('public/upload/students_images/'.$editData['student']['image']):url('public/upload/no_image.png')) }}">
                </div>

                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">{{ (@$editData)?'Promotion':'Submit' }}</button>
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
 
  $('#student-data').validate({
    rules: {
      name: {
        required: true,
      },
      fname: {
        required: true,
      },
      mname: {
        required: true,
        
      },
      mobile: {
        required: true,
        
      },
      address: {
        required: true,
      },

      religion: {
        required: true,
        
      },
      gender: {
        required: true,
        
      },
      "dob": {
        required: true,
        
      },
      discount: {
        required: true,
        
      },


      year_id: {
        required: true,
        
      },
      class_id: {
        required: true,
        
      },
      
    },
    messages: {
      name: {
        required: "Please enter name",
        
      },
      fname: {
        required: "Please enter Fathers name",
        
      },
      mname: {
        required: "Please enter Mothers name",
        
      },

      mobile: {
        required: "Please enter Mobile Number",
        
      },

      address: {
        required: "Please enter Address ",
        
      },
      gender: {
        required: "Please Select Gender ",
        
      },

      religion: {
        required: "Please Select Religion ",
        
      },
      dob: {
        required: "Please Select Date Of Birth",
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