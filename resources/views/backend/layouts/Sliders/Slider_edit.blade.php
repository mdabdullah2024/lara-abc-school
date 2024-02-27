@extends('backend.layouts.master')
@section('content')
<script type="text/javascript">
  
$(function () {
 
  $('#slider_data').validate({
    rules: {
      short_description: {
        required: true,
        
      },
      long_description: {
        required: true,
        
      },
      image: {
        required: true,
        
      }
      
    }
    messages: {
      short_description: {
        required: "Please enter short description ",
        
      },
      long_description: {
        required: "Please enter Long description name",
        
      },
      image: {
        required: "Please enter a image ",
        image: "Please enter a  image "
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
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Slider

            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Slider Management</li>
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
                <h3>Slider
                    <a class="btn btn-success float-right btn-sm" href="{{ route('sliders.index') }}">Back</a>
                </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="slider_data" action="{{ route('sliders.update',$slider->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card-body">
                  <div class="form-group">
                    <label for="short_description">Short description</label>
                    <input id="short_description" type="text" name="short_description" class="form-control" id="" value="{{$slider->short_description}}">
                    <font style="color:red;">{{($errors->has('short_description'))?($errors->first('short_description')):""}}</font>
                  </div>

                  <div class="form-group">
                    <label for="long_description">long description</label>
                    <input id="long_description" type="text" name="long_description" class="form-control" id="" value="{{$slider->long_description}}">
                    <font style="color:red;">{{($errors->has('long_description'))?($errors->first('long_description')):""}}</font>
                  </div>

                	<div class="form-group">
                    <label for="image">image</label>
                    <input id="image" type="file" name="image" class="form-control" id="" value="{{$slider->image}}">
                    <font style="color:red;">{{($errors->has('image'))?($errors->first('image')):""}}</font>
                  </div>
                  <div class="form-group">
                    
                    <img id="ImageShow" style="border:1px solid black;width: 120px ; height: 120px;"  src="{{ (!empty($slider->image))? url('public/upload/slider_images/'.$slider->image): url('public/upload/no_image.png')}}">
                </div>
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
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

@endsection