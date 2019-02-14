<?php
global $tmp_isi,$tmp_metode,$tmp_materi,$tmp_presentasi;
@include ("dbconnect.php");
if($_POST['nim']){
    $sql = "SELECT * FROM dosen,mahasiswa, nilai_perdosen,assign_sk WHERE assign_sk.id_dosen = nilai_perdosen.id_dosen AND dosen.id_dosen = nilai_perdosen.id_dosen AND mahasiswa.nim = nilai_perdosen.nim AND assign_sk.nim = '".$_POST['nim']."' AND nilai_perdosen.nim = '".$_POST['nim']."' LIMIt 0,1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            ?>
            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                <tr>
                    <td width="25%">Nim</td>
                    <td><?= $row['nim'];?></td>
                </tr>
                <tr>
                    <td>Nama Mahasiswa</td>
                    <td><?= $row['nama'];?></td>
                </tr>
            </table>
<?php
        }
    }
}

if($_POST['nim']){
        $sql = "SELECT * FROM dosen,mahasiswa, nilai_perdosen,assign_sk,batas_waktu,kumpul_berkas
        WHERE assign_sk.id_dosen = nilai_perdosen.id_dosen AND dosen.id_dosen = nilai_perdosen.id_dosen
        AND mahasiswa.nim = nilai_perdosen.nim
        AND assign_sk.nim = '".$_POST['nim']."'
        AND batas_waktu.nim = '".$_POST['nim']."'
        AND kumpul_berkas.nim = '".$_POST['nim']."'
        AND nilai_perdosen.nim = '".$_POST['nim']."'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
?>
            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                <tr>
                    <td width="20%"><?=$row['assign_dosen'];?></td>
                    <th colspan="4"><?=$row['gelar_depan']." ".$row['nama_dosen']." ".$row['gelar_belakang'];?></th>
                </tr>
                <tr>
                    <th width="20%">Nilai Penulisan Isi</th>
                    <th width="20%">Nilai Metodologi</th>
                    <th width="20%">Nilai Penguasaan Materi</th>
                    <th width="20%">Nilai Presentasi</th>
                </tr>
                <tr>
                    <td><?=$row['nilai_perdosen_isi']; ?></td>
                    <td><?=$row['nilai_perdosen_metode']; ?></td>
                    <td><?=$row['nilai_perdosen_materi']; ?></td>
                    <td><?=$row['nilai_perdosen_presentasi']; ?></td>
                </tr>
            </table>
            <?php
            $tmp_isi += $row['nilai_perdosen_isi'];
            $tmp_materi += $row['nilai_perdosen_metode'];
            $tmp_metode += $row['nilai_perdosen_materi'];
            $tmp_presentasi += $row['nilai_perdosen_presentasi'];
            $tgl_kumpul =$row['tgl_kumpulberkas'];
            $batas_kumpul = $row['batas_kumpulberkas'];

            $final_isi = $tmp_isi/3;
            $final_materi = $tmp_materi/3;
            $final_metode = $tmp_metode/3;
            $final_presentasi = $tmp_presentasi/3;
            }
        }
    }
    //proses nilai akhir kti mahasiswa
    // 1. get all nilai from tabel nilai_perdosen by nim
    // 2. get all batas waktu from batas_kumpul
    // 3. get tgl kumpul from kumpul_berkas
    // do calculation and compare if tgl kumpul > batas_kumpul then down grade nilai
