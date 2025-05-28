<?php
use Illuminate\Support\Str;

if (!function_exists('generate_uuid')) {
    function generate_uuid()
    {
        return (string) Str::uuid();
    }
}

if (!function_exists('terbilang')) {
    function terbilang($angka)
    {
        $angka = abs($angka);
        $baca = array('', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas');
        $hasil = '';
        if ($angka < 12) {
            $hasil = ' ' . $baca[$angka];
        } elseif ($angka < 20) {
            $hasil = terbilang($angka - 10) . ' belas ';
        } elseif ($angka < 100) {
            $hasil = terbilang($angka / 10) . ' puluh ' . terbilang($angka % 10);
        } elseif ($angka < 200) {
            $hasil = ' seratus ' . terbilang($angka - 100);
        } elseif ($angka < 1000) {
            $hasil = terbilang($angka / 100) . ' ratus ' . terbilang($angka % 100);
        } elseif ($angka < 2000) {
            $hasil = ' seribu ' . terbilang($angka - 1000);
        } elseif ($angka < 1000000) {
            $hasil = terbilang($angka / 1000) . ' ribu ' . terbilang($angka % 1000);
        } elseif ($angka < 1000000000) {
            $hasil = terbilang($angka / 1000000) . ' juta ' . terbilang($angka % 1000000);
        } elseif ($angka < 1000000000000) {
            $hasil = terbilang($angka / 1000000000) . ' milyar ' . terbilang($angka % 1000000000);
        } elseif ($angka < 1000000000000000) {
            $hasil = terbilang($angka / 1000000000000) . ' triliun ' . terbilang($angka % 1000000000000);
        }
        return trim($hasil);
    }
}

if (!function_exists('format_tanggal')) {
    function format_tanggal($tanggal)
    {
        if (!$tanggal) return '';
        $exp = explode('-', $tanggal);
        if (count($exp) === 3) {
            return $exp[2] . '-' . $exp[1] . '-' . $exp[0];
        }
        return $tanggal;
    }
}

if (!function_exists('format_tanggal_bulan')) {
    function format_tanggal_bulan($tanggal)
    {
        if (!$tanggal) return '';
        $exp = explode('-', $tanggal);
        if (count($exp) === 3) {
            return $exp[2] . ' ' . format_bulan($exp[1]) . ' ' . $exp[0];
        }
        return $tanggal;
    }
}

if (!function_exists('format_bulan')) {
    function format_bulan($bulan)
    {
        if (!$bulan) return '';
        
        if ($bulan=='1') {
            return "Januari";
        }
        if ($bulan=='2') {
            return "Februari";
        }
        if ($bulan=='3') {
            return "Maret";
        }
        if ($bulan=='4') {
            return "April";
        }
        if ($bulan=='5') {
            return "Mei";
        }
        if ($bulan=='6') {
            return "Juni";
        }
        if ($bulan=='7') {
            return "Juli";
        }   
        if ($bulan=='8') {
            return "Agustus";
        }
        if ($bulan=='9') {
            return "September";
        }
        if ($bulan=='10') {
            return "Oktober";
        }
        if ($bulan=='11') {
            return "November";
        }
        if ($bulan=='12') {
            return "Desember";
        }
    }
}
