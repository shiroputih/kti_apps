<?php
@include"dbconnect.php";
$output = '';

if(isset($_POST["export"])){
     $query = "SELECT tahunajaran,dosen.gelar_depan,dosen.nama_dosen,dosen.gelar_belakang,assign_sk.nim,mahasiswa.nama FROM assign_sk,mahasiswa,dosen,tahunajaran
     WHERE assign_sk.id_dosen = dosen.id_dosen
     AND assign_sk.nim = mahasiswa.nim
     AND assign_sk.assign_dosen ='pembimbing 1'
     AND assign_sk.id_tahunajaran = '".$_POST['tahunajaran']."'
     AND assign_sk.id_tahunajaran = tahunajaran.id_tahunajaran
     GROUP BY assign_sk.id_dosen ORDER BY dosen.nama_dosen ASC ";
     $result = mysqli_query($conn, $query);
     if(mysqli_num_rows($result) > 0)
     {
          $no =1;
          $output .= '
          <table class="table" border="1">
               <tr><b>DAFTAR DOSEN PEMBIMBING TAHUN AJARAN<b><br>
               <b>DOSEN PEMBIMBING 1<b></tr>
               <tr>
                    <th>No</th>
                    <th>Nama Dosen</th>
                    <th>NIM</th>
                    <th>Dosen pembimbing 1</th>
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
                    <td>'.$row['tahunajaran'].'</td>
               </tr>';
               $no++;
          }
               $output .= '</table> <br><br>';
     }

     $query = "SELECT tahunajaran,dosen.gelar_depan,dosen.nama_dosen,dosen.gelar_belakang,assign_sk.nim,mahasiswa.nama FROM assign_sk,mahasiswa,dosen,tahunajaran
     WHERE assign_sk.id_dosen = dosen.id_dosen
     AND assign_sk.nim = mahasiswa.nim
     AND assign_sk.assign_dosen ='pembimbing 2'
     AND assign_sk.id_tahunajaran = '".$_POST['tahunajaran']."'
     AND assign_sk.id_tahunajaran = tahunajaran.id_tahunajaran
     GROUP BY assign_sk.id_dosen ORDER BY dosen.nama_dosen ASC ";
     $result = mysqli_query($conn, $query);
     if(mysqli_num_rows($result) > 0)
     {
          $no =1;
          $output .= '
          <table class="table" border="1">
                <tr><b>DAFTAR DOSEN PEMBIMBING TAHUN AJARAN<b><br>
                <b>DOSEN PEMBIMBING 2<b></tr>
                <tr>
                    <th>No</th>
                    <th>Nama Dosen</th>
                    <th>NIM</th>
                    <th>Dosen pembimbing 2</th>
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
                    <td>'.$row['tahunajaran'].'</td>
               </tr>';
               $no++;
          }
               $output .= '</table> <br><br>';
     }
}
$output .= '</table>';

header('Content-Type: application/xls');
header('Content-Disposition: attachment; filename=dosenpertahunajaran.xls');
echo $output;

?>