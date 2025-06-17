<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanda Bukti Pembayaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        .header {
            text-align: center;
            padding: 10px;
        }
        .logo {
            width: 80px;
            height: auto;
        }
        .content td {
            padding: 5px 10px;
        }
        .no-border {
            border: none;
        }
        .signature {
            height: 70px;
            vertical-align: bottom;
            text-align: center;
        }
        .footer {
            font-size: 12px;
        }
    </style>
</head>
<body>
    <table>
        <!-- Header section -->
        <tr>
            <td class="header">
                <table class="no-border" style="width: 100%;">
                    <tr class="no-border">
                        <td class="no-border" style="padding: 20px;">
                            <!-- <div style="display: flex; align-items: center;"> -->
                                <img style='position: absolute; top: 58px; left: 70px;' class="logo" src="{{ public_path('assets/images/logo.bmp') }}" alt="Logo Pemkot Makassar" style="margin-right: 20px;">
                                <div style="text-align: center;position: relative; font-size: 18px;">
                                    <div style="font-weight: bold;">PEMERINTAH KOTA MAKASSAR</div>
                                    <div style="font-weight: bold;">{{ strtoupper($data->kecamatan) }}</div>
                                    <div style="font-weight: bold;">TANDA BUKTI PEMBAYARAN</div>
                                    <div>NOMOR BUKTI : {{ $data->no_bukti }}</div>
                                </div>
                            <!-- </div> -->
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <br>
        <!-- Content section -->
        <tr>
            <td>
                <table class="content no-border" style="width: 100%; line-height: 1.5;">
                    <!-- Bendahara Info -->
                    <tr class="no-border">
                        <td class="no-border" valign="top" style="width: 5%;">a)</td>
                        <td class="no-border" valign="top" colspan="4">
                            Bendahara Penerimaan<br>
                            Telah menerima uang sebesar Rp. {{ number_format($data->jumlah, 2, ',', '.') }}<br>
                            (dengan huruf <i>{{ terbilang($data->jumlah) }} rupiah</i>)
                        </td>
                    </tr>
                    
                    <!-- Payer Info -->
                    <tr class="no-border">
                        <td class="no-border" valign="top" style="width: 5%;">b)</td>
                        <td class="no-border" valign="top" style="width: 15%;">Dari Nama</td>
                        <td class="no-border" valign="top" style="width: 3%;">:</td>
                        <td class="no-border" valign="top" colspan="2">{{ $data->nama }}</td>
                    </tr>
                    <tr class="no-border">
                        <td class="no-border" valign="top"></td>
                        <td class="no-border" valign="top">Alamat</td>
                        <td class="no-border" valign="top">:</td>
                        <td class="no-border" valign="top" colspan="2">{{ $data->alamat }}</td>
                    </tr>
                    <tr class="no-border">
                        <td class="no-border" valign="top"></td>
                        <td class="no-border" valign="top">NPWR</td>
                        <td class="no-border" valign="top">:</td>
                        <td class="no-border" valign="top" colspan="2">{{ $data->npwr }}</td>
                    </tr>
                    
                    <!-- Payment Purpose -->
                    <tr class="no-border">
                        <td class="no-border" valign="top" style="width: 5%;">c)</td>
                        <td class="no-border" valign="top" colspan="4">Sebagai Pembayaran : Retribusi Kebersihan Bulan 
                            @php
                                $bulanArr = explode(',', $data->bulan);
                                $formattedBulan = array_map('format_bulan', $bulanArr);
                                $last = array_pop($formattedBulan);
                            @endphp
                            {{ implode(', ', $formattedBulan) . (count($formattedBulan) ? ' dan ' : '') . $last }}
                        </td>
                    </tr> 
                    
                    <!-- Payment Details Table -->
                    <tr class="no-border">
                        <td class="no-border" colspan="5">
                            <table style="width: 100%;">
                                <tr>
                                    <td colspan="6" style="text-align: center;">Kode Rekening</td>
                                    <td style="text-align: center;">Jumlah(Rp)</td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;">4</td>
                                    <td style="text-align: center;">1</td>
                                    <td style="text-align: center;">02</td>
                                    <td style="text-align: center;">01</td>
                                    <td style="text-align: center;">02</td>
                                    <td style="text-align: center;">0001</td>
                                    <td style="text-align: right;">Rp.{{ number_format($data->jumlah, 2, ',', '.') }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    
                    <!-- Date Received -->
                    <tr class="no-border">
                        <td class="no-border" style="width: 5%;">d)</td>
                        <td class="no-border" style="width: 21%;">Tanggal diterima uang</td>
                        <td class="no-border" style="width: 3%;">:</td>
                        <td class="no-border" colspan="2">{{ format_tanggal_bulan($data->tgl_pembayaran) }}</td>
                    </tr>
                    
                    <!-- Signature Section -->
                    <tr class="no-border">
                        <td class="no-border" colspan="5" style="text-align: center;">
                            <table style="width: 100%;" class="no-border">
                                <tr class="no-border">
                                    <td class="no-border" style="width: 50%;">&nbsp;</td>
                                    <td class="no-border" style="width: 50%;"></td>
                                </tr>
                                <tr class="no-border">
                                    <td class="no-border" style="width: 50%;">mengetahui,</td>
                                    <td class="no-border" style="width: 50%;"></td>
                                </tr>
                                <?php
                                if($data->pimpinan->status_jabatan=='2'){
                                    $jabatan = 'PLT '. $data->pimpinan->jabatan;
                                }elseif($data->pimpinan->status_jabatan=='3'){
                                    $jabatan = 'PLH '. $data->pimpinan->jabatan;
                                }else{
                                    $jabatan = $data->pimpinan->jabatan;
                                }
                                ?>
                                <tr class="no-border">
                                    <td class="no-border" style="width: 50%;">{{ $jabatan }}</td>
                                    <td class="no-border" style="width: 50%;">Pembayar/Penyetor</td>
                                </tr>
                                <tr class="no-border">
                                    <td class="no-border" style="width: 50%;"><div class="signature"></div></td>
                                    <td class="no-border" style="width: 50%;"><div class="signature"></div></td>
                                </tr>
                                <tr class="no-border">
                                    <td class="no-border" style="width: 50%;"><u>{{ $data->pimpinan->nama }}</u></td>
                                    <td class="no-border" style="width: 50%;"><u>{{ $data->nama }}</u></td>
                                </tr>
                                <tr class="no-border">
                                    <td class="no-border" style="width: 50%;">NIP.{{ $data->pimpinan->nip }}</td>
                                    <td class="no-border" style="width: 50%;"></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    
                    <!-- Mengetahui Section -->
                    <tr class="no-border">
                        <td class="no-border" colspan="5">
                            <table style="width: 100%;" border="0">
                                <tr>
                                    <td style="width: 50%;">Mengetahui</td>
                                    <td style="width: 50%;"></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- Footer Notes -->
                    <tr class="no-border">
                        <td class="no-border" colspan="5" class="footer">
                            Lembar 1 : Untuk Wajib Retribusi<br>
                            Lembar 2 : Untuk Petugas Pemungut Retribusi
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>