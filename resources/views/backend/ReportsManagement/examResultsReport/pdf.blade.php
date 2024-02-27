<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Employee Attendance Information</title>
    <link rel="stylesheet" href="{{asset('public/backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <style type="text/css">
    table{
      border-collapse: collapse;
    }

    h2 h3{margin: 0;padding: 0;}
    .table{width: 100%;margin-bottom: 1rem;background-color: transparent;}
    .table th,.table td{padding: .75rem;vertical-align: top;border-top: 1px solid #dee2e6;}
    .table thead th{vertical-align: bottom;border-bottom: 2px solid #dee2e6}
    .table tbody + tbody {border-top: 2px solid #dee2e6;}
    .table .table{background-color:#fff;}
    .table-bordered{border: 1px solid #dee2e6;}
    .table-bordered th,.table-bordered td {border: 1px solid #dee2e6;}
    .table-bordered thead th,.table-bordered thead td{border-bottom-width: 2px;}
    .text-center{text-align: center;}
    .text-right{text-align: right;}
    table tr td {padding: 5px;}
    .table-bordered thead th , .table-bordered thead td , .table-bordered th{border: 1px solid black !important;}
    .table-bordered thead th{background: #cacaca;}

  </style>
</head>
<body>
  <div class="container mt-0">
    <div class="row">
      <div class="col-md-12">
        <table width="80%">
          <tr>
            <td width="33%" class="text-center" ><img src="{{url('public/upload/logo.jpg')}}" style="width: 100px; height: 100px;"></td>
            <td class="text-center" width="63%">
              <h4><strong>ABC School</strong></h4>
              <h5><strong>Khulna Sadar, Khulna</strong></h5>
              <h6><strong>www.abc_school.com</strong></h6>
            </td>
            <td class="text-center"></td>

          </tr>
        </table>
        <div class="col-md-12 text-center">
          <h5 style="font-weight: bold; padding-top: -25px;">Results of {{$allData['0']['exam_type']['name']}}</h5>
        </div>
        <div class="col-md-12">
          <table  cellpadding="1" cellspacing="2" width="100%">
            <thead>
              
            </thead>
            <tbody>
              <tr>
                <td width="50%"><strong>Year/Session: </strong>{{$allData['0']['year']['name']}}</td>
                <td><strong>Class: </strong>{{$allData['0']['student_class']['name']}}</td>
              </tr>
          </tbody>
          </table>
          <hr style="border-bottom: 1px solid ; width: 100%; color: #000; margin-bottom: 0px;">
        </div><br>
        <div class="col-md-12">
          <table border="1" width="100%" cellspacing="0" cellpadding="0">
            <thead width="100%">
              <tr>
                <th width="5%">SL</th>
                <th width="">Student Name</th>
                <th width="">ID No</th>
                <th width="10%">Letter Grade</th>
                <th width="10%">Grade Point</th>
                <th width="15%">Remarks</th>
              </tr>
            </thead>
            <tbody>
              @foreach($allData as $key=>$data)
              @php 
              $allMarks = App\Models\StudentMarks::where('year_id',$data->year_id)->where('class_id',$data->class_id)->where('exam_type_id',$data->exam_type_id)->where('student_id',$data->student_id)->get();
              $total_marks = 0;
              $total_point = 0;
              foreach($allMarks as $value){
               
                $count_fail =App\Models\StudentMarks::where('year_id',$value->year_id)->where('class_id',$value->class_id)->where('exam_type_id',$value->exam_type_id)->where('student_id',$value->student_id)->where('marks','<','33')->get()->count(); 
                  $get_marks = $value->marks;

                  $grade_marks = App\Models\MarksGrade::where([['start_marks','<=',(int)$get_marks],['end_marks','>=',(int)$get_marks]])->first();
                  $grade_name = $grade_marks->grade_name;
                  $grade_point = number_format((float)$grade_marks->grade_point,2);
                  $total_point = (float)$total_point+(float)$grade_point;
              }
              @endphp
              <tr>
                <td>{{$key+1}}</td>
                <td>{{$data['student']['name']}}</td>
                <td>{{$data['student']['id_no']}}</td>
                @php
                $total_subject = App\Models\StudentMarks::where('year_id',$data->year_id)->where('class_id',$data->class_id)->where('exam_type_id',$data->exam_type_id)->where('student_id',$data->student_id)->get()->count();
                $total_grade=0;
                $point_for_letter_grade = (float)$total_point/(float)$total_subject;

                $total_grade = App\Models\MarksGrade::where([['start_point','<=',(int)$point_for_letter_grade],['end_point','>=',(int)$point_for_letter_grade]])->first();
                  $grade_point_avg = (float)$total_point/(float)$total_subject;

                @endphp
                <td>
                  
                  @if($count_fail > 0)
                  F
                  @else
                  {{$total_grade->grade_name}}
                  @endif
                </td>
                <td>
                  
                  @if($count_fail > 0)
                  0.00
                  @else
                  {{number_format((float)$grade_point_avg,2)}}
                  @endif
                </td>
                <td>
                  
                  @if($count_fail > 0)
                  Fail
                  @else
                  {{$total_grade->remarks}}
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div><br>
          <i style="font-size: 10px; float: right;">Print Date: {{date('d M Y')}}</i>

          <div class="col-md-12">
            <table  width="100%">
              <tbody>
                <tr>
                  <td style="width:30%"></td>
                  <td style="width:30%"></td>
                  <td style="width:40%; text-align: center;">
                    <hr style="border-bottom: 1px solid #000; width: 60%; color: #000; margin-bottom: 0px;">
                    <p style="text-align: center;">Principal/Headmaster</p>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
      </div>
    </div><br><br><br><br><br>
  </div>

  <script src="{{asset('public/backend')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
</body>
</html>