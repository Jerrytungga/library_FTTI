<?php
include '../database/database.php';
include 'role.php';




if (isset($_POST['kategori_buku'])) {
  $_kategori_buku = $_POST['kategori_buku'];
  $simpan_data_buku = mysqli_query($conn, "INSERT INTO `tb_kategori`(`kategori`) VALUES ('$_kategori_buku')");
}
if (isset($_POST['hapus_kategori'])) {
  $hapus_kategori_buku = $_POST['hapus_kategori'];
  $hapus_data_kategori_buku = mysqli_query($conn, "DELETE FROM `tb_kategori` WHERE id_='$hapus_kategori_buku'");
}

if (isset($_POST['save'])) {
  $sumber = $_FILES['image']['tmp_name'];
  $target = '../img/';
  $nama_gambar = $_FILES['image']['name'];
  // $volume = $_POST['volume'];
  $kode_buku = $_POST['kode_buku'];
  $judul = $_POST['judul'];
  // $penerbit = $_POST['penerbit'];
  $rakbuku = $_POST['rakbuku'];
  $stok = $_POST['stok'];
  $Penulis = $_POST['Penulis'];
  $kategori = $_POST['kategori'];
  $Baris = $_POST['Baris'];
  if ($nama_gambar != '') {
    if (move_uploaded_file($sumber, $target . $nama_gambar)) {
      $simpan_data_buku = mysqli_query($conn, "INSERT INTO `tb_buku`(`tb_judul_buku`, `tb_kategori_buku`, `tb_penulis`, `tb_rak_buku`, `tb_baris_buku`, `tb_stok_buku`,`tb_kode_buku`,`tb_gambar_buku`) VALUES ('$judul','$kategori','$Penulis','$rakbuku','$Baris','$stok','$kode_buku','$nama_gambar')");
    }
  } else {
    $simpan_data_buku = mysqli_query($conn, "INSERT INTO `tb_buku`(`tb_judul_buku`, `tb_kategori_buku`, `tb_penulis`, `tb_rak_buku`, `tb_baris_buku`, `tb_stok_buku`,`tb_kode_buku`) VALUES ('$judul','$kategori','$Penulis','$rakbuku','$Baris','$stok','$kode_buku')");
  }

}


$database_buku = mysqli_query($conn, "SELECT * FROM `tb_buku` order by `tb_id` DESC ");
$kategori__buku = mysqli_query($conn, "SELECT * FROM `tb_kategori`");
?>
<html lang="en">
<?php
include 'header.php';
?> 

  <body>
  <?php
include 'navbar.php';
?> 

    <div class="jr-content mt-5 pd-y-20 pd-lg-y-30 pd-xl-y-40">
      <div class="container">
      
        <div class="jr-content-body pd-lg-l-40 d-flex flex-column">
        
          <h2 class="jr-content-title">Book Table</h2>
        
<table class="mb-2">
<thead>

    <tr>
      <th scope="col">





      <!-- Button trigger modal -->
      
      <button type="button" class="btn btn-primary rounded-10 zoom-in-button shadow zoom-in-out-button" data-toggle="modal" data-target="#tambah_buku">
      Enter Book Data
      </button>

      
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary ml-4 rounded-10 zoom-in-button " data-toggle="modal" data-target="#tambah_kategori">
        Enter Book Category
      </button>

     

<!-- Modal -->
<div class="modal fade" id="tambah_kategori" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header  header-modal">
        <h5 class="modal-title text-light" id="exampleModalLabel">Book Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
        <div class="">
          <label for="">Enter Category : </label>
          <input type="text" class="form-control col-4" name="kategori_buku" id="">
          <button type="submit" class="btn btn-success mt-2">Save</button>
        </div>
        </form>
        <span class="text-danger font-italic">If the book category has been used then you are not allowed to delete the book category, you can only add a new category.</span>
      <hr>
      <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Category</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php
      $b = 1;
      foreach ($kategori__buku as $row) :
    ?>
    <tr>
      <th scope="row"><?= $b; ?></th>
      <td><?= $row['kategori']; ?></td>
      <td>
<form action="" method="post">
  <button type="submit" name="hapus_kategori" value="<?= $row['id_']; ?>" class="btn btn-danger btn-sm rounded-10">Delete</button>
</form>
      </td>
    </tr>
    <?php $b++; ?>
    <?php endforeach; ?>
  
  </tbody>
</table>


      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>










<!-- Modal tambah buku-->
<div class="modal fade" id="tambah_buku" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
   
      <div class="modal-header header-modal">
        <h5 class="modal-title text-light" id="staticBackdropLabel">Add Book Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
  <form action="" method="post"  enctype="multipart/form-data">
      <div class="modal-body">
          <div class="row">
            <div class="col-sm-6">
            <div class="m-2">
                <label for="">Book code :</label>
              <input type="text" class="form-control" name="kode_buku"  required>
              </div>
            <div class="m-2">
                <label for="">Image :</label>
              <input type="file" class="form-control" name="image" required>
              </div>
            <div class="m-2">
                <label for="">Book title :</label>
              <input type="text" class="form-control" name="judul" required>
              </div>
        
            <div class="m-2">
                <label for="">Bookshelf :</label>
              <input type="text" class="form-control" name="rakbuku" required>
              </div>
          

            </div>

            <div class="col-sm-6">
            <div class="m-2">
                <label for="">Author :</label>
              <input type="text" name="Penulis" class="form-control" required>
            </div>

            <div class="m-2">
              <label for="">Category :</label>
              <select  id="" class="form-control" name="kategori" required>
              <?php
