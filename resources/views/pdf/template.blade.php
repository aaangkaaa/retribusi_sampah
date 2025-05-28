<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SKRD RETRIBUSI KEBERSIHAN</title>
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
      font-family: 'Times New Roman', Times, serif;
      font-size: 14px;
      letter-spacing: 0.5px;
    }
    td, th {
      padding: 4px;
    }
    .highlight {
      font-weight: bold;
    }
    .page-break {
      page-break-before: always;
    }
  </style>
</head>
<body>

@foreach($data as $item)  <!-- Loop untuk menampilkan data -->
<div class="page-break"> <!-- Memulai halaman baru untuk setiap data -->
  <table border='1' style="line-height:1.5">
    <tr>
      <td colspan="2">
        <table border='0'>
            <tr>
                <td rowspan='2'>
                    <img src="logo.png" alt="Logo" style="float:left; margin-right:10px;">
                </td>
                <td align='center'>
                    <strong>PEMERINTAH KOTA MAKASSAR</strong><br>
                </td>
            </tr>
            <tr>
                <td align='center'><strong>{{strtoupper($item->nm_kecamatan)}}</strong></td>
            </tr>
        </table>
      </td>
      <td colspan="2">
        <table>
            <tr>
                <td align='center'>
                    <strong>SURAT KETETAPAN RETRIBUSI DAERAH</strong><br>
                </td>
            </tr>
            <tr>
                <td align='center'>
                    <strong><span>(SKRD)</span> RETRIBUSI KEBERSIHAN</strong>
                </td>
            </tr>
        </table>
      </td>
      <td>
        NO. URUT {{$item->no_seri}}
      </td>
    </tr>
    <tr>
      <td colspan="5">MASA TAHUN : {{format_bulan($item->bulan)}} {{$item->tahun}}</td>
    </tr>
    <tr>
      <td>NAMA</td>
      <td colspan="4">: {{$item->nama}}</td>
    </tr>
    <tr>
      <td>ALAMAT</td>
      <td colspan="4">: {{$item->alamat}}</td>
    </tr>
    <tr>
      <td>NPWR</td>
      <td colspan="4">: {{$item->npwr}}</td>
    </tr>
    <tr>
      <td>TANGGAL JATUH TEMPO</td>
      <td colspan="4">: {{format_tanggal($item->tgl_tempo)}}</td>
    </tr>
    <tr>
      <th>KODE REKENING</th>
      <th colspan="3">URAIAN RETRIBUSI</th>
      <th>JUMLAH (Rp)</th>
    </tr>
    <tr>
      <td rowspan="2"></td>
      <td colspan="3">RETRIBUSI KEBERSIHAN</td>
      <td align='right'>Rp. {{number_format($item->jumlah, 2, ',', '.')}}</td>
    </tr>
    <tr>
      <td colspan="3">
        Jumlah Ketetapan Pokok Retribusi<br>
        Jumlah Sanksi :<br>
        a. Bunga 2 %<br>
        b. Kenaikan
      </td>
      <td></td>
    </tr>
    <tr>
      <td colspan="4">Jumlah Keseluruhan :</td>
      <td align='right'>Rp. {{number_format($item->jumlah, 2, ',', '.')}}</td>
    </tr>
    <tr>
      <td colspan="5">
        Dengan Huruf : <i>{{ ucwords(strtolower(terbilang($item->jumlah))) }} rupiah</i>
      </td>
    </tr>
    <tr>
      <td colspan="5">
        PERHATIAN :<br>
        1. Apabila <span class="highlight">SKRD</span> ini tidak atau kurang dibayar dalam waktu paling lama 30 hari setelah <span class="highlight">SKRD</span> diterima (tanggal jatuh tempo), maka akan dikenakan sanksi administratif berupa bunga sebesar 2% per bulan.
      </td>
    </tr>
    <tr>
      <td colspan='3'></td>
      <td colspan="2" align='center'>
        Makassar, {{format_tanggal($item->tgl_penetapan)}}<br>
        CAMAT...<br>
        (tanda tangan)<br>
        NAMA LENGKAP<br>
        NIP....................
      </td>
    </tr>
  </table>
</div>  <!-- End of page-break -->
@endforeach

</body>
</html>
