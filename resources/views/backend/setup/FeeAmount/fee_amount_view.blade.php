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
              <li class="breadcrumb-item"><a href="#">Manage Fee Category Amount</a></li>
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
                <h3>Fee Amount List
                 
                  
                  <a class="btn btn-success float-right btn-sm" href="{{ route('setup.fee.amount.create') }}"><i class="fa fa-plus-circle"></i>Add</a>
                  
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-striped table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>SL. </th>
                    <th>Fee Category</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($allData as $key => $value)
                    
                  <tr class="{{$value->id}}">
                    <td>{{$key + 1}}</td>
                    <td>{{$value['feeCategory']['name']}}</td>
                    
                    <td>
                      <a class="btn btn-primary" href="{{route('setup.fee.amount.edit',$value->fee_category_id)}}"><i class="fa fa-edit"></i></a>
                      <a class="btn btn-success" href="{{route('setup.fee.amount.show',$value->fee_category_id)}}"><i class="fa fa-eye"></i></a>
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
    function valueDataDelete(id){
        if(confirm('Are You Sure Want to Delete Fee Category')){
            document.getElementById('value-formdata-'+id).submit();
        }
    }
  </script>
@endsection
