<style>
   
    .logout{
        color: #fff;
    }
    .logout:hover{
        color: red;
        background-color: #fff;
    }

    .bg{
        background-color: #F7F7F7;
    }
    .bgbtn{
        background-color: #D9D7F1;
    }
</style>

<nav class="navbar bg navbar-expand-md fixed-top">

    <h6 class="font-weight-bold text-dark font-italic" href="#">[ LIBRARY FTTI ] <?= $ambil_anggota['Nama_traines'] ?> </h6>
    <!-- Hamburger button for mobile -->
    <button class="navbar-toggler btn-danger navbar-dark bg-dark" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon "></span>
    </button>

    <!-- Navigation links -->
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item text-biru">
                <a class="nav-link btn bgbtn font-weight-bold" href="peminjaman.php">Borrow Book</a>
            </li>
         

            <div class="btn-group nav-item">
                <a href="buku.php" type="button" class="nav-link btn bgbtn tombol font-weight-bold">Book Catalogue</a>
                <button type="button" class="nav-link btn bgbtn text-dark dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false" data-reference="parent">
                <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu">
                    <?php
                        $dropdown = mysqli_query($conn,"SELECT * FROM `tb_kategori`");
                        while ($dropdown_ = mysqli_fetch_array($dropdown)){ ?>
                        <form action="buku.php" method="post">
                            <button class="dropdown-item tombol" type="submit" name="kat" value="<?= $dropdown_['kategori'] ?>"><?= $dropdown_['kategori'] ?></button>
                        </form>
                    <?php    }
                    ?>
                </div>
             </div>



            <li class="nav-item">
                <a class="nav-link btn bgbtn font-weight-bold" href="pengembalian.php">Returned Books</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn btn-danger logout font-weight-bold " href="keluar.php">Log Out</a>
            </li>
        </ul>
    </div>
</nav>

