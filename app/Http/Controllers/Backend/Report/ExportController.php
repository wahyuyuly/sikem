<?php

namespace App\Http\Controllers\Backend\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\MahasiswaExport;

class ExportController extends Controller
{
    //
    public function index()
    {
        $prodi =  \App\Model\Master\Prodi::select(\DB::raw("prodi.id as id_prodi, concat(tingkat_pendidikan.name, ' - ',prodi.name) as names"))
            ->join('tingkat_pendidikan', 'tingkat_pendidikan.id', '=', 'prodi.tingkat_id')
            ->orderBy('names', 'asc')
            ->pluck('names', 'id_prodi')->all();

        return view('backend.report.export.index', ['root'=>'export', 'prodi'=>$prodi]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'status' => 'required',
            'prodi_id' => 'required',
            'tahun_start' => 'nullable',
            'tahun_end' => 'nullable|gte:tahun_start',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
        ]);

        $req = $request->all();

        return (new MahasiswaExport($req))->download('Report_Mahasiswa_'.\Carbon\Carbon::today()->format('dmY').'.xlsx');
    }
}
