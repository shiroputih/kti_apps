<?php
  session_start();
  @include "dbconnect.php";
  @include ("header.php");
  @include ("navigation.php");
?>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <div class="content-wrapper">
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="dashboard.php">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">My Dashboard</li>
        </ol>
    </div>

    <!-- card notification -->
    <div class="row-content">
      <div class="col-xl-2 col-sm-6 mb-3">
          <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-3">
                  <?php
                        $sql = "SELECT * FROM outline where outline.tgl_disetujui IS NULL ";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0)
                        {
                          echo $result->num_rows;
                        }
                        else{
                          echo '0';
                        }
                      ?> Mahasiswa Belum Terverifikasi
                </div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="verifikasioutline.php">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fa fa-angle-right"></i>
                  </span>
              </a>
          </div>
      </div>
      <div class="col-xl-2 col-sm-6 mb-3">
          <div class="card text-white bg-warning o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-list"></i>
              </div>
              <div class="mr-5">
                <?php
                  $sql = "SELECT * FROM proposal where proposal.status_proposal IS NULL";
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0)
                  {
                    echo $result->num_rows;
                  } else {
                    echo "0";
                  }

                ?> Mahasiswa Belum Sidang Proposal
              </div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="beritaacaraproposal.php">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
      </div>
      <div class="col-xl-2 col-sm-6 mb-3">
          <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-shopping-cart"></i>
              </div>
              <div class="mr-5">
                <?php
                  $sql = "SELECT * FROM semhas where semhas.status_semhas IS NULL";
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0)
                  {
                    echo $result->num_rows;
                  } else {
                    echo "0";
                  }

                ?> Mahasiswa Belum Seminar Hasil
              </div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="beritaacarasemhas.php">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
      </div>
      <div class="col-xl-2 col-sm-6 mb-3">
          <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-support"></i>
              </div>
              <div class="mr-5"><?php
                  $sql = "SELECT * FROM kti where kti.status_kti IS NULL";
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0)
                  {
                    echo $result->num_rows;
                  } else {
                    echo "0";
                  }

                ?> Mahasiswa Belum Ujian KTI
              </div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="beritaacarakti.php">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
      </div>
      <!-- Graph -->
      <div class="row-child">
        <div class="card mb-1">
              <div class="card-graphheader">
                <i class="fa fa-area-chart"></i> Grafik Karya Tulis Ilmiah Per Semester
              </div>
              <div class="card-body">
                <canvas id="myChart" width="150" height="80"></canvas>
                <?php
                $datasemester= mysqli_query($conn, "SELECT semester FROM semester WHERE semester.id_semester != '0' order by id_semester asc");
                $jumlah = mysqli_query($conn, "SELECT kti.idsemester,count(kti.idsemester) as num
                FROM kti,semester
                where kti.status_kti ='Lolos'
                AND kti.idsemester = semester.id_semester
                AND semester.id_semester != '0'
                GROUP by kti.idsemester ");
                ?>
                <script>
                  var ctx = document.getElementById("myChart");
                  var myChart = new Chart(ctx, {
                      type: 'bar',
                      responsive : true,
                      data: {
                          labels: [<?php while ($b = mysqli_fetch_array($datasemester)) { echo '"' . $b['semester'] . '",';}?>],
                          datasets: [{
                                  label: '# Mahasiswa Lolos KTI',
                                  data: [<?php while ($p = mysqli_fetch_array($jumlah)) { echo '"' . $p['num'] . '",';}?>],
                                  fillColor: "rgba(220,220,220,0.5)",
                                  strokeColor: "rgba(220,220,220,0.8)",
                                  highlightFill: "rgba(220,220,220,0.75)",
                                  highlightStroke: "rgba(220,220,220,1)",
                                  borderWidth: 1
                              }]
                      },
                      options: {

                          scales: {
                              yAxes: [{
                                      ticks: {
                                          min:0,
                                          stepSize: 10,
                                          beginAtZero: true
                                      }
                                  }]
                                }
                      }
                  });
                </script>
              </div>
            </div>


        <div class="card mb-1">
              <div class="card-graphheadersemhas">
                <i class="fa fa-area-chart"></i> Grafik Dosen Pembimbing KTI Per Semester
              </div>
              <div class="card-body">
                <canvas id="chartsemhas" ></canvas>
                <?php
                $Xdatasemester = mysqli_query($conn, "SELECT semester FROM assign_sk,semester
                WHERE semester.id_semester != '0' ORDER BY semester ASC");
                $Yjumlah = mysqli_query($conn, "SELECT semester,count(DISTINCT assign_sk.id_dosen) as num FROM assign_sk,semester
                WHERE semester.id_semester != '0'
                AND assign_sk.id_semester = semester.id_semester GROUP BY assign_sk.id_semester ");
                ?>
                <script>
                  var ctx = document.getElementById("chartsemhas");
                  var chartsemhas = new Chart(ctx, {
                      type: 'bar',
                      data: {
                          labels: [<?php while ($b = mysqli_fetch_array($Xdatasemester)) { echo '"' . $b['semester'] . '",';}?>],
                          datasets: [{
                                  label: '# Jumlah Dosen Pembimbing',
                                  data: [<?php while ($p = mysqli_fetch_array($Yjumlah)) { echo '"' . $p['num'] . '",';}?>],
                                  backgroundColor: [
                                      'rgba(255, 99, 132, 1)',
                                      'rgba(54, 162, 235, 1)',
                                      'rgba(255, 206, 86, 1',
                                      'rgba(75, 192, 192, 1)',
                                      'rgba(153, 102, 255,1)',
                                      'rgba(255, 159, 64, 1)'
                                  ],
                                  borderColor: [
                                      'rgba(255,99,132,1)',
                                      'rgba(54, 162, 235, 1)',
                                      'rgba(255, 206, 86, 1)',
                                      'rgba(75, 192, 192, 1)',
                                      'rgba(153, 102, 255, 1)',
                                      'rgba(255, 159, 64, 1)'
                                  ],
                                  borderWidth: 1
                              }]
                      },
                      options: {

                          scales: {
                              yAxes: [{
                                      ticks: {
                                          beginAtZero: true
                                      }
                                  }]
                          }
                      }
                  });
                </script>
              </div>
            </div>
            </div>







        <div class="row-child-upcoming-ujian-kti">
          <div class="card mb-1">
              <div class="card-graphheader">
                <i class="fa fa-area-chart"></i> Ujian KTI Terjadwal
              </div>
              <div class="card-body">
              <?php
                    $sql = "SELECT * FROM kti
                    JOIN mahasiswa ON mahasiswa.nim = kti.nim
                    JOIN ruangsidang ON ruangsidang.id_ruang = kti.id_ruangsidang

                    ORDER BY kti.tgl_ujiankti ASC LIMIT 0,3";
                    $result = mysqli_query($conn,$sql);
                    if($result->num_rows > 0 ){
                    foreach ($result as $row) {
                      ?>
                      <table>
                          <tr>
                              <td>Nim</td>
                              <td><?php echo $row['nim']; ?></td>
                          </tr>
                          <tr>
                              <td>Nama Mahasiswa</td>
                              <td><?php echo $row['nama']; ?></td>
                          </tr>
                          <tr>
                              <td>Tanggal dan Waktu</td>
                              <td><?php echo $row['tgl_ujiankti']." -- ".$row['waktupelaksanaan']."   WIB"; ?></td>
                          </tr>
                          <tr>
                              <td>Ruang</td>
                              <td><?php echo $row['ruangsidang']; ?></td>
                          </tr>
                      </table>
                      <hr>
                  <?php
                    }
                  }else{
                    echo "Belum ada mahasiswa yang mendaftar Ujian Karya Tulis Ilmiah";
                  }
                  ?>
              </div>
          </div>
          <div class="card mb-1">
              <div class="card-graphheadersemhas">
                <i class="fa fa-area-chart"></i> Seminar Hasil Terjadwal
              </div>
              <div class="card-body">
                <?php
                      $sql = "SELECT * FROM semhas
                      JOIN mahasiswa ON mahasiswa.nim = semhas.nim
                      JOIN ruangsidang ON ruangsidang.id_ruang = semhas.id_ruangsidang

                      GROUP BY semhas.nim
                      ORDER BY semhas.tgl_seminarhasil ASC LIMIT 0,3 ";
                      $result = mysqli_query($conn,$sql);
                      if($result->num_rows > 0 ){
                      foreach ($result as $row) {
                ?>
                        <table>
                            <tr>
                                <td>Nim</td>
                                <td><?php echo $row['nim']; ?></td>
                            </tr>
                            <tr>
                                <td>Nama Mahasiswa</td>
                                <td><?php echo $row['nama']; ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal dan Waktu</td>
                                <td><?php echo $row['tgl_seminarhasil']." -- ".$row['waktupelaksanaan']."   WIB"; ?></td>
                            </tr>
                            <tr>
                                <td>Ruang</td>
                                <td><?php echo $row['ruangsidang']; ?></td>
                            </tr>
                        </table>
                        <hr>
                    <?php
                        }
                      }else{
                        echo "Belum ada mahasiswa yang mendaftar seminar hasil";
                      }
                    ?>
              </div>
          </div>
          <div class="card mb-1">
            <div class="card-graphheadersempro">
              <i class="fa fa-area-chart"></i> Seminar Proposal Terjadwal
            </div>
            <div class="card-body">
            <?php
                  $sql = "SELECT * FROM proposal
                  JOIN mahasiswa ON mahasiswa.nim = proposal.nim
                  JOIN ruangsidang ON ruangsidang.id_ruang = proposal.id_ruangsidang

                  GROUP BY proposal.nim
                  ORDER BY proposal.tgl_sidangproposal ASC LIMIT 0,3 ";
                  $result = mysqli_query($conn,$sql);
                  if($result->num_rows > 0 ){
                  foreach ($result as $row) {
                    ?>
                    <table>
                        <tr>
                            <td>Nim</td>
                            <td><?php echo $row['nim']; ?></td>
                        </tr>
                        <tr>
                            <td>Nama Mahasiswa</td>
                            <td><?php echo $row['nama']; ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal dan Waktu</td>
                            <td><?php echo $row['tgl_sidangproposal']." -- ".$row['waktupelaksanaan']."   WIB"; ?></td>
                        </tr>
                        <tr>
                            <td>Ruang</td>
                            <td><?php echo $row['ruangsidang']; ?></td>
                        </tr>
                    </table>
                    <hr>
                <?php
                  }
                }else{
                  echo "Belum ada mahasiswa yang mendaftar seminar proposal";
                }
                ?>
            </div>
          </div>
          </div>
      </div>
</div>
</body>
<?php
@include("footer.php");
?>
