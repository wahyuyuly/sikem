<?php

namespace App\Exports\Sheets;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use App\Model\Mahasiswa\Mahasiswa;

class OrangTuaSheet implements FromView, WithTitle
{
    public function __construct(Array $req)
    {
        $this->req = $req;
    }

    /**
     * Passing data to view and export
     */
    public function view(): View
    {
        $start = $this->req['tahun_start'] != null ? $this->req['tahun_start'] : '0';
        $end = $this->req['tahun_end'] != null ? $this->req['tahun_end'] : date('Y');

        $data = Mahasiswa::select([
                'id', 'npm', 'nama'
            ])
            ->whereIn('status', $this->req['status'])
            ->whereIn('prodi_id', $this->req['prodi_id'])
            ->whereBetween('tahun_masuk', [$start, $end])
            ->whereIn('jenis_kelamin', $this->req['jenis_kelamin'])
            ->whereIn('agama', $this->req['agama'])
            ->get();

        return view('report.export.orangtua', ['data' => $data]);
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Data Orang Tua';
    }
}