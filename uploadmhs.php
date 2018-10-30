<?php
@include "dbconnect.php";
// menggunakan class phpExcelReader
@include "excelreader/excel_reader2.php";

// membaca file excel yang diupload
$data = new Spreadsheet_Excel_Reader($_FILES['file']['tmp_name']);

// membaca jumlah baris dari data excel
$baris = $data->rowcount($sheet_index=0);

// nilai awal counter untuk jumlah data yang sukses dan yang gagal diimport
$sukses = 0;
$gagal = 0;

// import data excel mulai baris ke-2 (karena baris pertama adalah nama kolom)
for ($i=2; $i<=$baris; $i++)
{
  // membaca data nim (kolom ke-1)
  $nim = $data->val($i, 1);
  // membaca data nama (kolom ke-2)
  $nama = $data->val($i, 2);
  
  // setelah data dibaca, sisipkan ke dalam tabel mhs
  $query = "INSERT INTO mahasiswa VALUES ('$nim', '$nama')";
  $result = $conn->query($query);

  // jika proses insert data sukses, maka counter $sukses bertambah
  // jika gagal, maka counter $gagal yang bertambah
  if ($result) $sukses++;
  else $gagal++;
}

header("location:mahasiswa.php");

?>