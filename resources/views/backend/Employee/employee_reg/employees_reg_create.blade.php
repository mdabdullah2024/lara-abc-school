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
             Edit Employee
             @else
             Add Employee
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
                    <a class="btn btn-success float-right btn-sm text-light" href="{{ route('employees.registration.index') }}"><i class="fa fa-list"></i> Employee List</a>
                </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="student-data" action="{{ (@$editData)?route('employees.registration.update',$editData->id):route('employees.registration.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                
                @if(isset($editData))
                @method('put')
              
                @endif
                <div class="card-body">
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="name">Employee Name <font style="color:red;">*</font></label>
                      <input id="name" type="text" name="name" class="form-control form-control-sm" id="" value="{{ (@$editData)? $editData->name:''}}">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="fname">Father's Name <font style="color:red;">*</font></label>
                      <input id="fname" type="text" name="fname" class="form-control form-control-sm" id="" value="{{ (@$editData)? $editData->fname:''}}">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="mname">Mother's Name <font style="color:red;">*</font></label>
                      <input id="mname" type="text" name="mname" class="form-control form-control-sm" id="" value="{{ (@$editData)? $editData->mname:''}}">
                    </div>

                    <div class="form-group col-md-4">
                      <label for="mobile">Mobile No. <font style="color:red;">*</font></label>
                      <input id="mobile" type="text" name="mobile" class="form-control form-control-sm" id="" value="{{ (@$editData)? $editData->mobile:''}}">
                    </div>

                    <div class="form-group col-md-4">
                      <label for="address">Address <font style="color:red;">*</font></label>
                      <input id="address" type="text" name="address" class="form-control form-control-sm" id="" value="{{ (@$editData)? $editData->address:''}}">
                    </div>

                    <div class="form-group col-md-4">
                      <label for="gender">Gender <font style="color:red;">*</font></label>
                      <select class="form-control form-control-sm" name="gender">
                        <option value="">Select Gender</option>
                        <option value="Male" {{(@$editData->gender == 'Male')?'selected':''}} >Male</option>
                        <option value="Female" {{(@$editData->gender == 'Female')?'selected':''}} >Female</option>
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="religion">Religion <font style="color:red;">*</font></label>
                      <select class="form-control form-control-sm" name="religion">
                        <option value="">Select Religion</option>
                        <option value="Islam" {{(@$editData->religion == 'Islam')?'selected':''}}  >Islam</option>
                        <option value="Hinduism" {{(@$editData->religion == 'Hinduism')?'selected':''}} >Hinduism</option>
                        <option value="Cristianity" {{(@$editData->religion == 'Cristianity')?'selected':''}}>Cristian</option>
                      </select>
                    </div>
                      <div class="form-group col-md-4">
                        <label for="dob">Date Of Birth <font style="color:red;">*</font></label>
                        <input type="text" id="demo" name="dob"   class="form-control form-control-sm singledatepicker" value="{{ (@$editData)?$editData->dob:'' }}" autocomplete="off" />
                    </div>

                    <div class="form-group col-md-4">
                    <label for="Designation">Designation</label>
                    <select id="designation"  name="designation_id" class="form-control form-control-sm">
                      <option>Select Designation</option>
                      @foreach($designations as $value)
                      <option value="{{$value->id}}" {{(@$editData->designation_id == $value->id)?"selected":""}}>{{$value->name}}</option>
                      @endforeach
                    </select>
                  </div>

                    @if(!@$editData)
                      <div class="form-group col-md-3">
                        <label for="join_date">Join Date <font style="color:red;">*</font></label>
                        <input type="text" id="demo" name="join_date"   class="form-control form-control-sm singledatepicker" value="{{ (@$editData)?$editData->join_date:'' }}" autocomplete="off" />
                    </div>

                    <div class="form-group col-md-3">
                      <label for="salary">Salary</label>
                      <input id="salary" type="text" name="salary" class="form-control form-control-sm" id="" value="{{ (@$editData)? $editData->salary:''}}">
                    </div>

                    @endif

                  <div class="form-group col-md-4">
                    <label for="image">image</label>
                    <input id="image" type="file" name="image" class="form-control form-control-sm" placeholder="Select Your Image">
                    <font style="color:red;">{{($errors->has('image'))?($errors->first('image')):""}}</font>
                  </div>

                  <div class="form-group col-md-2">
                    
                    <img id="ImageShow" style="border:1px solid rgba(0, 0, 0,.2);width: 100px ; height: 110px;"  src="{{ (!empty($editData->image)?url('public/upload/employees_images/'.$editData->image):url('public/upload/no_image.png')) }}">
                </div>

                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">{{ (@$editData)?'Update':'Submit' }}</button>
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
      join_date: {
        required: true,
        
      },


      salary: {
        required: true,
        
      },
      designation: {
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