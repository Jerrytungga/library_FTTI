
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