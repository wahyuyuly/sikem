<?php

namespace App\Http\Controllers\Backend\Mahasiswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\Model\Mahasiswa\Mahasiswa;
use App\Model\Master\Prodi;
use Session;

class AlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Mahasiswa::select(['id', 'nama', 'npm', 'prodi_id', 'jenis_kelamin', 'tahun_masuk', 'tanggal_yudisium', 'account_id'])
                ->whereHas('account',function($account) {
                    $account->where('status', '<>', 'pending');
                })
                ->orderBy('created_at', 'asc')
                ->where('status', 'LULUS');
            
            if(isset($request->prodi_id) && !empty($request->prodi_id)) {
                $data->whereIn('prodi_id', $request->prodi_id);
            }

            if(isset($request->tahun_start) && !empty($request->tahun_start)) {
                $data->where('tahun_masuk', '>=', $request->tahun_start);
            }

            if(isset($request->tahun_end) && !empty($request->tahun_end)) {
                $data->where('tahun_masuk', '<=', $request->tahun_end);
            }

            if(isset($request->jenis_kelamin) && !empty($request->jenis_kelamin)) {
                $data->whereIn('jenis_kelamin', $request->jenis_kelamin);
            }

            $data->get();
                
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('nama', function($data){
                    if(!empty($data->account->photo)) {
                        $path = public_path('storage/photos/'.$data->account->photo);
                        
                        if(file_exists($path)) {
                            $photo = asset('storage/photos/'.$data->account->photo);
                        } else {
                            $photo = asset('assets/img/foto-m.png');
                        }
                        
                    } else {
                        $photo = asset('assets/img/foto-m.png');
                    }
                    $prodi = '-';
                    if($data->prodi()->count() > 0) {
                        $prodi = $data->prodi->name;
                    }
                    $ret = '<a href="'.route('mahasiswa.show', $data->id).'"><div class="media">
                        <img alt="image" class="mr-3 rounded-circle" width="40" height="40" src="'.$photo.'">
                        <div class="media-body">
                        <div class="media-title">'.$data->nama.'</div>
                            <div class="text-job text-muted">'.$data->prodi->tingkat->name.' - '.$prodi.'</div>
                        </div>
                    </div></a>';

                    return $ret;
                })
                ->addColumn('action', function($data){
                        $btn = '<div class="btn-group mb-3" role="group" aria-label="Basic example">
                        <a href="'.route('mahasiswa.edit', $data->id).'"><button type="button" class="btn btn-sm btn-icon icon-left btn-success"><i class="fas fa-pencil-alt"></i> Edit</button></a>
                        <button type="button" id="'.$data->id.'" class="delete btn btn-sm btn-icon icon-left btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                    </div>';
                    
                    return $btn;
                })
                ->rawColumns(['nama', 'action'])
                ->make(true);
        }

        $prodi =  \App\Model\Master\Prodi::select(\DB::raw("prodi.id as id_prodi, concat(tingkat_pendidikan.name, ' - ',prodi.name) as names"))
        ->join('tingkat_pendidikan', 'tingkat_pendidikan.id', '=', 'prodi.tingkat_id')
        ->orderBy('names', 'asc')
        ->pluck('names', 'id_prodi')->all();

        return view('backend.alumni.index', ['root'=>'alumni', 'sub'=>'daftar-alumni', 'prodi'=>$prodi]);
    }
}
