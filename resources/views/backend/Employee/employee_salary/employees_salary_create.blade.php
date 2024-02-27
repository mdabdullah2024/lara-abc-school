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
             Employees increments
             @else
             Add Employee
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
                  Add Employee Salary increments
                    <a class="btn btn-success float-right btn-sm text-light" href="{{ route('employees.salary.index') }}"><i class="fa fa-list"></i> Employee Salary List</a>
                </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="student-data" action="{{ route('employees.salary.store',$editData->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card-body">
                <h5><strong>Name:</strong>{{$editData->name}}</h5>
                  <h5> <strong>ID:</strong>{{$editData->id_no}}</h5>
                  <div class="form-row">
                      <div class="form-group col-md-4">
                        <label for="effected_date">Effected Date <font style="color:red;">*</font></label>
                        <input type="text" id="demo" name="effected_date" placeholder="Date"   class="form-control form-control-sm singledatepicker"  autocomplete="off" />
                    </div>

                    <div class="form-group col-md-4">
                      <label for="salary">Incremented Salary Amount</label>
                      <input id="salary" type="text" name="increment_salary" class="form-control form-control-sm" id="">
                    </div>
                    <div class="form-group col-md-4">
                      <button style="margin-top:30px;" type="submit" class="btn-sm btn-dark">Submit</button>
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