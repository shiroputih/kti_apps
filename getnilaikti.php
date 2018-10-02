<?php
@include("header.php");
@include("dbconnect.php");

if($_POST['semester']){
    $sql = "SELECT * FROM kti WHERE kti.idsemester = '".$_POST['semester']."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) 
      	{
?>
		 <div class="card mb-3">
		            <div class="card-header">
		                <i class="fa fa-table"></i> Data Karya Tulis Ilmiah
		            </div>
		            <div id="Table" class="card-body">
		                <div id="tablekti" class="table-responsive">
		                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
		                        <thead>
		                            <tr>
		                                <th>NIM</th>
		                                <th>Nama</th>
		                                <th>Batas Kumpul KTI</th>
		                                <th>Kumpul Berkas KTI</th>
		                                <th>Nilai KTI</th>
		                                <th>Nilai KTI (Huruf)</th>
		                                <th></th>
		                            </tr>
		                        </thead>
		                        <tfoot>
		                            <tr>
		                                <th>NIM</th>
		                                <th>Nama</th>
		                                <th>Batas Kumpul KTI</th>
		                                <th>Kumpul Berkas KTI</th>
		                                <th>Nilai KTI</th>
		                                <th>Nilai KTI (Huruf)</th>
		                                <th></th>
		                            </tr>
		                        </tfoot>
		                        <tbody>
		                            <?php
		                            $sql = "SELECT * FROM kti,mahasiswa WHERE kti.nim = mahasiswa.nim AND kti.idsemester = '".$_POST['semester']."'";
		                            $result = $conn->query($sql);
		                            if ($result->num_rows > 0) {
		                        // output data of each row
		                                while ($row = $result->fetch_assoc()) {
		                                    echo "<tr>
		                                    <td>$row[nim]</td>
		                                    <td>$row[nama]</td>
		                                    <td>$row[batas_pengumpulan]</td>
		                                    <td>$row[tgl_kumpul]</td>
		                                    <td>$row[nilaiakhir]</td>
		                                    <td>$row[nilaiakhirhuruf]</td>
		                                    <td class=center>
		                                    "; ?>
		                                    <?php
		                                    if($row['tgl_kumpul'] == NULL){ 
		                                        echo"
		                                        <a id ='Ubahdatakti' 
		                                        data-nimmahasiswa='$row[nim]' 
		                                        data-namamahasiswa='$row[nama]' 
		                                        data-dosen='$row[dosen1]' 
		                                        data-dosen2='$row[dosen2]' 
		                                        data-dosen3='$row[penguji]'
		                                        data-toggle='modal' data-target='#UbahDataktiModal'>
		                                        <button type='button' class='btn btn-warning btn-sm'>Edit</button></a>
		                                        <a id ='Viewdatakti' data-nimmahasiswa=$row[nim]  data-namamahasiswa='$row[nama]' data-gelarbelakang='$row[tgl_sidangkti]' data-toggle='modal' data-target='#ViewDataktiModal'>
		                                        <button type='button' class='btn btn-info btn-sm'>Detail</button></a>

		                                        <a id ='kumpulberkas' data-nimmahasiswa='$row[nim]' data-namamahasiswa='$row[nama]' data-gelarbelakang='$row[tgl_sidangkti]' data-bataskumpul = '$row[batas_pengumpulan]' data-nilaitemp='$row[nilaiakhirhuruf_temp]' data-toggle='modal' data-target='#KumpulBerkasModal'>
		                                        <button type='button' class='btn btn-primary btn-sm'>Kumpul Berkas</button></a>

		                                        </td>
		                                        </tr>
		                                        ";
		                                    }else{
		                                        echo"
		                                        <a id ='Ubahdatakti' 
		                                        data-nimmahasiswa=$row[nim]  
		                                        data-namamahasiswa='$row[nama]' 
		                                        data-dosen='$row[dosen1]' 
		                                        data-dosen2='$row[dosen2]' 
		                                        data-dosen3='$row[penguji]' 
		                                        data-penulisan1 = '$row[penulisanisi1]'
		                                        data-penulisan2 = '$row[penulisanisi2]'
		                                        data-penulisan3 = '$row[penulisanisi3]'
		                                        data-metodologi1 = '$row[metodologi1]'    
		                                        data-metodologi2 = '$row[metodologi2]'
		                                        data-metodologi3 = '$row[metodologi3]'
		                                        data-penguasaanmateri1 = '$row[penguasaanmateri1]'    
		                                        data-penguasaanmateri2 = '$row[penguasaanmateri2]'
		                                        data-penguasaanmateri3 = '$row[penguasaanmateri3]'
		                                        data-presentasi1 = '$row[presentasi1]'    
		                                        data-presentasi2 = '$row[presentasi2]'
		                                        data-presentasi3 = '$row[presentasi3]'
		                                        data-toggle='modal' data-target='#UbahDataktiModal'>
		                                        <button type='button' class='btn btn-warning btn-sm'>Edit</button></a>
		                                        <a id ='Viewdatakti' data-nimmahasiswa=$row[nim]  data-namamahasiswa='$row[nama]' data-gelarbelakang='$row[tgl_sidangkti]'  data-toggle='modal' data-target='#ViewDataktiModal'>
		                                        <button type='button' class='btn btn-info btn-sm'>Detail</button></a>
		                                        </td>
		                                        </tr>";
		                                    }
		                                }
		                            } else {
		                                echo "0 results";
		                            }
		                            ?>
		                        </tbody>
		                    </table>
		                </div>
		            </div>
		 </div>
		        <!-- Ubah Nilai Akhir -->
		    <div class="modal fade" id="UbahDataktiModal" role="dialog">
		        <div class="modal-dialog">
		            <div class="modal-content">
		                <div class="modal-header">
		                    <h4 class="modal-title">Ubah Nilai KTI </h4>
		                    <button type="button" class="close" data-dismiss="modal">&times;</button>
		                </div>
		                <div class="modal-body" style="background-color: #bec673">
		                    <div class="card-body">
		                        <form method="post" enctype="multipart/form-data">
		                            <div class="form-group">
		                                <div class="input-group mb-3">
		                                    <input class="form-control" name="hiddennim" id="hiddennim" type="hidden"
		                                    aria-describedby="nameHelp" > 
		                                    <div class="input-group-prepend">
		                                        <label class="input-group-text" for="inputGroupSelect01">NIM</label>
		                                    </div>
		                                    <input class="form-control" name="EditktiNim" id="EditktiNim" type="text"
		                                    aria-describedby="nameHelp" disabled="">
		                                </div>

		                                <div class="input-group mb-3">
		                                    <div class="input-group-prepend">
		                                        <label class="input-group-text" for="inputGroupSelect01">Nama</label>
		                                    </div>
		                                    <input class="form-control" name="hiddennama" id="hiddennama" type="hidden"
		                                    aria-describedby="nameHelp" > 
		                                    <input class="form-control" name="EditktiNama" id="EditktiNama" type="text"
		                                    aria-describedby="nameHelp" disabled="">
		                                </div>

		                                <div class="input-group mb-3">
		                                    <div class="input-group-prepend">
		                                        <label class="input-group-text" for="inputGroupSelect01">Dosen Penguji 1</label>
		                                    </div>
		                                    <select class="custom-select" name="EditktiDosen1" id="EditktiDosen1" disabled>
		                                        <?php
		                                        $sql = "SELECT * FROM dosen,kti,mahasiswa WHERE mahasiswa.nim = kti.nim AND kti.dosen1 = dosen.id_dosen";
		                                        $result = $conn->query($sql);
		                                        if ($result->num_rows > 0) {
		                                        // output data of each row
		                                            while ($row = $result->fetch_assoc()) {
		                                                echo "<option value=$row[id_dosen]>$row[gelar_depan] $row[nama_dosen] $row[gelar_belakang]</option>";
		                                            }
		                                        } else {
		                                            echo "0 results";
		                                        }
		                                        ?>
		                                    </select>
		                                </div>
		                                <hr width="10px">

		                                <div class="input-group mb-3">
		                                    <div class="input-group-prepend">
		                                        <label class="input-group-text" for="inputGroupSelect01">Penulisan Isi</label>
		                                    </div>
		                                    <input class="form-control" width="50px" name="nilaiisi1" id="nilaiisi1" type="text"
		                                    aria-describedby="nameHelp" >

		                                    <div class="input-group-prepend">
		                                        <label class="input-group-text" for="inputGroupSelect01">Metodologi</label>
		                                    </div>
		                                    <input class="form-control" name="nilaimetodologi1" id="nilaimetodologi1" type="text"
		                                    aria-describedby="nameHelp" >

		                                    <div class="input-group-prepend">
		                                        <label class="input-group-text" for="inputGroupSelect01">Penguasaan Materi</label>
		                                    </div>
		                                    <input class="form-control" name="nilaimateri1" id="nilaimateri1" type="text"
		                                    aria-describedby="nameHelp" >

		                                    <div class="input-group-prepend">
		                                        <label class="input-group-text" for="inputGroupSelect01">Materi dan Presentasi</label>
		                                    </div>
		                                    <input class="form-control" name="nilaipresentasi1" id="nilaipresentasi1" type="text"
		                                    aria-describedby="nameHelp" >
		                                </div>

		                                <div class="input-group mb-3">
		                                    <div class="input-group-prepend">
		                                        <label class="input-group-text" for="inputGroupSelect01">Dosen Penguji 2</label>
		                                    </div>
		                                    <select class="custom-select" name="EditktiDosen2" id="EditktiDosen2" disabled>
		                                        <?php
		                                        $sql = "SELECT * FROM dosen,kti,mahasiswa WHERE mahasiswa.nim = kti.nim AND kti.dosen2 = dosen.id_dosen";
		                                        $result = $conn->query($sql);
		                                        if ($result->num_rows > 0) {
		                                        // output data of each row
		                                            while ($row = $result->fetch_assoc()) {
		                                                echo "<option value=$row[id_dosen]>$row[gelar_depan] $row[nama_dosen] $row[gelar_belakang]</option>";
		                                            }
		                                        } else {
		                                            echo "0 results";
		                                        }
		                                        ?>
		                                    </select>
		                                </div>
		                                <hr width="10px">

		                                <div class="input-group mb-3">
		                                    <div class="input-group-prepend">
		                                        <label class="input-group-text" for="inputGroupSelect01">Penulisan Isi</label>
		                                    </div>
		                                    <input class="form-control" width="50px" name="nilaiisi2" id="nilaiisi2" type="text"
		                                    aria-describedby="nameHelp" >

		                                    <div class="input-group-prepend">
		                                        <label class="input-group-text" for="inputGroupSelect01">Metodologi</label>
		                                    </div>
		                                    <input class="form-control" name="nilaimetodologi2" id="nilaimetodologi2" type="text"
		                                    aria-describedby="nameHelp" >

		                                    <div class="input-group-prepend">
		                                        <label class="input-group-text" for="inputGroupSelect01">Penguasaan Materi</label>
		                                    </div>
		                                    <input class="form-control" name="nilaimateri2" id="nilaimateri2" type="text"
		                                    aria-describedby="nameHelp" >

		                                    <div class="input-group-prepend">
		                                        <label class="input-group-text" for="inputGroupSelect01">Materi dan Presentasi</label>
		                                    </div>
		                                    <input class="form-control" name="nilaipresentasi2" id="nilaipresentasi2" type="text"
		                                    aria-describedby="nameHelp" >
		                                </div>

		                                <div class="input-group mb-3">
		                                    <div class="input-group-prepend">
		                                        <label class="input-group-text" for="inputGroupSelect01">Dosen Penguji 3</label>
		                                    </div>
		                                    <select class="custom-select" name="EditktiDosen3" id="EditktiDosen3" disabled>
		                                        <?php
		                                        $sql = "SELECT * FROM dosen,kti,mahasiswa WHERE mahasiswa.nim = kti.nim AND kti.penguji = dosen.id_dosen";
		                                        $result = $conn->query($sql);
		                                        if ($result->num_rows > 0) {
		                                        // output data of each row
		                                            while ($row = $result->fetch_assoc()) {
		                                                echo "<option value=$row[id_dosen]>$row[gelar_depan] $row[nama_dosen] $row[gelar_belakang]</option>";
		                                            }
		                                        } else {
		                                            echo "0 results";
		                                        }
		                                        ?>
		                                    </select>
		                                </div>
		                                <hr width="10px">

		                                <div class="input-group mb-3">
		                                    <div class="input-group-prepend">
		                                        <label class="input-group-text" for="inputGroupSelect01">Penulisan Isi</label>
		                                    </div>
		                                    <input class="form-control" width="50px" name="nilaiisi3" id="nilaiisi3" type="text"
		                                    aria-describedby="nameHelp" >

		                                    <div class="input-group-prepend">
		                                        <label class="input-group-text" for="inputGroupSelect01">Metodologi</label>
		                                    </div>
		                                    <input class="form-control" name="nilaimetodologi3" id="nilaimetodologi3" type="text"
		                                    aria-describedby="nameHelp" >

		                                    <div class="input-group-prepend">
		                                        <label class="input-group-text" for="inputGroupSelect01">Penguasaan Materi</label>
		                                    </div>
		                                    <input class="form-control" name="nilaimateri3" id="nilaimateri3" type="text"
		                                    aria-describedby="nameHelp" >

		                                    <div class="input-group-prepend">
		                                        <label class="input-group-text" for="inputGroupSelect01">Materi dan Presentasi</label>
		                                    </div>
		                                    <input class="form-control" name="nilaipresentasi3" id="nilaipresentasi3" type="text"
		                                    aria-describedby="nameHelp" >
		                                </div>

		                            </div>
		                            <button type="submit" name="ubahnilaikti" class="btn btn-info btn-lg" >Ubah Nilai KTI</button>
		                        </form>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
<?php 
        }
    }
}

