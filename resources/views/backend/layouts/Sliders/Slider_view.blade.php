@extends('backend.layouts.master')
@section('content')
@include('sweetalert::alert')
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
              <li class="breadcrumb-item"><a href="#">Manage Slider</a></li>
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
                <h3>Sliders List
                  @if($count <3)
                  <a class="btn btn-success float-right btn-sm" href="{{ route('sliders.create') }}"><i class="fa fa-plus-circle"></i>Add</a>
                  @endif
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-striped table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>SL. </th>
                    <th>Short Description</th>
                    <th>Long Description</th>
                    <th>
                      Slider's Image
                    </th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($sliders as $key => $slider)
                  <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{ $slider->short_description }}</td>
                    <td>{{ $slider->long_description }}</td>
                    <td>
                      <img width="120px " height="120px" class="img rounded-circle" src="{{ (!empty($slider->image)?url('public/upload/slider_images/'.$slider->image):url('public/upload/no_image.png')) }}" alt="Card image cap">
                    </td>
                    <td>
                      @if(Auth::User()->usertype == "admin")
                      <a class="btn btn-primary" href="{{ route('sliders.edit',$slider->id) }}"><i class="fa fa-edit"></i></a>

                        

                      <a id="" onclick="sliderDataDelete({{ $slider->id }})" class="btn btn-danger" href="#"><i class="fa fa-trash"></i></a>

                      <form id="slider-formdata-{{ $slider->id }}" method="post" action="{{route('sliders.destroy',$slider->id)}}" >
                        @csrf
                        @method('delete')
                        
                      </form>
                      @else
                      <a class="btn btn-primary" href="{{ route('home') }}"><i class="fa fa-home"></i></a>
                      @endif
                    </td>
                  </tr>

                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
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
  <script type="text/javascript">
    function sliderDataDelete(id){
        if(confirm('Are You Sure Want to Delete Slider Image')){
            document.getElementById('slider-formdata-'+id).submit();
        }
    }
  </script>
@endsection
