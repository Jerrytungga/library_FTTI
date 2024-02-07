<?php
include '../database/database.php';
date_default_timezone_set('Asia/Jakarta');
$hari_ini = date('D - M / Y');
include 'role.php';


?>
<!DOCTYPE html>
<html lang="en">
<script src="https://code.highcharts.com/highcharts.js"></script>

<?php
include 'header.php';
?> 
 <script>
        function updateClock() {
            var waktuElement = document.getElementById('waktu');
            var waktuSekarang = new Date();
            var waktuFormatted = waktuSekarang.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: true });
            waktuElement.innerHTML = waktuFormatted;
        }
        setInterval(updateClock, 1000);
  </script>
<style>
#chart {
  width: 100%;
  height: 500px;
}

</style>
  <body>
<?php
include 'navbar.php';

?> 

  
    <div class="jr-content mt-5 jr-content-dashboard">
      <div class="container">
        <div class="jr-content-body">
          <div class="az-dashboard-one-title">
            <div>
              <h2 class="az-dashboard-title">Welcome back!</h2>
              <p class="az-dashboard-text">{ <?= $dataadmin['Nama']?> }</p>
            </div>
            <div class="jr-content-header-right">
              <div class="media">
                <div class="media-body">
                  <label>time now</label>
                  <?php  $waktu_sekarang = date('H:i:s'); ?>
                  <h6 id="waktu"></h6>
                </div><!-- media-body -->
              </div><!-- media -->
              <div class="media">
                <div class="media-body">
                  <label>current date</label>
                  <h6><?= $hari_ini; ?></h6>
                </div><!-- media-body -->
                <a href="catalogue.php" class="btn btn-primary rounded-10">Download book list</a>
              </div><!-- media -->
             
              <!-- <button class="btn btn-warning rounded-10 shadow font-weight-bold hover">Cek Data</button> -->
            </div>
          </div><!-- az-dashboard-one-title -->

          <div class="row">
            <div class="col-sm-2 mb-2 mb-sm-0 ">
              <div class="card shadow border border-primary rounded-10">
                <a href="tabel_buku.php">
                  <div class="card-body">
                    <center>
                    <h5 class="card-title">Total Books</h5>
                   <?php  $totalbuku = mysqli_fetch_array(mysqli_query($conn, "SELECT count(tb_kode_buku) AS jumlah FROM `tb_buku`")); ?>
                   <h3 class="font-weight-bold"><?= $totalbuku['jumlah']; ?></h3>
                  </center>
                  <!-- <a href="#" class="btn btn-primary rounded-20">Lihat</a> -->
                </div>
              </a>
            </div>
          </div>
            <div class="col-sm-2">
              <div class="card shadow border border-primary rounded-10">
                    <a href="tabel_buku.php">
                <div class="card-body">
                  <center>
                    <?php  $totalpeminjaman = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(tb_stok_buku) as stok FROM `tb_buku`")); ?>
                    <h5 class="card-title">Books stock</h5>
                    <h3 class="font-weight-bold"><?= $totalpeminjaman['stok']; ?></h3>
                  </center>
                </div>
              </a>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="card shadow border border-primary rounded-10">
                <div class="card-body">
                  <center>
                  <?php  $totalkembali = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(DISTINCT(`tb_rak_buku`)) AS rak FROM `tb_buku`")); ?>
                  <h5 class="card-title">Bookshelf</h5>
                  <h3 class="font-weight-bold"><?= $totalkembali['rak']; ?></h3>
                  </center>
                 
                </div>
              </div>
            </div>
          
            <div class="col-sm-2">
              <div class="card shadow border border-primary rounded-10">
                <div class="card-body">
                  <center>
                    <?php  $kategori = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(kategori) as kategori FROM `tb_kategori`")); ?>
                    <h5 class="card-title">Catalogue</h5>
                    <h3 class="font-weight-bold"><?= $kategori['kategori']; ?></h3>
                    <!-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> -->
                   
                  </center>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="card shadow border border-primary rounded-10">
                <div class="card-body">
                  <center>

                    <h5 class="card-title">Reports</h5>
                    <!-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> -->
                    <button href="#" class="btn btn-info rounded-20" data-toggle="modal" data-target="#peminjamanModal">Borrowing books</button>
                    <a href="#" class="btn btn-warning rounded-20">Book returned</a>
                  </center>

                           <!-- Peminjaman -->
                          <div class="modal fade" id="peminjamanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                              <div class="modal-content">
                                <div class="modal-header bg-info">
                                  <h5 class="modal-title text-light" id="exampleModalLabel">Borrowing books</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <form action="report_borrowing.php" method="post">
                                <div class="modal-body">
                                  <div>
                                    <input type="date" name="periodeawal" class="form-control mb-2 rounded-10" required id="">
                                    <input type="date" name="periodeakhir" class="form-control rounded-10" required id="">
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-danger rounded-10" data-dismiss="modal">Close</button>
                                  <button type="submit" name="unduh" class="btn btn-info rounded-10">Download</button>
                                </div>
                                </form>
                              </div>
                            </div>
                          </div>
                      
                      
                </div>
              </div>
            </div>
          
          </div>
      
          <hr>

          <div class="row">
  <div class="col-sm-4">
    <div class="card border-primary rounded-10 shadow">
    <a href="traines.php">
      <div class="card-body">
        <center>
          <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
          </svg>
          <?php  $totalmember = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(nip_traines) as total_member FROM `tb_trainee`")); ?>
          <h5 class="card-title"><?= $totalmember['total_member'] ?> Member</h5>
        </center>
      </div>
    </a>
  </div>
