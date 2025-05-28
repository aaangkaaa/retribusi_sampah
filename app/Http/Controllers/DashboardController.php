<?php

namespace App\Http\Controllers;
use App\Models\MasterTarif;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    protected $dashboard;

    // Menggunakan dependency injection
    public function __construct(Dashboard $dashboard)
    {
        $this->dashboard = $dashboard;
    }

    public function index(){
        return view('dashboard');
    }
}
