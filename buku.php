<?php
include 'database/database.php';
error_reporting(0);
session_start();
$hari_ini = date('Y-m-d');
if (!isset($_SESSION['id'])) {
  echo "<script type='text/javascript'>
  alert('Anda harus masukan NIP terlebih dahulu!');
  window.location = 'index.php'
</script>";
} else {
  $id = $_SESSION['id'];
  $anggota = mysqli_query($conn, "SELECT * FROM `tb_trainee` WHERE nip_traines='$id'");
  $ambil_anggota = mysqli_fetch_array($anggota);
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="css/user.css">
    <title>FTTI | Library</title>
    <style>



table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    box-shadow: 0 2px 3px rgba(0,0,0,0.1);
}

th, td {
    padding: 12px 15px;
    border: 1px solid #ddd;
    text-align: left;
}

thead {
    background-color: #009879;
    color: #ffffff;
}

tr:nth-child(even) {
    background-color: #f3f3f3;
}

tr:hover {
    background-color: #f1f1f1;
    cursor: pointer;
}

@media screen and (max-width: 600px) {
    table, thead, tbody, th, td, tr {
        display: block;
    }

    thead tr {
        position: absolute;
        top: -9999px;
        left: -9999px;
    }

    tr {
        border: 1px solid #ccc;
        margin-bottom: 5px;
    }

    td {
        border: none;
        border-bottom: 1px solid #eee;
        position: relative;
        padding-left: 50%;
        text-align: right;
    }

    td:before {
        position: absolute;
        top: 50%;
        left: 10px;
        transform: translateY(-50%);
        content: attr(data-label);
        font-weight: bold;
        text-align: left;
    }
}

    </style>
  </head>
  <body>
  <?php
include 'navbar.php';
?>


<form class="form-inline my-2 my-lg-0" action="" method="post">
          <input class="form-control mr-sm-2 shadow bg-light" type="text" name="search" placeholder="Enter the book title" aria-label="Search" required>
          <button class="btn bt my-2 my-sm-0 riht bg-light shadow " type="submit">Search</button>
        </form>

        <table id="myTable">
            <thead>
                <tr>
                    <th>Book Title</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Stock</th>
                    <th>Bookshelf</th>
                    <th>Row</th>
                </tr>
            </thead>
            <tbody>
            <?php
             $cari = $_POST['kat'];
             $cari1 = $_POST['search'];
           if(isset($cari)){
           $database_buku = mysqli_query($conn, "SELECT * FROM `tb_buku` where `tb_kategori_buku` = '".$_POST['kat']."'");
           } else {
             $database_buku = mysqli_query($conn, "SELECT * FROM `tb_buku`");
           } if(isset($cari1)) { 
            $database_buku = mysqli_query($conn, "SELECT * FROM `tb_buku` where `tb_judul_buku` = '$cari1'");
            }
              $i = 1;
              foreach ($database_buku as $row) :
            ?>

                <tr>
                    <td><?= $row['tb_judul_buku']; ?></td>
                    <td><?= $row['tb_penulis']; ?></td>
                    <td><?= $row['tb_kategori_buku']; ?></td>
                    <td><?= $row['tb_stok_buku']; ?></td>
                    <td><?= $row['tb_rak_buku']; ?></td>
                    <td><?= $row['tb_baris_buku']; ?></td>
                </tr>
                <?php $i++; ?>
    <?php endforeach; ?>
            </tbody>
        </table>
  























    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
  </body>
    <?php
include 'fotter.php';
?>
</html>