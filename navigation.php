<?php
    session_start();
    if($_SESSION['loginas'] == 1){
?>
<!-- Login as Administrator -->
<html>
<head></head>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.html">Sistem Informasi KTI | <?php echo $_SESSION['namauser'];?></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                <a class="nav-link" href="dashboard.php">
                    <i class="fa fa-fw fa-dashboard"></i>
                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip"  data-placement="right" title="dosen">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapsedosen" data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-table"></i>
                    <span class="nav-link-text">Dosen</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapsedosen">
                    <li>
                        <a href="dosen.php">Data Dosen</a>
                    </li>
                    <li>
                        <a href="trackrecorddosen.php">Track Record Dosen</a>
                    </li>
                    <li>
                        <a href="dosenpersemester.php">Dosen Per Semester</a>
                    </li>
                    <li>
                        <a href="dosenpertahun.php">Dosen Per Tahun</a>
                    </li>
                    <li>
                        <a href="dosenpenguji.php">Daftar Penguji</a>
                    </li>
                    <li>
                        <a href="penerbitansk.php">Penerbitan SK</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item" data-toggle="tooltip"  data-placement="right" title="mahasiswa">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapsemahasiswa" data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-table"></i>
                    <span class="nav-link-text">Mahasiswa</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapsemahasiswa">
                    <li>
                        <a href="mahasiswa.php">Data Mahasiswa</a>
                    </li>
                    <li>
                        <a href="mahasiswapersemester.php">Mahasiswa Per Semester</a>
                    </li>
                    <li>
                        <a href="trackrecordmahasiswa.php">Track Record Mahasiswa</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item" data-toggle="tooltip"  data-placement="right" title="Outline">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseoutline" data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-table"></i>
                    <span class="nav-link-text">Outline</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseoutline">
                    <li>
                        <a href="lihatdataoutline.php">Data Outline</a>
                    </li>
                    <li>
                        <a href="cekjuduloutline.php">Plagiarisme</a>
                    </li>
                    <li>
                        <a href="verifikasioutline.php">Validasi Outline</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item" data-toggle="tooltip"  data-placement="right" title="proposal">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseproposal" data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-table"></i>
                    <span class="nav-link-text">Proposal</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseproposal">
                    <li>
                        <a href="lihatproposal.php">Data Proposal</a>
                    </li>
                    <li>
                        <a href="validasiproposal.php">Validasi Sidang Proposal</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Semhas">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseSemhas" data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-wrench"></i>
                    <span class="nav-link-text">Seminar Hasil</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseSemhas">
                    <li>
                        <a href="seminarhasil.php">Data Seminar Hasil</a>
                    </li>
                    <li>
                        <a href="validasisemhas.php">Validasi Seminar Hasil</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="KTI">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseKTI" data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-wrench"></i>
                    <span class="nav-link-text">Karya Tulis Ilmiah</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseKTI">
                    <li>
                        <a href="kti.php">Data KTI</a>
                    </li>
                    <li>
                        <a href="validasikti.php">Validasi Ujian KTI</a>
                    </li>
                    <li>
                        <a href="nilaikti.php">Nilai KTI</a>
                    </li>
                    <li>
                        <a href="kumpulberkas.php">Kumpul Berkas</a>
                    </li>
                    <li>
                        <a href="validasinilaiakhir.php">Validasi Nilai Akhir</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Link">
                <a class="nav-link" href="cetak.php">
                    <i class="fa fa-fw fa-link"></i>
                    <span class="nav-link-text">Cetak</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="KTI">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapsearsip" data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-wrench"></i>
                    <span class="nav-link-text">Arsip</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapsearsip">
                    <li>
                        <a href="arsipsk.php">Surat Keputusan</a>
                    </li>
                    <li>
                        <a href="mahasiswalulus.php">Mahasiswa Lulus</a>
                    </li>

                    <li>
                        <a href="arsipproposal.php">Berita Acara Proposal</a>
                    </li>
                    <li>
                        <a href="arsipsemhas.php">Berita Acara Seminar Hasil</a>
                    </li>
                    <li>
                        <a href="arsipkti.php">Berita Acara KTI</a>
                    </li>
                </ul>
            </li>
        </ul>
        <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
                <a class="nav-link text-center" id="sidenavToggler">
                    <i class="fa fa-fw fa-angle-left"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">

            <li class="nav-item">
                <a class="nav-link" href="logout.php">
                    <i class="fa fa-fw fa-sign-out"></i>Logout</a>
            </li>
        </ul>
    </div>
    </nav>
</html>
<?php
//login as tpj blok
    }elseif($_SESSION['loginas'] == 2){
?>
<html>
<head></head>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.html">Sistem Informasi KTI | <?php echo $_SESSION['namauser'];?></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                <a class="nav-link" href="dashboard.php">
                    <i class="fa fa-fw fa-dashboard"></i>
                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip"  data-placement="right" title="dosen">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapsedosen" data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-table"></i>
                    <span class="nav-link-text">Dosen</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapsedosen">
                    <!-- <li>
                        <a href="dosen.php">Data Dosen</a>
                    </li> -->
                    <li>
                        <a href="trackrecorddosen.php">Track Record Dosen</a>
                    </li>
                    <li>
                        <a href="dosenpersemester.php">Dosen Per Semester</a>
                    </li>
                    <li>
                        <a href="dosenpertahun.php">Dosen Per Tahun</a>
                    </li>
                    <li>
                        <a href="dosenpenguji.php">Daftar Penguji</a>
                    </li>
                    <li>
                        <a href="penerbitansk.php">Penerbitan SK</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item" data-toggle="tooltip"  data-placement="right" title="mahasiswa">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapsemahasiswa" data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-table"></i>
                    <span class="nav-link-text">Mahasiswa</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapsemahasiswa">
                    <li>
                        <a href="mahasiswa.php">Data Mahasiswa</a>
                    </li>
                    <li>
                        <a href="mahasiswapersemester.php">Mahasiswa Per Semester</a>
                    </li>
                    <li>
                        <a href="trackrecordmahasiswa.php">Track Record Mahasiswa</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item" data-toggle="tooltip"  data-placement="right" title="Outline">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseoutline" data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-table"></i>
                    <span class="nav-link-text">Outline</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseoutline">
                    <li>
                        <a href="lihatdataoutline.php">Data Outline</a>
                    </li>
                    <li>
                        <a href="cekjuduloutline.php">Plagiarisme</a>
                    </li>
                    <li>
                        <a href="verifikasioutline.php">Validasi Outline</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item" data-toggle="tooltip"  data-placement="right" title="proposal">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseproposal" data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-table"></i>
                    <span class="nav-link-text">Proposal</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseproposal">
                    <li>
                        <a href="lihatproposal.php">Data Proposal</a>
                    </li>
                    <!-- <li>
                        <a href="validasiproposal.php">Validasi Sidang Proposal</a>
                    </li> -->
                </ul>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Semhas">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseSemhas" data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-wrench"></i>
                    <span class="nav-link-text">Seminar Hasil</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseSemhas">
                    <li>
                        <a href="seminarhasil.php">Data Seminar Hasil</a>
                    </li>
                    <!-- <li>
                        <a href="validasisemhas.php">Validasi Seminar Hasil</a>
                    </li> -->
                </ul>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="KTI">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseKTI" data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-wrench"></i>
                    <span class="nav-link-text">Karya Tulis Ilmiah</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseKTI">
                    <li>
                        <a href="kti.php">Data KTI</a>
                    </li>
                    <li>
                        <a href="validasikti.php">Validasi Ujian KTI</a>
                    </li>
                    <li>
                        <a href="nilaikti.php">Nilai KTI</a>
                    </li>
                    <li>
                        <a href="kumpulberkas.php">Kumpul Berkas</a>
                    </li>
                    <li>
                        <a href="validasinilaiakhir.php">Validasi Nilai Akhir</a>
                    </li>
                </ul>
            </li>
            <!-- <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Link">
                <a class="nav-link" href="cetak.php">
                    <i class="fa fa-fw fa-link"></i>
                    <span class="nav-link-text">Cetak</span>
                </a>
            </li> -->
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="KTI">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapsearsip" data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-wrench"></i>
                    <span class="nav-link-text">Arsip</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapsearsip">
                    <li>
                        <a href="arsipsk.php">Surat Keputusan</a>
                    </li>
                    <li>
                        <a href="mahasisalulus.php">Mahasiswa Lulus</a>
                    </li>
                    <li>
                        <a href="nilaikti.php">Nilai KTI Mahasiswa</a>
                    </li>
                    <li>
                        <a href="arsipproposal.php">Berita Acara Proposal</a>
                    </li>
                    <li>
                        <a href="arsipsemhas.php">Berita Acara Seminar Hasil</a>
                    </li>
                    <li>
                        <a href="arsipkti.php">Berita Acara KTI</a>
                    </li>
                </ul>
            </li>
        </ul>
        <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
                <a class="nav-link text-center" id="sidenavToggler">
                    <i class="fa fa-fw fa-angle-left"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">

            <li class="nav-item">
                <a class="nav-link" href="logout.php">
                    <i class="fa fa-fw fa-sign-out"></i>Logout</a>
            </li>
        </ul>
    </div>
    </nav>
</html>
<?php
    } else {
?>
<html>
<head></head>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.html">Sistem Informasi KTI | <?php echo $_SESSION['namauser'];?></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                <a class="nav-link" href="dashboard.php">
                    <i class="fa fa-fw fa-dashboard"></i>
                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Proposal">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseProposal" data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-wrench"></i>
                    <span class="nav-link-text">Proposal</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseProposal">
                    <li>
                        <a href="lihatproposal.php">Data Proposal</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="KTI">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapsearsip" data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-wrench"></i>
                    <span class="nav-link-text">Arsip</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapsearsip">

                    <li>
                        <a href="mahasiswalulus.php">Mahasiswa Lulus</a>
                    </li>
                </ul>
            </li>
        </ul>
        <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
                <a class="nav-link text-center" id="sidenavToggler">
                    <i class="fa fa-fw fa-angle-left"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">

            <li class="nav-item">
                <a class="nav-link" href="logout.php">
                    <i class="fa fa-fw fa-sign-out"></i>Logout</a>
            </li>
        </ul>
    </div>
    </nav>
</html>
<?php }?>
<!-- </body> -->