$perulangan_ = mysqli_query($conn,"SELECT * FROM `tb_kategori`");
while ($perulangan_kategori = mysqli_fetch_array($perulangan_)) { ?>
                <option value="<?= $perulangan_kategori['kategori']?>"><?= $perulangan_kategori['kategori']?></option>
<?php } ?>
              </select>
            </div>
           
            <div class="m-2">
                <label for="">Book row :</label>
              <input type="text" name="Baris" class="form-control" required> 
            </div>
            <div class="m-2">
                <label for="">Book stock  :</label>
              <input type="number" class="form-control" name="stok" required>
              </div>
          </div>
       </div>
      <div class="modal-footer">
        <button type="submit" name="save" class="btn btn-primary zoom-in-button rounded-10">Save</button>
      </div>
    </form>
    </div>
  </div>
</div>
      </th>

     
      </tr>


  </thead>
</table>

  <table id="example" class="table table-striped table-bordered" style="width:100%">
 
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Book Code</th>
      <th scope="col">Book title</th>
      <th scope="col">Author</th>
      <th scope="col">Category</th>
      <!-- <th scope="col">Book publisher</th> -->
      <th scope="col">Book stock</th>
      <!-- <th scope="col">Book Volume</th> -->
      <th scope="col">Book Row</th>
      <th scope="col">Book shelf</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $i = 1;
      foreach ($database_buku as $row) :
    ?>
    <tr>
      <th scope="row"><?= $i; ?></th>
      <td><?= $row['tb_kode_buku']; ?></td>
      <td><?= $row['tb_judul_buku']; ?></td>
      <td><?= $row['tb_penulis']; ?></td>
      <td><?= $row['tb_kategori_buku']; ?></td>
      <!-- <td><?= $row['tb_penerbit']; ?></td> -->
      <td><?= $row['tb_stok_buku']; ?></td>
      <!-- <td><?= $row['tb_volume']; ?></td> -->
      <td><?= $row['tb_rak_buku']; ?></td>
      <td><?= $row['tb_baris_buku']; ?></td>
      <td>
<span>

  <form action="detailbuku.php" method="get">
    <button type="submit" name="kd_buku" value="<?= $row['tb_kode_buku']; ?>" class="btn btn-sm btn-info rounded-10 mr-2 zoom-in-button">Show</button>
        </form>
        <?php   
       $kode_buku=$row['tb_kode_buku'];
       $id_buku = $row['tb_id']; 

        $stok_buku = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(tb_stok) as stok FROM `tb_tambah_stokbuku` where `tb_kode_buku`='$kode_buku' and `id_buku`='$id_buku'")); ?>
        <form action="qrcode.php"  target="_blank" method="post" enctype="multipart/form-data">
          <button type="submit" name="qr" value="<?= $row['tb_kode_buku']; ?>" id="qr" class="btn btn-success rounded-10 zoom-in-button">Print QR Code <sup class="badge badge-light"><?= $row['tb_stok_buku']+$stok_buku['stok']; ?></sup></button>
        </form>
      </span>
      <!-- <button class="btn btn-sm rounded-10 btn-az-secondary zoom-in-button">Lihat Peminjaman Aktif</button> -->
      </td>
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>
    <?php
		if(isset($_POST["excel"])){
			$fileName = $_FILES["excel"]["tb_kode_buku"];
			$fileExtension = explode('.', $fileName);
      $fileExtension = strtolower(end($fileExtension));
			$newFileName = date("Y.m.d") . " - " . date("h.i.sa") . "." . $fileExtension;

			$targetDirectory = "../uploads/" . $newFileName;
			move_uploaded_file($_FILES['excel']['tmp_name'], $targetDirectory);

			error_reporting(0);
			ini_set('display_errors', 0);

			require '../excelReader/excel_reader2.php';
			require '../excelReader/SpreadsheetReader.php';

			$reader = new SpreadsheetReader($targetDirectory);
			foreach($reader as $key => $rw){
				$kdbuku_ = $rw[0];
				$judul = $rw[1];
				$Author = $rw[2];
				$Category = $rw[3];
				$publisher = $rw[4];
				$stock = $rw[5];
				$Volume = $rw[6];
				$Row = $rw[7];
				$shelf = $rw[8];
				mysqli_query($conn, "INSERT INTO tb_buku VALUES('', '$kdbuku_', '$judul', '$Author', '$Category', '$publisher', '$stock', '$Volume', '$Row', '$shelf')");
			}

			echo
			"
			<script>
			alert('Succesfully Imported');
			document.location.href = '';
			</script>
			";
		}
		?>
  </tbody>
</table>
      

  
       
        

          <div class="ht-40"></div>

        </div><!-- jr-content-body -->
      </div><!-- container -->
    </div><!-- jr-content -->

    <?php
include 'ft_script.php';
?> 

  </body>
</html>
