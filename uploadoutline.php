<?php
@include "dbconnect.php";
// menggunakan class phpExcelReader
@include "excelreader/excel_reader2.php";

   $semester = $_POST['semester'];
    // membaca file excel yang diupload
    $data = new Spreadsheet_Excel_Reader($_FILES['file']['tmp_name']);

    // membaca jumlah baris dari data excel
    $baris = $data->rowcount($sheet_index=0);
    echo $baris;
    // nilai awal counter untuk jumlah data yang sukses dan yang gagal diimport
    $sukses = 0;
    $gagal = 0;

    // import data excel mulai baris ke-2 (karena baris pertama adalah nama kolom)
    for ($i=2; $i<=$baris; $i++)
    {
      $nim = $data->val($i, 3);
      $judul = $data->val($i, 4);
      $pertanyaan_penelitian = $data->val($i, 5);
      $manfaat_penelitian = $data->val($i, 6);
      $desain_penelitian = $data->val($i, 7);
      $sample_penelitian = $data->val($i, 8);
      $variabel_bebas = $data->val($i, 9);
      $variabel_tergantung = $data->val($i, 10);
      $hipotesis = $data->val($i, 11);
      $tgl_pengajuan = $data->val($i, 1);
      $kk1 = $data->val($i, 12);
      $kk2 = $data->val($i, 13);
      $kk3 = $data->val($i, 14);
      
      // setelah data dibaca, sisipkan ke dalam tabel outline
      $query = "INSERT INTO outline (nim,judul_outline,pertanyaan_penelitian,manfaat_penelitian,desain_penelitian,sample_penelitian,variabel_bebas,variabel_tergantung,hipotesis ,usulan_dosen1,usulan_dosen2,tgl_pengajuan,status,semester,kk1,kk2,kk3) VALUES ('$nim','$judul','$pertanyaan_penelitian','$manfaat_penelitian','$desain_penelitian','$sample_penelitian','$variabel_bebas','$variabel_tergantung','$hipotesis','0','0','$tgl_pengajuan','','$semester','$kk1','$kk2','$kk3')";
      $result = $conn->query($query);
      
      // jika proses insert data sukses, maka counter $sukses bertambah
      // jika gagal, maka counter $gagal yang bertambah
      if ($result) $sukses++;
      else $gagal++;
    }

    header("location:lihatdataoutline.php");
?>
