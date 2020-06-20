<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <style>
	  .field{
		  margin:15px;
	  }
	  hr{
		border: 10px solid #FF9E0F;
  		border-radius: 5px;
	  }
	  img{
			display: block;
			margin-left: auto;
			margin-right: auto;
		}
	  }
	  footer {
		width: 80%;
		float: left;
		}
		.footerMain
		{
			width: 100%;
			float: left;
			height: 120px;
		}
  </style>
   <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
   
</head>
<body class="hold-transition sidebar-collapse layout-top-nav">
	<div class="container-fluid" style="height:100px; background-color: #6ccccc69" >
		<div class="row">
			<img src="{{ asset('dist/img/logoBK.png') }}" alt="" width="" height="100px" class="center" >
			<div class="col-sm-11" style="height:100px; color: #e20d0dd7; font-family: Georgia, 'Times New Roman', Times, serif; font-size: 320%; text-align: center">ĐIỂM DANH SINH VIÊN</div>
		</div>
	</div>
	<div class="container">
		<div class="col-sm-12 row">
			<div class="col-sm-3"><span style="font-weight: bold;">Giáo viên:</span> Nguyễn Đức Tiến</div>
			<div class="col-sm-3"><span style="font-weight: bold;">Môn học:</span> Project 2</div>
			<div class="col-sm-3"><span style="font-weight: bold;">Giờ học:</span> Kì 20192</div>
			<div class="col-sm-1"></div>
			<select name="" id="" class="col-sm-2 form-control">
				<option value="0">Chọn phòng học</option>
				<option value="1">D3 201</option>
				<option value="2">D3 301</option>
				<option value="3">D3 401</option>
			</select>
		</div>
		<hr style="margin-top:30px">
		
		<div class="row">
			<div class="col-sm-4 center" >
				<img src="{{ asset('dist/img/avatar1.png') }}" alt="" width="70%" height="100%" class="center" id="avatar">
				<div class="text-center" > <span style="font-weight: bold;">MSSV: </span><span id="mssv">20173088</span></div>
			</div>
			<div class="col-sm-4">
				<div class="field"><span style="font-weight: bold;">Họ và tên: </span><span id ="name">Unknown</span></div>
				<div class="field"><span style="font-weight: bold;">Năm vào trường: </span><span id="start_year">Unknown</span></div>
				<div class="field"><span style="font-weight: bold;">Bậc đào tạo:  </span><span id="education">Unknown</span></div>
				<div class="field"><span style="font-weight: bold;">Chương trình:  </span><span id="program">Unknown</span></div>
				<div class="field"><span style="font-weight: bold;">Tình trạng học tập: </span><span id="status">Unknown</span></div>
			</div>
			<div class="col-sm-4">
				<div class="field"><span style="font-weight: bold;">Giới tính: </span><span id="sex">Unknown</span></div>
				<div class="field"><span style="font-weight: bold;">Lớp: </span><span id="class">Unknown</span></div>
				<div class="field"><span style="font-weight: bold;">Khóa học:  </span><span id="k">Unknown</span></div>
				<div class="field"><span style="font-weight: bold;">Email:  </span><span id="email">Unknown</span></div>
			</div>
		</div>

		<hr style="margin-top:30px">

		<table class="table table-bordered table-hover" id="table">
			<thead>
				<th>STT</th>
				<th>MSSV</th>
				<th>Họ và tên</th>
				<th>Giờ vào lớp</th>
			</thead>
			<tbody>
	
			</tbody>
		</table>
	</div>
		<!-- Test Led -->
		<script src="{{ asset('js/testLed.js') }}"></script>
  
      <!-- DataTables -->
  <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('js/firebase.js') }}"></script>

</body>
<footer>
	

	<div class="footerContent" >
		<div class="footerMain" style="background: url({{ url('dist/img/footer.png') }}) no-repeat top;">
			{{-- <div class="footerLeft">
			</div>
			<div class="footerRight">
			</div> --}}
		</div>
	</div>
</footer>
</html>
 

