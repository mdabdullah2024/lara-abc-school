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
              <li class="breadcrumb-item"><a href="#">Manage Desigantion</a></li>
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
                <h3>Designation List
                
                  <a class="btn btn-success float-right btn-sm" href="{{ route('setup.designation.create') }}"><i class="fa fa-plus-circle"></i>Add Desigantion</a>
                  
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-striped table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>SL. </th>
                    <th>Designation</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($allData as $key => $designation)
                  <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{ $designation->name }}</td>
                    <td>
                      @if(Auth::User()->usertype == "admin")
                      <a class="btn btn-primary" href="{{route('setup.designation.edit',$designation->id)}}"><i class="fa fa-edit"></i></a>

                        

                      <a id="" onclick="designationDataDelete({{ $designation->id }})" class="btn btn-danger" href="#"><i class="fa fa-trash"></i></a>

                      <form id="designation-formdata-{{ $designation->id }}" method="post" action="{{route('setup.designation.destroy',$designation->id)}}" >
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
    function designationDataDelete(id){
        if(confirm('Are You Sure Want to Delete student Class ')){
            document.getElementById('designation-formdata-'+id).submit();
        }
    }
  </script>
@endsection
