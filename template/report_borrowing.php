<?php
include '../database/database.php';
include '../vendor/autoload.php'; // Sesuaikan dengan lokasi autoload.php
if (isset($_POST['unduh'])){
    $date_awal = $_POST['periodeawal'];
    $date_akhir = $_POST['periodeakhir']; 
    $database_buku = mysqli_query($conn, "SELECT * FROM `tb_peminjaman` where date_peminjaman between '$date_awal' and '$date_akhir'");
}
function nama($nama_buku)
{
  global $conn;
  $sqly = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_buku WHERE tb_kode_buku='$nama_buku'"));
  return $sqly['tb_judul_buku'];
}
function nama_($traines_)
{
  global $conn;
  $sqly1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_trainee WHERE nip_traines='$traines_'"));
  return $sqly1['Nama_traines'];
}
$mpdf = new \Mpdf\Mpdf();

$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        @media print {
            body {
                font-size: 11pt;
            }

            table {
                page-break-inside: auto;
            }

            tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }

            th, td {
                page-break-inside: avoid;
            }
        }
    </style>
</head>
<body>
<center>
    <h2>Report Borrowing</h2>
    <h3>FULL TIME TRAINING INDONESIA</h3>
    '. $date_awal . ' - '.$date_akhir.'
</center>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Traines</th>
                <th>Book title</th>
                <th>Category</th>
                <th>Borrowing date</th>
                <th>Returned date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>';

        $b = 1;
        foreach ($database_buku as $row) {
            $html .= '
            <tr>
                <td>' . $b . '</td>
                <td>' . nama_($row['tb_nip']) . '</td>
                <td>' . nama($row['tb_kd_buku']) . '</td>
                <td>' . $row['tb_kategori'] . '</td>
                <td>' . $row['date_peminjaman'] . '</td>
                <td>' . $row['tb_kembali'] . '</td>
                <td>' . $row['tb_status'] . '</td>
            </tr>';
            $b++;
        }

$html .= '
        </tbody>
    </table>
</body>
</html>';

$mpdf->WriteHTML($html);

// Simpan sebagai file PDF atau tampilkan dalam browser
$mpdf->Output('report_borrowing.pdf', 'D'); // Untuk menampilkan dalam browser, ubah 'D' menjadi 'I'
?>