</div>

<div class="col-sm-4 ">
  <div class="card border-primary rounded-10 shadow">
      <a href="peminjaman.php">
        <div class="card-body">
          <center>
          <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-arrow-left-right" viewBox="0 0 16 16">
      <path fill-rule="evenodd" d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5m14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5"/>
    </svg>
          <?php  $totalpinjam = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(tb_nip) as totalPeminjam FROM `tb_peminjaman`")); ?>
          <h5 class="card-title"><?= $totalpinjam['totalPeminjam'] ?> Borrowing transactions</h5>
        </center>
      </div>
    </a>
  </div>
</div>
  <div class="col-sm-4 ">
    <div class="card border-primary rounded-10 shadow">
      <a href="pengembalian.php">
      <div class="card-body">
        <center>
          <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1"/>
          </svg>
          <?php  $totalkembali = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(tb_nip) AS totalpengembalian FROM `tb_pengembalian`")); ?>
          <h5 class="card-title"><?= $totalkembali['totalpengembalian'] ?> Return of books</h5>
        </center>
      </div>
    </a>
    </div>
  </div>

</div>
        

<hr class="bg-primary">

<div class="card rounded-10 shadow">
  <div class="card-header">
    <h5 class=" text-info">
      Today's report
    </h5>
  </div>
  <div class="card-body">
 
  <div class="row">
  <div class="col-sm-3">
    <center>
      <h5 class="card-title mt-4 font-weight-bold text-success">New members</h5>
      <?php  $traines_baru = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(nip_traines) as new_traines FROM `tb_trainee` where date='$hari_ini'")); ?>
      <h1><?= $traines_baru['new_traines'] ?></h1>
    </center>
  </div>
  
  <div class="col-sm-3">
    <center>
      <h5 class="card-title mt-4 font-weight-bold text-primary">Borrowing</h5>
      <?php  $peminjaman_hari_ini = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(tb_nip) as peminjaman_hari_ini FROM `tb_peminjaman` where date_peminjaman='$hari_ini'")); ?>
      <h1><?= $peminjaman_hari_ini['peminjaman_hari_ini'] ?></h1>
    </center>
  </div>
  
  <div class="col-sm-3">
    <center>
      <?php  $pengembalian_hari_ini = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(tb_nip) as pengembalian_hari_ini FROM `tb_pengembalian` where date='$hari_ini'")); ?>
      <h5 class="card-title mt-4 font-weight-bold text-primary">Return</h5>
      <h1><?= $pengembalian_hari_ini['pengembalian_hari_ini'] ?></h1>
    </center>
  </div>
  
  <div class="col-sm-3">
    <center>
      <h5 class="card-title mt-4 font-weight-bold text-danger">Fall due</h5>
      <?php  $jatuh_tempo = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(tb_nip) as jatuh_tempo FROM `tb_peminjaman` where tb_kembali='$hari_ini'")); ?>
      <h1><?= $jatuh_tempo['jatuh_tempo'] ?></h1>
    </center>
  </div>
