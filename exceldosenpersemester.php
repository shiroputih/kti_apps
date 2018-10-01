<?php  
@include"dbconnect.php";
$output = '';
$no =1;
if(isset($_POST["export"]))
{
 $query = "SELECT dosen.gelar_depan,dosen.nama_dosen,dosen.gelar_belakang,sk1.nim,mahasiswa.nama FROM sk1,mahasiswa,dosen WHERE sk1.id_dosen1 = dosen.id_dosen AND sk1.nim = mahasiswa.nim AND sk1.id_semester = '".$_POST['semester']."'";
 $result = mysqli_query($conn, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr><b>Dosen Pembimbing 1<b>
                    </tr>
                    <tr>  
                         <th>No</th>  
                         <th>Nama Dosen</th>
                         <th>NIM</th>  
                         <th>Nama Mahasiswa</th>  
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>  
                         <td>'.$no.'</td>  
                         <td>'.$row['gelar_depan']." ".$row['nama_dosen']." ".$row['gelar_belakang'].'</td>  
                         <td>'.$row['nim'].'</td>
                         <td>'.$row['nama'].'</td>  
       
                    </tr>
   ';
   $no++;
  }
  $output .= '</table> <br><br>';
  }

  $no=1;
  $query = "SELECT dosen.gelar_depan,dosen.nama_dosen,dosen.gelar_belakang,sk2.nim,mahasiswa.nama FROM sk2,mahasiswa,dosen WHERE sk2.id_dosen2 = dosen.id_dosen AND sk2.nim = mahasiswa.nim AND sk2.id_semester = '".$_POST['semester']."'";
 $result = mysqli_query($conn, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr><b>Dosen Pembimbing 2<b>
                    </tr>
                    <tr>  
                         <th>No</th>  
                         <th>Nama Dosen</th>
                         <th>NIM</th>  
                         <th>Nama Mahasiswa</th>  
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>  
                         <td>'.$no.'</td>  
                         <td>'.$row['gelar_depan']." ".$row['nama_dosen']." ".$row['gelar_belakang'].'</td>  
                         <td>'.$row['nim'].'</td>
                         <td>'.$row['nama'].'</td>  
       
                    </tr>
   ';
   $no++;
  }
  $output .= '</table>';

  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=dosenpersemester.xls');
  echo $output;
 }
}
?>