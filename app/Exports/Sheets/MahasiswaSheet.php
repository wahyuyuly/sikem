<?php

namespace App\Exports\Sheets;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use App\Model\Mahasiswa\Mahasiswa;

class MahasiswaSheet implements FromView, WithTitle
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
            'id', 'npm', 'nama', 'nama_panggilan', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'agama', 'suku_bangsa', 'golongan_darah', 'rhesus', 'tinggi_badan', 'berat_badan', 'anak_ke', 'jumlah_saudara', 'prodi_id', 'tahun_masuk', 'jalur_penerimaan', 'status', 'tanggal_yudisium', 'account_id', 'telp', 'alamat', 'kelurahan_id', 'alamat_tinggal', 'kelurahan_tinggal', 'status_tinggal'
            ])
            ->whereIn('status', $this->req['status'])
            ->whereIn('prodi_id', $this->req['prodi_id'])
            ->whereBetween('tahun_masuk', [$start, $end])
            ->whereIn('jenis_kelamin', $this->req['jenis_kelamin'])
            ->whereIn('agama', $this->req['agama'])
            ->get();

        return view('report.export.mahasiswa', ['data' => $data]);
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Data Mahasiswa';
    }
}