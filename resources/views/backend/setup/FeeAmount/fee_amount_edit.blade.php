@extends('backend.layouts.master')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> 
             
             Edit Fee Amount
              
              
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Setup Fee Amount</li>
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
                    <a class="btn btn-success float-right btn-sm text-light" href="{{ route('setup.fee.amount.index') }}"><i class="fa fa-list"></i> Fee Category List</a>
                </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <div class="card-body">
              <form id="formdata" action="{{ route('setup.fee.amount.update',$editData[0]->fee_category_id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                    <div class="add_item">
                    <div class="form-row">
                      <div class="form-group col-md-12">
                        <label>Fee Category</label>
                        <select name="fee_category_id" class="form-control">
                          <option value="">Select Fee Category</option>
                          @foreach($fee_category as $category)  
                           <option value="{{$category->id}}" {{($editData[0]->fee_category_id==$category->id)?"selected":""}}>{{$category->name}}</option>
                           @endforeach
                        </select>
                      </div>
                    </div>
                    @foreach($editData as $edit)
                      <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                        <div class="form-row " >
                          <div class="form-group col-md-5" >
                            <label>Class</label>
                            <select name="class_id[]" class="form-control">  
                               <option value="">Select Class</option>
                               @foreach($student_classes as $class)  
                               <option value="{{$class->id}}" {{($edit->class_id == $class->id?"selected":"")}}>{{$class->name}}</option>
                               @endforeach
                            </select>
                          </div>
                          <div class="form-group col-md-5" >
                            <label>Amount</label>
                            <input type="number" name="amount[]" class="form-control" value="{{$edit->amount}}">
                          </div>

                          <div class="  form-group d-flex  col-md-1" style="margin-left: 0px;padding-left: 0px; padding-top:30px;">
                            <div class="form-row">
                            <span class=" btn btn-outline-success addeventmore"><i class="  fa fa-plus-circle "></i></span>
                            <span class=" btn btn-outline-danger removeeventmore"><i class="  fa fa-minus-circle "></i></span>
                            </div>
                          </div>

                        </div>
                      </div>
                    @endforeach
                  </div>

                  <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
                  </form>
                  </div>
                  
                </div>
            </div>
            <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<div style="visibility: hidden;">
  <div class="whole_extra_item_add" id="whole_extra_item_add">
    <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
      <div class="form-row">
        <div class="form-group col-md-5">
          <label>Class</label>
          <select name="class_id[]" class="form-control">  
             <option value="">Select Class</option>
             @foreach($student_classes as $class)  
             <option value="{{$class->id}}">{{$class->name}}</option>
             @endforeach
          </select>
        </div>
        <div class="form-group col-md-5">
          <label>Amount</label>
          <input type="number" name="amount[]" class="form-control">
        </div>
          
          <div class="form-group d-flex col-md-1 " style="margin-left: 0px;padding-left: 0px;  padding-top:30px;">
            <div class="form-row">
              <span class=" btn btn-outline-success addeventmore"><i class="  fa fa-plus-circle "></i></span>
          <span class=" btn btn-outline-success removeeventmore"><i class="  fa fa-minus-circle "></i></span>
        </div>
      </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
     var counter = 0;
     $(document).on("click",".addeventmore", function(){
      var whole_extra_item_add = $("#whole_extra_item_add").html();
      $(this).closest(".add_item").append(whole_extra_item_add);
      counter++;
     });
     $(document).on("click",".removeeventmore",function(event){
      $(this).closest(".delete_whole_extra_item_add").remove();
      counter -= 1;
     });
  });
</script>
<script>

$(function () {
 
  $('#formdata').validate({
    rules: {
      "fee_category_id": {
        required: true,
        
      },
      "class_id[]": {
        required: true,
        
      },
      "amount[]": {
        required: true,
      },
      
    },
    messages: {
      
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