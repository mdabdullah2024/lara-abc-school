<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Student Details Information</title>
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
							<h5><strong>Dhaka-1200</strong></h5>
							<h6><strong>www.abc_school.com</strong></h6>
						</td>
						<td class="text-center"><img src="{{url('public/upload/students_images/',$details->student->image)}}" style="width:100px; height: 100px;border:1px solid rgba(0, 0, 0, .1); border-radius: 10px;"></td>
					</tr>
				</table>
				<div class="col-md-12 text-center">
					<h5 style="font-weight: bold; padding-top: -25px;">Student Registration Fee</h5>
				</div>
				<div class="col-md-12">
					<table border="1" width="100%">
						@php

						$registrationfee=App\Models\FeeAmount::where('fee_category_id','1')->where('class_id',$details->class_id)->first();
						$originalfee = $registrationfee->amount;
						$discount = $details->discount->discount;
						$discountablefee = $discount/100*$originalfee;
						$finalFee = (float)$originalfee-(float)$discountablefee;

						@endphp
						<tbody>
						<tr>
							<td style="width: 50%;">Student Name</td>
							<td>{{$details['student']['name']}}</td>
						</tr>
						<tr>
							<td style="width: 50%;">Year</td>
							<td>{{$details['year']['name']}}</td>
						</tr>
						<tr>
							<td style="width: 50%;">Class</td>
							<td>{{$details['student_class']['name']}}</td>
						</tr>
						<tr>
							<td style="width: 50%;">ID No</td>
							<td>{{$details['student']['id_no']}}</td>
						</tr>
						<tr>
							<td style="width: 50%;">Roll No</td>
							<td>{{$details->roll}}</td>
						</tr>
						<tr>
							<td style="width: 50%;">Mobile No</td>
							<td>{{$details['student']['mobile']}}</td>
						</tr>
						<tr>
							<td style="width: 50%;">Registration Fee</td>
							<td>{{$originalfee}} TK</td>
						</tr>
						<tr>
							<td style="width: 50%;">Discount Fee</td>
							<td>{{$discount}}%</td>
						</tr>

						<tr>
							<td style="width: 50%;">Fee (This Student)</td>
							<td>{{$finalFee}} TK</td>
						</tr>

					</tbody>
					</table>
					<i style="font-size: 10px; float: right;">Print Date: {{date('d M Y')}}</i>
				</div><br>
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
		</div><br><br><br>
		<div style="border-bottom: 2px dotted #000;"></div>
		<div class="row">
			<div class="col-md-12">
				<table width="80%">
					<tr>
						<td width="33%" class="text-center" ><img src="{{url('public/upload/logo.jpg')}}" style="width: 100px; height: 100px;"></td>
						<td class="text-center" width="63%">
							<h4><strong>ABC School</strong></h4>
							<h5><strong>Dhaka-1200</strong></h5>
							<h6><strong>www.abc_school.com</strong></h6>
						</td>
						<td class="text-center"><img src="{{url('public/upload/students_images/',$details->student->image)}}" style="width:100px; height: 100px;border:1px solid rgba(0, 0, 0, .1); border-radius: 10px;"></td>
					</tr>
				</table>
				<div class="col-md-12 text-center">
					<h5 style="font-weight: bold; padding-top: -25px;">Student Registration Fee</h5>
				</div>
				<div class="col-md-12">
					<table border="1" width="100%">
						@php

						$registrationfee=App\Models\FeeAmount::where('fee_category_id','1')->where('class_id',$details->class_id)->first();
						$originalfee = $registrationfee->amount;
						$discount = $details->discount->discount;
						$discountablefee = $discount/100*$originalfee;
						$finalFee = (float)$originalfee-(float)$discountablefee;

						@endphp
						<tbody>
						<tr>
							<td style="width: 50%;">Student Name</td>
							<td>{{$details['student']['name']}}</td>
						</tr>
						<tr>
							<td style="width: 50%;">Year</td>
							<td>{{$details['year']['name']}}</td>
						</tr>
						<tr>
							<td style="width: 50%;">Class</td>
							<td>{{$details['student_class']['name']}}</td>
						</tr>
						<tr>
							<td style="width: 50%;">ID No</td>
							<td>{{$details['student']['id_no']}}</td>
						</tr>
						<tr>
							<td style="width: 50%;">Roll No</td>
							<td>{{$details->roll}}</td>
						</tr>
						<tr>
							<td style="width: 50%;">Mobile No</td>
							<td>{{$details['student']['mobile']}}</td>
						</tr>
						<tr>
							<td style="width: 50%;">Registration Fee</td>
							<td>{{$originalfee}} TK</td>
						</tr>
						<tr>
							<td style="width: 50%;">Discount Fee</td>
							<td>{{$discount}}%</td>
						</tr>

						<tr>
							<td style="width: 50%;">Fee (This Student)</td>
							<td>{{$finalFee}} TK</td>
						</tr>

					</tbody>
					</table>
					<i style="font-size: 10px; float: right;">Print Date: {{date('d M Y')}}</i>
				</div><br>
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
		</div>
	</div>

	<script src="{{asset('public/backend')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
</body>
</html>