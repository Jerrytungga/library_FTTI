<?php
include '../database/database.php';
include '../vendor/autoload.php'; // Sesuaikan dengan lokasi autoload.php

$database_buku = mysqli_query($conn, "SELECT * FROM `tb_buku` order by `tb_id` DESC ");

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
                font-size: 12pt;
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
    <h2>Book Catalogue</h2>
    <h3>FULL TIME TRAINING INDONESIA</h3>
</center>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Book Title</th>
                <th>Book stock</th>
                <th>Category</th>
                <th>Code Books</th>
                <th>Shelves and rows of books</th>
            </tr>
        </thead>
        <tbody>';

        $b = 1;
        foreach ($database_buku as $row) {
            $html .= '
            <tr>
                <td>' . $b . '</td>
                <td>' . $row['tb_judul_buku'] . '</td>
                <td>' . $row['tb_stok_buku'] . '</td>
                <td>' . $row['tb_kategori_buku'] . '</td>
                <td>' . $row['tb_kode_buku'] . '</td>
                <td>' . $row['tb_rak_buku'] . ' / ' . $row['tb_baris_buku'] . '</td>
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
$mpdf->Output('Book_Catalogue.pdf', 'D'); // Untuk menampilkan dalam browser, ubah 'D' menjadi 'I'
?>
