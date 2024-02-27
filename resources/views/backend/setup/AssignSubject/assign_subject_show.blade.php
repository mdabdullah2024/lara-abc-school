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
              <li class="breadcrumb-item"><a href="#">Manage Assign Subjects</a></li>
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
                <h3>Assign Subject show
                  
                  <a class="btn btn-success float-right btn-sm" href="{{ route('setup.assign.subject.index') }}"><i class="fa fa-list"></i>Assign Subject View</a>
                  
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <h4>Class Name: <strong>{{$editData[0]['student_class']['name']}}</strong></h4>
                <table id="example1" class="table table-striped table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>SL. </th>
                    <th>Subjects</th>
                    <th>Full Marks</th>
                    <th>Pass Marks</th>
                    <th>Subjective Marks</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($editData as $key => $value)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$value['subject']['name']}}</td>
                      <td>{{$value->full_marks}}</td>
                      <td>{{$value->pass_marks}}</td>
                      <td>{{$value->obtain_marks}}</td>
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
    function valueDataDelete(id){
        if(confirm('Are You Sure Want to Delete Fee Category')){
            document.getElementById('value-formdata-'+id).submit();
        }
    }
  </script>
@endsection
