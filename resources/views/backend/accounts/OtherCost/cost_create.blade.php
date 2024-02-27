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
             Edit Other Cost
             @else
             Add Other Cost
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
                  Other Cost
                    <a class="btn btn-success float-right btn-sm text-light" href="{{ route('cost.fee.index') }}"><i class="fa fa-list"></i> Other Cost list</a>
                </h3>
              </div>
            </div>
            <!-- /.card -->
            <div class="card-body">
               <form method="post" action="{{(@$editData)?route('cost.fee.update',$editData->id):route('cost.fee.store')}}" id="myForm" enctype="multipart/form-data">
                @csrf
                @if(@$editData)
                 @method('put')
                @endif

                 <div class="form-row">
                   <div class="form-group col-md-3">
                     <label>Date</label>
                     <input type="text" name="date" id="date" value="{{@$editData->date}}" class="form-control singledatepicker form-control-sm" autocomplete="off" placeholder="Date"/>
                   </div>
                   <div class="form-group col-md-3">
                     <label>Amount</label>
                     <input type="text" name="amount" id="date" value="{{@$editData->amount}}" class="form-control form-control-sm">
                   </div>
                   <div class="form-group col-md-3">
                     <label>Image</label>
                     <input type="file" name="image" id="image" id="image" class="form-control form-control-sm">
                   </div>

                   <div class="form-group col-md-3">
                     <img id="ImageShow" src="{{(!empty(@$editData->image))?url('public/upload/cost_images/'.@$editData->image):url('public/upload/no_image.png')}}" style="width:100px;height:100px; border: 1px solid #000;">
                   </div>
                   <div class="form-group col-md-12">
                      <label>Description</label>
                      <textarea name="description" class="form-control" rows="4">{{@$editData->description}}</textarea>
                   </div>
                   <div class="form-group col-md-12">
                      <button type="submit" class="btn btn-primary btn-sm" >{{(@$editData)?"Update":"Submit"}}</button>
                   </div>
                 </div>
               </form>
            </div>
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
      date: {
        required: true,
      },
      amount: {
        required: true,
      },

      description: {
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