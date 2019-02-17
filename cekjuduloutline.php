<?php
@include("header.php");
@include("navigation.php");
@include("dbconnect.php");
?>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
	<div class="fixed-nav sticky-footer bg-dark" id="page-top">
		<div class="content-wrapper">

			<div class="container-fluid">
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="index.php">Home</a>
					</li>
					<li class="breadcrumb-item active"> Periksa Judul Outline</li>
				</ol>
			</div>

			<div class="input-group mb-2" style="margin: 0 50px 0px 10px; width:50%;">
				<div class="input-group-prepend">
					<label class="input-group-text">Kata Kunci 1</label>
				</div>
				<input type='text' class="form-control" placeholder="Kata Kunci 1" id="katakunci1" name="katakunci1" onkeyup="this.value=this.value.toUpperCase()"/>
			</div>

			<div class="input-group mb-2" style="margin: 0 50px 0px 10px; width:50%;">
				<div class="input-group-prepend">
					<label class="input-group-text">Kata Kunci 2</label>
				</div>
				<input type='text' class="form-control" placeholder="Kata Kunci 2" id="katakunci2" name="katakunci2" onkeyup="this.value=this.value.toUpperCase()"/>
			</div>

			<div class="input-group mb-2" style="margin: 0 50px 0px 10px; width:50%;">
				<div class="input-group-prepend">
					<label class="input-group-text">Kata Kunci 3</label>
				</div>
				<input type='text' class="form-control" placeholder="Kata Kunci 3" id="katakunci3" name="katakunci3" onkeyup="this.value=this.value.toUpperCase()"/>
			</div>

			<div class="input-group mb-2" style="margin: 0 50px 0px 10px;">
				<a id ='checkjudul'>
					<button type='submit' class='btn btn-primary btn-md'>Check Judul</button>
				</a>
				</div>

				<div class="card-body">
					<div class="detailcekjudul">
					</div>
				</div>
				<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
			</div>
		</div>
	</div>
</body>

	<?php
	@include("footer.php");
	?>


    	<!-- Show Detail Mahasiswa -->
		    <script type="text/javascript">
  				$(document).on("click", "#checkjudul", function () {
						var kk1 = document.getElementById('katakunci1').value;
		                var kk2 = document.getElementById('katakunci2').value;
		                var kk3 = document.getElementById('katakunci3').value;

		                //menggunakan fungsi ajax untuk pengambilan data
		                $.ajax(
		                {
		                    type : 'post',
		                    url : 'checkjudul.php',
		                    data : "kk1="+kk1+"&kk2="+kk2+"&kk3="+kk3,
		                    success : function(data)
		                    {
		                        $('.detailcekjudul').html(data);//menampilkan data ke dalam modal
		                    }
		                });
		            });

		    </script>