</div>
  </div>
</div>
<hr>
<style>
  .tinggi{
    height: 460px;
  }
  .font{
    font-size: 16pt;
    color: black;
  }
  .ml{
    margin-right: 100px;
  }
</style>
<div class="row">
  <div class="col-sm-6">
    <div class="card tinggi">
    <div id="chart"></div>
    
    </div>
  </div>


  <div class="col-sm-6">
  <div class="row">
  <div class="col-sm-12">
    <div class="card shadow rounded-10">
      <div class="card-body">
        <p class="card-title font">Total Fine Revenue</p>
        <div class="container">
          <h5 class="card-text" style="margin-right: 300px;">Rp. 500.000.00</h5>
          <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-coin text-success" viewBox="0 0 16 16">
        <path d="M5.5 9.511c.076.954.83 1.697 2.182 1.785V12h.6v-.709c1.4-.098 2.218-.846 2.218-1.932 0-.987-.626-1.496-1.745-1.76l-.473-.112V5.57c.6.068.982.396 1.074.85h1.052c-.076-.919-.864-1.638-2.126-1.716V4h-.6v.719c-1.195.117-2.01.836-2.01 1.853 0 .9.606 1.472 1.613 1.707l.397.098v2.034c-.615-.093-1.022-.43-1.114-.9zm2.177-2.166c-.59-.137-.91-.416-.91-.836 0-.47.345-.822.915-.925v1.76h-.005zm.692 1.193c.717.166 1.048.435 1.048.91 0 .542-.412.914-1.135.982V8.518z"/>
        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
        <path d="M8 13.5a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11m0 .5A6 6 0 1 0 8 2a6 6 0 0 0 0 12"/>
      </svg>
          
        </div>
        <sub class=" font-italic">20 September 2024</sub>
      </div>
    </div>
  </div>
</div> 

  <div class="row mt-2">
  <div class="col-sm-12">
   
  <style>
  .card-body {
    max-height: 300px;
    max-width: 100%;
    overflow-y: auto;
  }

  thead {
    position: sticky;
    top: 0;
    background-color: #092635; /* Adjust the background color as needed */
    z-index: 0;
    height: 40px;
    margin-bottom: -1px; 
    color: #fff;
    
  
  }

</style>
     
          <?php  $peminjam_paling_banyak = mysqli_query($conn, "SELECT tb_kod_buku, sum(tb_stok_buku_kembali) as total_pinjam FROM `tb_pengembalian` GROUP BY tb_kod_buku order by total_pinjam DESC"); ?>
          <div class="card ">
  <div class="card-header font-weight-bold rounded-10">
    Books that are often borrowed
  </div>
  <table>
  <thead>
          <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th scope="col m">no</th>
            <th></th>
       
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
         
            <th scope="col">Book title</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th scope="col">Number of borrowers</th>
           
          
           
          </tr>
        </thead>
  </table>
  <div class="card-body" style="max-height: 300px; overflow-y: auto;">
  
      <table class="table table-striped">
       
        <tbody>
        <?php
         
         function nama($nama_buku)
         {
           global $conn;
           $sqly = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_buku WHERE tb_kode_buku='$nama_buku'"));
           return $sqly['tb_judul_buku'];
         }
      $b = 1;
      foreach ($peminjam_paling_banyak as $row) :
    ?>
          <tr>
            <th scope="row"><?= $b; ?></th>
            <td><?= nama($row['tb_kod_buku']); ?></td>
            <td>
            <button type="button" class="btn btn-danger rounded-20" data-toggle="modal" data-target="#peminjam<?= $row['tb_kod_buku'] ?>">
            <?= $row['total_pinjam']; ?>
            </button>
            
          


  <!-- Modal -->
  <div class="modal fade" id="peminjam<?= $row['tb_kod_buku'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-scrollable" >
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="pinjam">List of people who borrowed</h5>
                    <button type="button" class="close bg-danger" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body" id="modal-tampil">
                    <?php 
                   
                    $traines = mysqli_query($conn, "SELECT * FROM `tb_pengembalian` where tb_kod_buku='".$row['tb_kod_buku']."'"); ?>
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Batch</th>
                        <th scope="col">Borrowed date</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                     
                     $c = 1;
                     foreach ($traines as $ro) :
                      
                      ?>
                      <tr>
                        
                        <td><?= $c; ?></td>
                        <td>
                          <?php
                          $data_traines = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tb_trainee WHERE nip_traines='".$ro['tb_nip']."'"));
                         echo $data_traines['Nama_traines'];
                          ?>
                        </td>
                        <td><?= $data_traines['angkatan_']; ?></td>
                        <td><?= $ro['tb_tanggal_pinjam']; ?></td>
                      </tr>
                      <?php $c++; ?>
                     <?php endforeach; ?>
                    </tbody>
                  </table>


                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger rounded-20" data-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary"></button> -->
                  </div>
                </div>
              </div>
            </div>


          </td>
          
          </tr>
       
          <?php $b++; ?>
    <?php endforeach; ?>
        </tbody>
      </table>
  </div>
