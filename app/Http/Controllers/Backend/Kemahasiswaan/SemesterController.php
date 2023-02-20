<?php

namespace App\Http\Controllers\Backend\Kemahasiswaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\Model\Kemahasiswaan\CapaianSemester;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if(\Auth::user()->hasRole(['mahasiswa'])) {
                $data = CapaianSemester::orderBy('semester', 'asc')->with('mahasiswa');
                $data->where('mahasiswa_id', \Auth::user()->mahasiswa->id);
                $data->get();

                return $this->dtUser($data);
            } else {
                $data = $this->getMahasiswa($request);

                return $this->dtAdmin($data);
            }
        }

        if(\Auth::user()->hasRole(['mahasiswa'])) {
            return view('backend.capaian-semester.index', ['root'=>'semester']);
        } else {
            $prodi =  \App\Model\Master\Prodi::select(\DB::raw("prodi.id as id_prodi, concat(tingkat_pendidikan.name, ' - ',prodi.name) as names"))
            ->join('tingkat_pendidikan', 'tingkat_pendidikan.id', '=', 'prodi.tingkat_id')
            ->orderBy('names', 'asc')
            ->pluck('names', 'id_prodi')->all();
            
            return view('backend.capaian-semester.index-admin', ['root'=>'semester', 'prodi'=>$prodi]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = null)
    {
        return view('backend.capaian-semester.create', ['root'=>'semester', 'id'=>$id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'semester' => 'required|numeric',
            'jumlah_sks' => 'required|numeric',
            'ipk' => 'required|between:0,4.00',
            'file' => 'required|mimes:pdf|max:2000'
        ]);

        $req = $request->except(['file']);
        $req['ipk'] = str_replace(',', '.', $req['ipk']);
        if(\Auth::user()->hasRole(['mahasiswa'])) {
            $req['mahasiswa_id'] = \Auth::user()->mahasiswa->id;
        } else if (\Auth::user()->hasRole(['super-admin', 'admin-jurusan'])) {
            $req['mahasiswa_id'] = $request->id;
        }

        $data = CapaianSemester::create($req);

        if($request->hasFile('file')) {
            $path = storage_path('app/attachments/mahasiswa/'.$data->mahasiswa_id.'/khs/');
       
            if(!\File::isDirectory($path)) {
                \File::makeDirectory($path, 0755, true, true);
            }

            $file = $request->file('file');
            $files = md5(time().'-'.rand()) . '.' . $file->getClientOriginalExtension();
            $file->move($path, $files);
            
            $data->file = $files;
            $data->save();
        }

        \Session::flash("result", [
            'title' => 'Sukses!',
            'type' => 'success',
            "message" => "Data capaian semester berhasil ditambahkan."
        ]);
        
        return redirect()->route('capaian-semester.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = CapaianSemester::findOrFail($id);
        if(\Auth::user()->hasRole('mahasiswa')) {
            if(\Auth::user()->mahasiswa->id != $data->mahasiswa_id) {
                return abort(404);
            }
        } else if (!\Auth::user()->hasRole(['super-admin', 'admin-jurusan'])){
            return abort(404);
        }

        $myFile = storage_path('app/attachments/mahasiswa/'.$data->mahasiswa->id.'/khs/'.$data->file);

    	return response()->download($myFile);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = CapaianSemester::findOrFail($id);

        return view('backend.capaian-semester.edit', ['root'=>'semester', 'id'=>$id, 'data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'semester' => 'required|numeric',
            'jumlah_sks' => 'required|numeric',
            'ipk' => 'required|between:0,4.00',
            'file' => 'nullable|mimes:pdf|max:2000'
        ]);

        $req = $request->except(['file']);
        $req['ipk'] = str_replace(',', '.', $req['ipk']);

        $data = CapaianSemester::findOrFail($id);
        $data->update($req);

        if($request->hasFile('file')) {
            $path = storage_path('app/attachments/mahasiswa/'.$data->mahasiswa_id.'/khs/');
       
            if(!\File::isDirectory($path)) {
                \File::makeDirectory($path, 0755, true, true);
            }

            if(!empty($data->file)) {
                $loc = storage_path('app/attachments/mahasiswa/'.$data->mahasiswa_id.'/khs/'.$data->file);
                
                if(file_exists($loc)) {
                    unlink($loc);
                }
            }

            $file = $request->file('file');
            $files = md5(time().'-'.rand()) . '.' . $file->getClientOriginalExtension();
            $file->move($path, $files);
            
            $data->file = $files;
            $data->save();
        }

        \Session::flash("result", [
            'title' => 'Sukses!',
            'type' => 'success',
            "message" => "Data capaian semester berhasil diubah."
        ]);
        
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = CapaianSemester::findOrFail($id);
        if(\Auth::user()->hasRole('mahasiswa')) {
            if(\Auth::user()->mahasiswa->id != $data->mahasiswa_id) {
                return abort(404);
            }
        } else if (!\Auth::user()->hasRole(['super-admin', 'admin-jurusan'])){
            return abort(404);
        }

        if(!empty($data->file)){
            $path = storage_path('app/attachments/mahasiswa/'.$data->mahasiswa_id.'/khs/'.$data->file);
            
            if(file_exists($path)) {
                unlink($path);
            }
        }

        $data->delete();

        return response()->json([
            'title' => 'Sukses!',
            'type' => 'success',
            'message'   => 'Data berhasil dihapus.'
        ]);
    }

    /**
     * Get data for all mahasiswa data
     */
    private function getMahasiswa(Request $request)
    {
        $data = \App\Model\Mahasiswa\Mahasiswa::select(['id', 'npm', 'nama', 'tahun_masuk', 'prodi_id'])
            ->whereHas('semester')
            ->with(['prodi']);
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

        return $data;
    }

    /**
     * return datatable for admin
     */
    private function dtAdmin($data)
    {
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
                $ret = '<div class="media">
                    <img alt="image" class="mr-3 rounded-circle" width="40" height="40" src="'.$photo.'">
                    <div class="media-body">
                    <div class="media-title">'.$data->nama.'</div>
                        <div class="text-job text-muted">'.$data->prodi->full_name.'</div>
                    </div>
                </div>';

                return $ret;
            })
            ->addColumn('action', function($data) {
                    $btn = '<button data-id="'.$data->id.'" type="button" class="btn btn-sm btn-icon icon-left btn-warning detail-semester"><i class="far fa-eye"></i> Lihat Data</button>';
                
                return $btn;
            })
            ->rawColumns(['nama', 'action'])
            ->make(true);
    }

    private function dtUser($data)
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('semester', '{{ romawi($semester) }} ({{ ucfirst(terbilang($semester)) }})')
            ->addColumn('file', function($data){
                if(isset($data->file) && $data->file != null) {
                    $btn = '<a href="'.route('capaian-semester.show', $data->id).'" class="btn btn-sm btn-primary btn-icon icon-left"><i class="fas fa-file-download"></i> Unduh</a>';
                } else {
                    $btn = '-';
                }

                return $btn;
            })
            ->addColumn('action', function($data){
                    $btn = '<div class="btn-group" role="group" aria-label="Basic example">
                    <a href="'.route('capaian-semester.edit', $data->id).'"><button type="button" class="btn btn-sm btn-icon icon-left btn-success"><i class="fas fa-pencil-alt"></i> Edit</button></a>
                    <button type="button" id="'.$data->id.'" class="delete btn btn-sm btn-icon icon-left btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                </div>';
                
                return $btn;
            })
            ->rawColumns(['file', 'action'])
            ->make(true);
    }

    public function detail(Request $request)
    {
        $data = \App\Model\Mahasiswa\Mahasiswa::select(['id', 'nama', 'npm'])
            ->with(['semester' => function($q) {
                $q->orderBy('semester', 'asc');
            }])
            ->find($request->id);

        $ret = '';
        
        foreach($data->semester as $i => $value) {
            if(isset($value->file) && $value->file != null) {
                $btn = '<a href="'.route('capaian-semester.show', $value->id).'" class="btn btn-sm btn-primary btn-icon icon-left"><i class="fas fa-file-download"></i> Unduh</a>';
            } else {
                $btn = '-';
            }

            $i += 1;
            $ret = $ret.'<tr>
                <td>'.$i.'</td>
                <td>'.romawi($value->semester).' ('.ucfirst(terbilang($value->semester)).')</td>
                <td>'.$value->jumlah_sks.'</td>
                <td>'.$value->ipk.'</td>
                <td>'.$btn.'</td>
            </tr>';
        };

        return '<div class="modal-content detail-content">
            <div class="modal-header">
                <h5 class="modal-title">'.$data->nama.'  ('.$data->npm.')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="detailTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Semester</th>
                                <th>Jumlah SKS</th>
                                <th>Indeks Prestasi</th>
                                <th>KHS</th>
                            </tr>
                        </thead>
                        <tbody>'.$ret.'</tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
            </div>
        </div>';
    }
}