?>
    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
            <tr>
                <th width="20%">Nilai Akhir Penulisan Isi </th>
                <th width="20%">Nilai Akhir Metodologi</td></th>
                <th width="20%">Nilai Akhir Penguasaan Materi</th>
                <th width="20%">Nilai Presentasi</th>
                <th width="20%">Nilai Angka</th>
                <th width="20%">Nilai Huruf</th>
            </tr>
            <tr>
                <td><?=$final_isi; ?></td>
                <td><?=$final_materi; ?></td>
                <td><?=$final_metode; ?></td>
                <td><?=$final_presentasi; ?></td>
                <td><?php
                        $nilai_angka = $final_isi + $final_materi + $final_metode + $final_presentasi;
                        echo $nilai_angka;

                        if($nilai_angka>=85 && $nilai_angka<=100){
                            $nilaihurufblmkumpul =  "A";
                            //echo $nilaihurufblmkumpul;
                        }else if($nilai_angka<=84.99 && $nilai_angka >=80){
                            $nilaihurufblmkumpul =  "A-";
                           // echo $nilaihurufblmkumpul;
                        }else if($nilai_angka<=79.99 && $nilai_angka >=75){
                            $nilaihurufblmkumpul =  "B+";
                            //echo $nilaihurufblmkumpul;
                        }else if($nilai_angka<=74.99 && $nilai_angka >=70){
                            $nilaihurufblmkumpul =  "B";
                            //echo $nilaihurufblmkumpul;
                        }else if($nilai_angka<=69.99 && $nilai_angka >=65){
                            $nilaihurufblmkumpul =  "B-";
                            //echo $nilaihurufblmkumpul;
                        }else if($nilai_angka<=64.99 && $nilai_angka >=60){
                            $nilaihurufblmkumpul =  "C+";
                           // echo $nilaihurufblmkumpul;
                        }else if($nilai_angka<=59.99 && $nilai_angka >=55){
                            $nilaihurufblmkumpul = "C";
                            ///echo $nilaihurufblmkumpul;
                        }else{
                            $nilaihurufblmkumpul = "Tidak Lulus";
                            //echo $nilaihurufblmkumpul;
                        }
                    ?>
                </td>
                <td><?php
                //convert tgl kumpul to m/d/y
                // $tgl_kumpul as string
                // conv string to date
                $frontenddob =  $tgl_kumpul;
                list ($d,$m,$y) = explode('/', $frontenddob);
                $dob = sprintf("%02d/%02d/%04d", $m, $d, $y);

                $batas =  $batas_kumpul;
                list ($d,$m,$y) = explode('/', $batas);
                $batas_formatted = sprintf("%02d/%02d/%04d", $m, $d, $y);

                $newtgl = new DateTime(date($dob));
                $newbatas = new DateTime(date($batas_formatted));
                $selisih = $newbatas->diff($newtgl)->format("%a");

                if($newbatas<$newtgl){
                    if($selisih>=1 OR $selisih<=30)
                    {
                        if($nilai_angka>=85 && $nilai_angka<=100){
                            $nilaihuruf =  "A-";
                            echo $nilaihuruf;
                        }else if($nilai_angka<=84.99 && $nilai_angka >=80){
                            $nilaihuruf = "B+";
                            echo $nilaihuruf;
                        }else if($nilai_angka<=79.99 && $nilai_angka >=75){
                            $nilaihuruf = "B";
                            echo $nilaihuruf;
                        }else if($nilai_angka<=74.99 && $nilai_angka >=70){
                            $nilaihuruf = "B-";
                            echo $nilaihuruf;
                        }else if($nilai_angka<=69.99 && $nilai_angka >=65){
                            $nilaihuruf = "C+";
                            echo $nilaihuruf;
                        }else if($nilai_angka<=64.99 && $nilai_angka >=60){
                            $nilaihuruf = "C";
                            echo $nilaihuruf;
                        }else {
                            $nilaihuruf = "Tidak Lulus";
                            echo $nilaihuruf;
                        }
                    }elseif($selisih>=31 OR $selisih<=60){
                        if($nilai_angka>=85 && $nilai_angka<=100){
                            $nilaihuruf = "B+";
                            echo $nilaihuruf;
                        }else if($nilai_angka<=84.99 && $nilai_angka >=80){
                            $nilaihuruf = "B";
                            echo $nilaihuruf;
                        }else if($nilai_angka<=79.99 && $nilai_angka >=75){
                            $nilaihuruf = "B-";
                            echo $nilaihuruf;
                        }else if($nilai_angka<=74.99 && $nilai_angka >=70){
                            $nilaihuruf = "C+";
                            echo $nilaihuruf;
                        }else if($nilai_angka<=69.99 && $nilai_angka >=65){
                            $nilaihuruf = "C";
                            echo $nilaihuruf;
                        }else{
                            $nilaihuruf = "Tidak Lulus";
                            echo $nilaihuruf;
                        }
                    }elseif($selisih>=61 OR $selisih<=90){
                        if($nilai_angka>=85 && $nilai_angka<=100){
                            $nilaihuruf = "B";
                            echo $nilaihuruf;
                        }else if($nilai_angka<=84.99 && $nilai_angka >=80){
                            $nilaihuruf = "B-";
                            echo $nilaihuruf;
                        }else if($nilai_angka<=79.99 && $nilai_angka >=75){
                            $nilaihuruf = "C+";
                            echo $nilaihuruf;
                        }else if($nilai_angka<=74.99 && $nilai_angka >=70){
                            $nilaihuruf = "C";
                            echo $nilaihuruf;
                        }else {
                            $nilaihuruf = "Tidak Lulus";
                            echo $nilaihuruf;
                        }
                    }elseif($selisih>=91 OR $selisih<=120){
                        if($nilai_angka>=85 && $nilai_angka<=100){
                            $nilaihuruf = "B-";
                            echo $nilaihuruf;
                        }else if($nilai_angka<=84.99 && $nilai_angka >=80){
                            $nilaihuruf = "C+";
                            echo $nilaihuruf;
                        }else if($nilai_angka<=79.99 && $nilai_angka >=75){
                            $nilaihuruf = "C";
                            echo $nilaihuruf;
                        }else{
                            $nilaihuruf = "Tidak Lulus";
                            echo $nilaihuruf;
                        }
                    }elseif($selisih>=121 OR $selisih<=150){
                        if($nilai_angka>=85 && $nilai_angka<=100){
                            $nilaihuruf = "C+";
                            echo $nilaihuruf;
                        }else if($nilai_angka<=84.99 && $nilai_angka >=80){
                            $nilaihuruf = "C";
                            echo $nilaihuruf;
                        }else {
                            $nilaihuruf = "Tidak Lulus";
                            echo $nilaihuruf;
                        }
                    }elseif($selisih>=151 OR $selisih<=180){
                        if($nilai_angka>=85 && $nilai_angka<=100){
                            $nilaihuruf = "C";
                            echo $nilaihuruf;
                        }else {
                            $nilaihuruf = "Tidak Lulus";
                            echo $nilaihuruf;
                        }
                    }
                }else{
                    if($nilai_angka>=85 && $nilai_angka<=100){
                        $nilaihuruf =  "A";
                        echo $nilaihuruf;
                    }else if($nilai_angka<=84.99 && $nilai_angka >=80){
                        $nilaihuruf =  "A-";
                        echo $nilaihuruf;
                    }else if($nilai_angka<=79.99 && $nilai_angka >=75){
                        $nilaihuruf =  "B+";
                        echo $nilaihuruf;
                    }else if($nilai_angka<=74.99 && $nilai_angka >=70){
                        $nilaihuruf =  "B";
                        echo $nilaihuruf;
                    }else if($nilai_angka<=69.99 && $nilai_angka >=65){
                        $nilaihuruf =  "B-";
                        echo $nilaihuruf;
                    }else if($nilai_angka<=64.99 && $nilai_angka >=60){
                        $nilaihuruf =  "C+";
                        echo $nilaihuruf;
                    }else if($nilai_angka<=59.99 && $nilai_angka >=55){
                        $nilaihuruf = "C";
                        echo $nilaihuruf;
                    }else{
                        $nilaihuruf = "Tidak Lulus";
                            echo $nilaihuruf;
                    }
                }
                ?>
                </td>
            </tr>
            <tr>
            <th colspan="4">
            <?php
            if($newbatas<$newtgl){
                echo "<span style='color:red;text-align:center;'>Terlambat Mengumpulkan : ".$selisih." hari</span>";
            } else{
                echo " Tidak Terlambat Mengumpulkan";
            }
            ?>
            <input type="hidden" name="final_isi" value="<?=$final_isi; ?>">
            <input type="hidden" name="final_materi" value="<?=$final_materi; ?>">
            <input type="hidden" name="final_metode" value="<?=$final_metode; ?>">
            <input type="hidden" name="final_presentasi" value="<?=$final_presentasi; ?>">
            <input type="hidden" name="angka" value="<?=$nilai_angka; ?>">
            <input type="hidden" name="huruf_sblm" value="<?=$nilaihurufblmkumpul; ?>">
            <input type="hidden" name="huruf_kumpul" value="<?=$nilaihuruf; ?>">
            <input type="hidden" name="nim" value="<?=$_POST['nim']; ?>">
            </th></tr>
    </table>