</div> 




</div>

</div>

    </div>
  </div>



       
          <hr class="bg-primary">
        </div><!-- jr-content-body -->
      </div>
    </div><!-- jr-content -->

<?php
include 'ft_script.php';
?> 
  <!-- <script src="js/Chart.js"></script> -->
  <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <!-- contoh bar chart -->
    <script type="text/javascript">
        // Create the chart
        // Load the data from the database
    var data = [
      {
        kategori: "Kebenaran",
        subkategori: "Ralph Waldo Emerson",
        jumlah_buku: 10
      },
      {
        kategori: "Kebenaran",
        subkategori: "Leo Tolstoy",
        jumlah_buku: 9
      },
      {
        kategori: "Pembinaan Dasar",
        subkategori: "Charles Spurgeon",
        jumlah_buku: 8
      },
      {
        kategori: "Pembinaan Dasar",
        subkategori: "D.L. Moody",
        jumlah_buku: 7
      },
      {
        kategori: "Prayer Note",
        subkategori: "Charles Spurgeon",
        jumlah_buku: 67
      },
      {
        kategori: "Prayer Note",
        subkategori: "D.L. Moody",
        jumlah_buku: 78
      },
      {
        kategori: "Bible Reading",
        subkategori: "Charles Spurgeon",
        jumlah_buku: 89
      },
      {
        kategori: "Bible Reading",
        subkategori: "D.L. Moody",
        jumlah_buku: 90
      },
      {
        kategori: "Exhibition",
        subkategori: "Charles Spurgeon",
        jumlah_buku: 99
      },
      {
        kategori: "Exhibition",
        subkategori: "D.L. Moody",
        jumlah_buku: 100
      }
    ];

    // Create the chart
    Highcharts.chart('chart', {
      chart: {
        type: 'column'
      },
      title: {
        text: 'Kategori Buku'
      },
      subtitle: {
        text: ''
      },
      accessibility: {
        announceNewData: {
          enabled: true
        }
      },
      xAxis: {
        type: 'category'
      },
      yAxis: {
        title: {
          text: 'Jumlah Buku'
        }
      },
      legend: {
        enabled: false
      },
      plotOptions: {
        series: {
          borderWidth: 0,
          dataLabels: {
            enabled: true,
            format: '{point.y:.1f} Poin'
          }
        }
      },

      tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f} Poin</b> of total<br/>'
      },

      series: [{
        name: "Jumlah Buku",
        data: data
      }]
    });

    // Add drilldown
    Highcharts.drilldown({
      series: [{
        name: "Jumlah Buku",
        data: data
      }],
      drilldownLevels: [{
        name: "Kategori",
        data: data.map(function(d) {
          return {
            name: d.kategori,
            subkategori: d.subkategori,
            jumlah_buku: d.jumlah_buku
          };
        })
      }, {
        name: "Subkategori",
        data: data.map(function(d) {
          return {
            name: d.subkategori,
            jumlah_buku: d.jumlah_buku
          };
        })
      }]
    });
    </script>


  
</body>

</html>
