<?php
@include"dbconnect.php";
$output = '';

if(isset($_POST["export"])){
    $query = "SELECT semester,dosen.gelar_depan,dosen.nama_dosen,dosen.gelar_belakang,assign_sk.nim,mahasiswa.nama FROM assign_sk,mahasiswa,dosen,semester
    WHERE assign_sk.id_dosen = dosen.id_dosen
    AND assign_sk.nim = mahasiswa.nim
    AND assign_sk.assign_dosen ='penguji'
    AND assign_sk.id_semester = '".$_POST['semester']."'
    AND assign_sk.id_semester = semester.id_semester
    GROUP BY assign_sk.id_dosen ORDER BY dosen.nama_dosen ASC ";
     $result = mysqli_query($conn, $query);
     if(mysqli_num_rows($result) > 0)
     {
          $no =1;
          $output .= '
          <table class="table" border="1">
               <tr><b>DAFTAR DOSEN PENGUJI PER TAHUN AJARAN<b><br>
               <b>DOSEN PENGUJI<b></tr>
               <tr>
                    <th>No</th>
                    <th>Nama Dosen</th>
                    <th>NIM</th>
                    <th>Dosen Penguji</th>
                    <th>Tahun Ajaran</th>
               </tr>';
          while($row = mysqli_fetch_array($result))
          {
               $output .= '
               <tr>
                    <td>'.$no.'</td>
                    <td>'.$row['gelar_depan']." ".$row['nama_dosen']." ".$row['gelar_belakang'].'</td>
                    <td>'.$row['nim'].'</td>
                    <td>'.$row['nama'].'</td>
                    <td>'.$row['semester'].'</td>
               </tr>';
               $no++;
          }
               $output .= '</table> <br><br>';
     }
}
$output .= '</table>';

header('Content-Type: application/xls');
header('Content-Disposition: attachment; filename=dosenpenguji.xls');
echo $output;

?>