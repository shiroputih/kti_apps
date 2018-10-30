<?php
session_start();
@include "dbconnect.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php
    @include ("header.php");
    @include("navigation.php");
?>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="dashboard.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">My Dashboard</li>
      </ol>
      <!-- Icon Cards-->
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-comments"></i>
              </div>
              <div class="mr-5">
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
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-warning o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-list"></i>
              </div>
              <div class="mr-5">
                <?php 
                  $sql = "SELECT * FROM proposal where proposal.status IS NULL";
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
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-shopping-cart"></i>
              </div>
              <div class="mr-5">
                <?php 
                  $sql = "SELECT * FROM semhas where semhas.status IS NULL";
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
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-support"></i>
              </div>
              <div class="mr-5"><?php 
                  $sql = "SELECT * FROM kti where kti.status IS NULL";
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
    
    <!-- Example Notifications Card
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-bell-o"></i> Feed Example</div>
            <div class="list-group list-group-flush small">
              <a class="list-group-item list-group-item-action" href="#">
                <div class="media">
                  <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/45x45" alt="">
                  <div class="media-body">
                    <strong>David Miller</strong>posted a new article to
                    <strong>David Miller Website</strong>.
                    <div class="text-muted smaller">Today at 5:43 PM - 5m ago</div>
                  </div>
                </div>
              </a>
              <a class="list-group-item list-group-item-action" href="#">
                <div class="media">
                  <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/45x45" alt="">
                  <div class="media-body">
                    <strong>Samantha King</strong>sent you a new message!
                    <div class="text-muted smaller">Today at 4:37 PM - 1hr ago</div>
                  </div>
                </div>
              </a>
              <a class="list-group-item list-group-item-action" href="#">
                <div class="media">
                  <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/45x45" alt="">
                  <div class="media-body">
                    <strong>Jeffery Wellings</strong>added a new photo to the album
                    <strong>Beach</strong>.
                    <div class="text-muted smaller">Today at 4:31 PM - 1hr ago</div>
                  </div>
                </div>
              </a>
              <a class="list-group-item list-group-item-action" href="#">
                <div class="media">
                  <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/45x45" alt="">
                  <div class="media-body">
                    <i class="fa fa-code-fork"></i>
                    <strong>Monica Dennis</strong>forked the
                    <strong>startbootstrap-sb-admin</strong>repository on
                    <strong>GitHub</strong>.
                    <div class="text-muted smaller">Today at 3:54 PM - 2hrs ago</div>
                  </div>
                </div>
              </a>
              <a class="list-group-item list-group-item-action" href="#">View all activity...</a>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>
     -->
      <!-- Area Chart Example-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-area-chart"></i> Grafik Proposal Per Semester</div>
        <div class="card-body">
          <canvas id="myChart" width="100" height="30"></canvas>
          <?php
          $datasemester       = mysqli_query($conn, "SELECT semester FROM semester order by id_semester asc");
          $jumlah = mysqli_query($conn, "SELECT proposal.id_semester,count(proposal.id_semester) as num FROM proposal,semester where proposal.status='proposal' AND proposal.id_semester = semester.id_semester GROUP by proposal.id_semester ");
          ?>
          <script>
            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [<?php while ($b = mysqli_fetch_array($datasemester)) { echo '"' . $b['semester'] . '",';}?>],
                    datasets: [{
                            label: '# Peserta',
                            data: [<?php while ($p = mysqli_fetch_array($jumlah)) { echo '"' . $p['num'] . '",';}?>],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
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
      
       <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-area-chart"></i> Grafik Seminar Hasil Per Semester</div>
        <div class="card-body">
          <canvas id="chartsemhas" width="100" height="30"></canvas>
          <?php
          $Xdatasemester = mysqli_query($conn, "SELECT semester FROM semester order by id_semester asc");
          $Yjumlah = mysqli_query($conn, "SELECT semhas.idsemester,count(semhas.idsemester) as num FROM semhas,semester where semhas.status='semhas' AND semhas.idsemester = semester.id_semester GROUP by semhas.idsemester");
          ?>
          <script>
            var ctx = document.getElementById("chartsemhas");
            var chartsemhas = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: [<?php while ($b = mysqli_fetch_array($Xdatasemester)) { echo '"' . $b['semester'] . '",';}?>],
                    datasets: [{
                            label: '# Peserta',
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
      </div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
      <?php
      @include("footer.php");
      ?>>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript
    <script src="vendor/jquery/jquery.min.js"></script>-->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
    <script src="js/sb-admin-charts.min.js"></script>
  </div>
</body>

</html>