?>
		    <script type="text/javascript">
		        $(document).on("click", "#Ubahdatakti", function () {

		            var NIM = $(this).data('nimmahasiswa');
		            var nama_mahasiswa = $(this).data('namamahasiswa');
		            var dosen1 = $(this).data('dosen');
		            var dosen2 = $(this).data('dosen2');
		            var dosen3 = $(this).data('dosen3');
		            var isi1 = $(this).data('penulisan1'); 
		            var isi2 = $(this).data('penulisan2');
		            var isi3 = $(this).data('penulisan3');
		            var metode1 = $(this).data('metodologi1');
		            var metode2 = $(this).data('metodologi2');
		            var metode3 = $(this).data('metodologi3');
		            var materi1 = $(this).data('penguasaanmateri1');
		            var materi2 = $(this).data('penguasaanmateri2');
		            var materi3 = $(this).data('penguasaanmateri3');
		            var presentasi1 = $(this).data('presentasi1');
		            var presentasi2 = $(this).data('presentasi2');
		            var presentasi3 = $(this).data('presentasi3');

		            $('#EditktiNim').val(NIM);
		            $('#EditktiNama').val(nama_mahasiswa);
		            $('#EditktiDosen1').val(dosen1);
		            $('#EditktiDosen2').val(dosen2);
		            $('#EditktiDosen3').val(dosen3);

		            $('#nilaiisi1').val(isi1);
		            $('#nilaimetodologi1').val(metode1);
		            $('#nilaimateri1').val(materi1);
		            $('#nilaipresentasi1').val(presentasi1);
		            $('#nilaiisi2').val(isi2);
		            $('#nilaimetodologi2').val(metode2);
		            $('#nilaimateri2').val(materi2);
		            $('#nilaipresentasi2').val(presentasi2);
		            $('#nilaiisi3').val(isi3);
		            $('#nilaimetodologi3').val(metode3);
		            $('#nilaimateri3').val(materi3);
		            $('#nilaipresentasi3').val(presentasi3);

		            $('#hiddennim').val(NIM);
		            $('#hiddenDosen1').val(dosen1);
		            $('#hiddennama').val(namamahasiswa);
		        });
		    </script>

		    <?php
		    if (isset($_POST['ubahnilaikti'])) 
		    {
		        $sql = "UPDATE kti SET 
		        penulisanisi1 = '$_POST[nilaiisi1]',
		        metodologi1 = '$_POST[nilaimetodologi1]',
		        penguasaanmateri1 = '$_POST[nilaimateri1]',
		        presentasi1 = '$_POST[nilaipresentasi1]',
		        penulisanisi2 = '$_POST[nilaiisi2]',
		        metodologi2 = '$_POST[nilaimetodologi2]',
		        penguasaanmateri2 = '$_POST[nilaimateri2]',
		        presentasi2 = '$_POST[nilaipresentasi2]',
		        penulisanisi3 = '$_POST[nilaiisi3]',
		        metodologi3 = '$_POST[nilaimetodologi3]',
		        penguasaanmateri3 = '$_POST[nilaimateri3]',
		        presentasi3 = '$_POST[nilaipresentasi3]',
		        nilaiakhir = '',
		        nilaiakhirhuruf = ''
		        WHERE nim = '$_POST[hiddennim]'";
		        if (mysqli_query($conn, $sql)) 
		        {
		            echo "<meta http-equiv='refresh' content='0'>";
		        }
		    }
		    ?>


		    <!-- Detail Modal -->
		    <div class="modal fade" id="ViewDataktiModal" role="dialog">
		        <div class="modal-dialog">
		            <div class="modal-content">
		                <div class="modal-header">
		                    <h4 class="modal-title">Detail KTI</h4>
		                    <button type="button" class="close" data-dismiss="modal">&times;</button>
		                </div>
		                <div class="modal-body">
		                    <div class="card-body">
		                        <div class="viewdetailkti"></div>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>

		    <!-- Show Detail Mahasiswa -->
		    <script type="text/javascript">
		        $(document).ready(function()
		        {
		            $('#ViewDataktiModal').on('show.bs.modal', function (e) 
		            {
		                var nim = $(e.relatedTarget).data('nimmahasiswa');
		                //menggunakan fungsi ajax untuk pengambilan data
		                $.ajax(
		                {
		                    type : 'post',
		                    url : 'detailkti.php',
		                    data :  'nim='+ nim,
		                    success : function(data)
		                    {
		                        $('.viewdetailkti').html(data);//menampilkan data ke dalam modal
		                    }
		                });
		            });
		        });
		    </script> 


		    <!-- kumpul berkas -->
		    <div class="modal fade" id="KumpulBerkasModal" role="dialog">
		        <div class="modal-dialog">
		            <div class="modal-content">
		                <div class="modal-header">
		                    <h4 class="modal-title">Kumpul Berkas KTI</h4>
		                    <button type="button" class="close" data-dismiss="modal">&times;</button>
		                </div>
		                <div class="modal-body">
		                    <div class="card-body">
		                       <form id="formdosen" method="POST">
		                         <input type="hidden" class="form-control" name="nimhidden" id="nimhidden" type="text"
		                         aria-describedby="nameHelp">
		                         <input type="hidden" class="form-control" name="hiddenNama" id="hiddenNama" type="text"
		                         aria-describedby="nameHelp">
		                         <input type="hidden" class="form-control" name="hiddenbatas" id="hiddenbatas" type="text"
		                         aria-describedby="nameHelp">
		                         <input type="hidden" class="form-control" name="hiddennilaitemp" id="hiddennilaitemp" type="text"
		                         aria-describedby="nameHelp">

		                         <div class="input-group mb-3">
		                            <div class="input-group-prepend">
		                                <label class="input-group-text" for="inputGroupSelect01">NIM</label>
		                            </div>
		                            <input class="form-control" name="EditNim" id="EditNim" type="text"
		                            aria-describedby="nameHelp" disabled="">
		                        </div>
		                        <div class="input-group mb-3">
		                            <div class="input-group-prepend">
		                                <label class="input-group-text" for="inputGroupSelect01">Nama Mahasiswa</label>
		                            </div>
		                            <input class="form-control" name="EditNama" id="EditNama" type="text"
		                            aria-describedby="nameHelp" disabled="">
		                        </div>
		                        <div class="input-group mb-3">
		                            <div class="input-group-prepend" data-provide='datetimepicker1'>
		                                <label class="input-group-text">Tanggal Kumpul Berkas KTI</label>
		                            </div>
		                            <input type='text' class="form-control" id="tanggalkumpul" name="tanggalkumpul"  placeholder="DD/MM/YYY"  />
		                        </div>
		                        <button type="submit" name="UpdateKumpulBerkas" class="btn btn-info btn-lg" >Simpan</button>
		                    </form>
		                </form>
		            </div>
		        </div>
		    </div>

		<!-- berita acara kti -->
		<script type="text/javascript">
		    $(document).on("click", "#kumpulberkas", function () {
		        var NIM = $(this).data('nimmahasiswa');
		        var nama_mahasiswa = $(this).data('namamahasiswa');
		        var judulKTI = $(this).data('judulkti');
		        var bataskumpul = $(this).data('bataskumpul');
		        var nilaitemp = $(this).data('nilaitemp');
		        $('#EditNim').val(NIM);
		        $('#EditNama').val(nama_mahasiswa);
		        $('#EditJudul').val(judulKTI);

		        $('#nimhidden').val(NIM);
		        $('#hiddenNama').val(nama_mahasiswa);
		        $('#hiddenJudul').val(judulKTI);
		        $('#hiddenbatas').val(bataskumpul);
		        $('#hiddennilaitemp').val(nilaitemp);
		    });
		</script>
		<!-- datepicker -->
		<script>
		    $(document).ready(function () {
		        var date_input = $('input[name="tanggalkumpul"]');
		        var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
		        var options = {
		            format: 'dd/mm/yyyy',
		            orientation: 'bottom',
		            todayHighlight: true,
		            autoclose: true,
		        };
		        date_input.datepicker(options);
		    });
		</script>

		<?php
		if(isset($_POST['UpdateKumpulBerkas']))
		{
		    $daysLeft = 0;
		    $initValue = $_POST['hiddennilaitemp'];
		    $fromDate = $_POST['hiddenbatas']; //tgl batas
		    $curDate = $_POST['tanggalkumpul']; //tgl kumpul

		    echo "start value : ".$initValue."<br>";
		    //start date
		    $date = DateTime::createFromFormat('d/m/Y',$fromDate);
		    $date1 = $date->format('Y-m-d'); 
		    echo  "Batas Kumpul : ".$date1."<br>";

		    //end date
		    $tgl = DateTime::createFromFormat('d/m/Y',$curDate);
		    $date2 = $tgl->format('Y-m-d'); 
		    echo  "Tanggal Kumpul :".$date2."<br>";

		    $daysLeft = strtotime($date2) - strtotime($date1);
		    $days = $daysLeft/(60 * 60 * 24);

		    //echo $new1."<br>".$new2."<br>";    
		    printf("Days difference between %s and %s = %d", $date1, $date2, $days);

		    // calculate degradation value based on every 30 days
		    //check if days > 0 
		     if($days>0)
		     {
		        //getvalue for comprasion
		        if($initValue == 'A')
		        {
		            $temp_divide = $days/30;
		            echo "<br>".$temp_divide;
		            if($temp_divide >0 && $temp_divide <=1)
		            {
		                $initValue = "A-";
		            }
		            else if($temp_divide >1 && $temp_divide <=2)
		            {
		                //downgrade 2
		                $initValue = "B+";
		            }
		            else if($temp_divide >2 && $temp_divide <=3)
		            {
		                //downgrade 2
		                $initValue = "B";
		            }
		            else if($temp_divide >3 && $temp_divide <=4)
		            {
		                //downgrade 2
		                $initValue = "B-";
		            }
		            else if($temp_divide >4 && $temp_divide <=5)
		            {
		                //downgrade 2
		                $initValue = "C+";
		            }
		            else if($temp_divide >4 && $temp_divide <=6)
		            {
		                //downgrade 2
		                $initValue = "C";
		            }
		            else 
		            {
		                //downgrade 2
		                $initValue = "Tidak Lulus";
		            }
		        }else
		        if($initValue == 'A-')
		        {
		            $temp_divide = $days/30;
		            if($temp_divide >0 && $temp_divide <=1)
		            {
		                $initValue = "B+";
		            }
		            else if($temp_divide >1 && $temp_divide <=2)
		            {
		                //downgrade 2
		                $initValue = "B";
		            }
		            else if($temp_divide >2 && $temp_divide <=3)
		            {
		                //downgrade 2
		                $initValue = "B-";
		            }
		            else if($temp_divide >3 && $temp_divide <=4)
		            {
		                //downgrade 2
		                $initValue = "C+";
		            }
		            else if($temp_divide >4 && $temp_divide <=5)
		            {
		                //downgrade 2
		                $initValue = "C";
		            }
		            else 
		            {
		                //downgrade 2
		                $initValue = "Tidak Lulus";
		            }
		        }
		        else
		        if($initValue == 'B+')
		        {
		            $temp_divide = $days/30;
		            if($temp_divide >0 && $temp_divide <=1)
		            {
		                $initValue = "B";
		            }
		            else if($temp_divide >1 && $temp_divide <=2)
		            {
		                //downgrade 2
		                $initValue = "B-";
		            }
		            else if($temp_divide >2 && $temp_divide <=3)
		            {
		                //downgrade 2
		                $initValue = "C+";
		            }
		            else if($temp_divide >3 && $temp_divide <=4)
		            {
		                //downgrade 2
		                $initValue = "C-";
		            }
		            else 
		            {
		                //downgrade 2
		                $initValue = "Tidak Lulus";
		            }
		        }
		        else
		        if($initValue == 'B')
		        {
		            $temp_divide = $days/30;
		            if($temp_divide >0 && $temp_divide <=1)
		            {
		                $initValue = "B-";
		            }
		            else if($temp_divide >1 && $temp_divide <=2)
		            {
		                //downgrade 2
		                $initValue = "C+";
		            }
		            else if($temp_divide >2 && $temp_divide <=3)
		            {
		                //downgrade 2
		                $initValue = "C";
		            }else{
		                $initValue = "Tidak Lulus";
		            }
		        }
		        else
		        if($initValue == 'B-')
		        {
		            $temp_divide = $days/30;
		            if($temp_divide >0 && $temp_divide <= 1)
		            {
		                $initValue = "C+";
		            }
		            else if($temp_divide >1 && $temp_divide <=2)
		            {
		                //downgrade 2
		                $initValue = "C";
		            }else{
		                $initValue = "Tidak Lulus";
		            }
		        }
		        else
		        if($initValue == 'C+')
		        {
		            $temp_divide = $days/30;
		            if($temp_divide >0 && $temp_divide <= 1)
		            {
		                $initValue = "C";
		            }
		            else
		            {
		                //downgrade 2
		                $initValue = "Tidak Lulus";
		            }
		        }
		        else
		        if($initValue == 'C')
		        {
		            $temp_divide = $days/30;
		            if($temp_divide >0 && $temp_divide <= 1)
		            {
		                $initValue = "Tidak Lulus";
		            }
		        }
		    }
		    // //days <0
		    else
		    {
		        $initValue = $initValue;
		    }

		    echo "<br>Nilai Akhir :".$initValue;

		    $sql = "UPDATE kti SET tgl_kumpul = '$_POST[tanggalkumpul]',nilaiakhirhuruf='$initValue'
		    WHERE kti.nim = '$_POST[nimhidden]'";
		    if (mysqli_query($conn, $sql)) 
		    {
		      echo "<meta http-equiv='refresh' content='0'>";
		  	} 
}
?>