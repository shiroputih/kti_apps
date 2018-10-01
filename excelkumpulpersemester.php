<?php  
@include"dbconnect.php";
$output = '';
$no =1;
if(isset($_POST["export"]))
{
 $query = "SELECT kti.nim,kti.judulkti,mahasiswa.nama,d1.gelar_depan AS d1depan,d1.gelar_belakang AS d1belakang,d2.gelar_depan AS d2depan,d2.gelar_belakang AS d2belakang,d3.gelar_depan AS d3depan,d3.gelar_belakang AS d3belakang,d1.nama_dosen as nmdosen1, d2.nama_dosen as nmdosen2, d3.nama_dosen AS nmdosen3,kti.tgl_kumpul from dosen d1, dosen d2, dosen d3, kti,mahasiswa where d1.id_dosen <> d2.id_dosen AND d1.id_dosen<>d3.id_dosen and d1.id_dosen = kti.dosen1 AND d2.id_dosen = kti.dosen2 AND d3.id_dosen = kti.penguji AND kti.tgl_kumpul IS NOT NULL AND mahasiswa.nim = kti.nim AND kti.idsemester = '".$_POST['semester']."'group by kti.nim";
 
 $result = mysqli_query($conn, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr><b>Mahasiswa Kumpul Berkas KTI<b>
                    </tr>
                    <tr>  
                         <th>No</th>  
                         <th>NIM</th>
                         <th>Nama Mahasiswa</th> 
                         <th>Dosen Pembimbing 1</th> 
                         <th>Dosen Pembimbing 2</th> 
                         <th>Dosen Penguji</th> 
                         <th>Judul KTI</th> 
                         <th>Tanggal Kumpul Berkas</th>  
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
                        <tr>  
                         <td>'.$no.'</td>  
                         <td>'.$row['nim'].'</td>
                         <td>'.$row['nama'].'</td> 
                         <td>'.$row['d1depan']."".$row['nmdosen1']."". $row['d1belakang'].'</td>
                         <td>'.$row['d2depan'] ."".$row['nmdosen2']."". $row['d2belakang'].'</td>
                         <td>'.$row['d3depan'] ."".$row['nmdosen3'] ."".$row['d3belakang'].'</td>
                         <td>'.$row['judulkti'].'</td>
                         <td>'.$row['tgl_kumpul'].'</td> 
       
                    </tr>
   ';
   $no++;
  }
  $output .= '</table>';

  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=kumpulberkas_persemester.xls');
  echo $output;
  }
}
?>