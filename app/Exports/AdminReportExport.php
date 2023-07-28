<?php

namespace App\Exports;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;


class AdminReportExport implements FromView
{
    protected $title;
    protected $datas;
    protected $periode;
    public function __construct($datas, $periode, $title)
    {
        $this->title = $title;
        $this->datas = $datas;
        $this->periode = $periode;
    }

    public function view(): View
    {
        return view('print_pdf.print_admin_laporan_confirmed', [
            'title' => $this->title,
            'periode' => $this->periode,
            'current_date' => Carbon::now()->format('d-m-Y H:i:s'),
            'items' => $this->datas
        ]);
    }
}
