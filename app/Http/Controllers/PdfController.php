<?php

namespace App\Http\Controllers;

use Barryvdh\Snappy\Facades\SnappyPdf;

class PdfController extends Controller
{
    public function cetak()
    {
        
        ini_set('memory_limit', -1);
		ini_set('max_execution_time', -1);
        $data = 'Ini contoh data yang akan dimasukkan ke PDF';

        $html = view('pdf.template', compact('data'))->render();

        return SnappyPdf::loadHTML($html)
            ->setPaper('a4')
            ->setOption('margin-top', 10)
            ->inline('laporan.pdf'); // atau ->download('laporan.pdf');
    }
}
