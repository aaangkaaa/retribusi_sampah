<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SKRD Retribusi Kebersihan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid black;
        }
        th {
            width: 20%;
        }
        td {
            width: 30%;
        }
        .header-logo {
            width: 80px;
        }
    </style>
</head>
<body>

<?php
// Membuat array dengan 500 elemen kosong (atau bisa diisi dengan data dinamis)
$pages = array_fill(0, 2000, []); // Bisa ditambahkan data lainnya sesuai kebutuhan

// Loop untuk mencetak 500 halaman
foreach ($pages as $page) {
    ?>
    <table>
        <tr>
            <td rowspan="2" class="header-logo">
                <img src="logo.png" alt="Logo Pemkot Makassar" width="80">
            </td>
            <td colspan="2" style="text-align: center; font-weight: bold;">
                PEMERINTAH KOTA MAKASSAR
            </td>
            <td rowspan="2" style="text-align: center; font-weight: bold;">
                SURAT KETETAPAN RETRIBUSI DAERAH (SKRD)<br>RETRIBUSI KEBERSIHAN
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center; font-weight: bold;">
                KECAMATAN ..................
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <th>MASA</th>
            <td>:</td>
            <td></td>
            <th>NO. URUT</th>
            <td>..........</td>
        </tr>
        <tr>
            <th>TAHUN</th>
            <td>:</td>
            <td></td>
        </tr>
        <tr>
            <th>NAMA</th>
            <td>:</td>
            <td>............................................................</td>
            <th>JMLH</th>
            <td>Rp ..........</td>
        </tr>
        <tr>
            <th>ALAMAT</th>
            <td>:</td>
            <td>............................................................</td>
        </tr>
        <tr>
            <th>NPWR</th>
            <td>:</td>
            <td>............................................................</td>
        </tr>
        <tr>
            <th>TANGGAL JATUH TEMPO</th>
            <td>:</td>
            <td>............................................................</td>
        </tr>
    </table>

    <table>
        <tr>
            <th>KODE REKENING</th>
            <td></td>
            <th>URAIAN RETRIBUSI</th>
            <td></td>
        </tr>
        <tr>
            <td colspan="4" style="text-align: center; font-weight: bold;">RETRIBUSI KEBERSIHAN</td>
        </tr>
        <tr>
            <th>Jumlah Ketetapan Pokok Retribusi</th>
            <td>..............................................</td>
            <th>Jumlah Sanksi :</th>
            <td></td>
        </tr>
        <tr>
            <th>Bunga 2%</th>
            <td>..............................................</td>
            <th>b. Kenaikan</th>
            <td>..............................................</td>
        </tr>
        <tr>
            <th>Jumlah Keseluruhan</th>
            <td>..............................................</td>
        </tr>
    </table>

    <table>
        <tr>
            <td colspan="4" style="text-align: left;">
                Dengan Huruf : _______________________________________________________
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <td style="text-align: left;">
                <p>PERHATIAN:</p>
                <p>1. Apabila SKRD ini tidak atau kurang dibayar dalam waktu paling lama 30 hari setelah SKRD diterima atau (tanggal jatuh tempo) dikenakan sanksi Administratif berupa bunga sebesar 2% per bulan.</p>
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <td style="text-align: right;">
                Makassar, ............................20..
            </td>
        </tr>
        <tr>
            <td style="text-align: right;">
                CAMAT...
            </td>
        </tr>
        <tr>
            <td style="text-align: right;">
                (tanda tangan)
            </td>
        </tr>
        <tr>
            <td style="text-align: right;">
                NAMA LENGKAP
            </td>
        </tr>
        <tr>
            <td style="text-align: right;">
                NIP..................
            </td>
        </tr>
    </table>

    <hr style="page-break-before: always;">
    <?php
}
?>

</body
