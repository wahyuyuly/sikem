<?php

namespace App\Http\Controllers\Backend\Kemahasiswaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\Model\Kemahasiswaan\Organisasi;

class OrganisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(\Auth::user()->hasRole(['mahasiswa'])) {
            $id = \Auth::user()->mahasiswa->id; 
        } else {
            $id = $request->data;
        }
        if ($request->ajax()) {
            $data = Organisasi::orderBy('tahun_sk', 'asc')
                ->where('mahasiswa_id', $id)
                ->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('file', function($data){
                    if($data->file != null) {
                        $btn = '<a href="'.route('organisasi.show', $data->id).'" class="btn btn-sm btn-primary btn-icon icon-left"><i class="fas fa-file-download"></i> Unduh</a>';
                    } else {
                        $btn = '-';
                    }

                    return $btn;
                })
                ->addColumn('action', function($data){
                        $btn = '<div class="btn-group" role="group" aria-label="Basic example">
                        <a href="'.route('organisasi.edit', $data->id).'"><button type="button" class="btn btn-sm btn-icon icon-left btn-success"><i class="fas fa-pencil-alt"></i> Edit</button></a>
                        <button type="button" id="'.$data->id.'" class="delete btn btn-sm btn-icon icon-left btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                    </div>';
                    
                    return $btn;
                })
                ->rawColumns(['file', 'action'])
                ->make(true);
        }

        return view('backend.organisasi.index', ['root'=>'organisasi']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = null)
    {
        return view('backend.organisasi.create', ['root'=>'organisasi', 'id'=>$id]);
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
            'nama' => 'required',
            'tahun_sk' => 'required',
            'file' => 'required|mimes:pdf|max:20000'
        ]);
        
        $req = $request->except(['file']);
        if(\Auth::user()->hasRole(['mahasiswa'])) {
            $req['mahasiswa_id'] = \Auth::user()->mahasiswa->id;
        } else if (\Auth::user()->hasRole(['super-admin', 'admin-jurusan'])) {
            $req['mahasiswa_id'] = $request->id;
        }

        $data = Organisasi::create($req);

        if($request->hasFile('file')) {
            $path = storage_path('app/attachments/mahasiswa/'.$data->mahasiswa_id.'/organisasi/');
       
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
            "message" => "Data riwayat organisasi berhasil ditambahkan."
        ]);

        return redirect()->route('organisasi.index', ['root'=>'organisasi']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Organisasi::findOrFail($id);
        if(\Auth::user()->hasRole('mahasiswa')) {
            if(\Auth::user()->mahasiswa->id != $data->mahasiswa_id) {
                return abort(404);
            }
        } else if (!\Auth::user()->hasRole(['super-admin', 'admin-jurusan'])){
            return abort(404);
        }

        $myFile = storage_path('app/attachments/mahasiswa/'.$data->mahasiswa->id.'/organisasi/'.$data->file);

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
        $data = Organisasi::findOrFail($id);

        return view('backend.organisasi.edit', ['root'=>'organisasi', 'id'=>$id, 'data'=>$data]);
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
            'nama' => 'required',
            'tahun_sk' => 'required',
            'file' => 'nullable|mimes:pdf|max:20000'
        ]);

        $req = $request->except(['file']);

        $data = Organisasi::findOrFail($id);
        $data->update($req);

        if($request->hasFile('file')) {
            $path = storage_path('app/attachments/mahasiswa/'.$data->mahasiswa_id.'/organisasi/');
       
            if(!\File::isDirectory($path)) {
                \File::makeDirectory($path, 0755, true, true);
            }

            if(!empty($data->file)) {
                $loc = storage_path('app/attachments/mahasiswa/'.$data->mahasiswa_id.'/organisasi/'.$data->file);
                
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
            "message" => "Data riwayat organisasi berhasil diubah."
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
        $data = Organisasi::findOrFail($id);
        if(\Auth::user()->hasRole('mahasiswa')) {
            if(\Auth::user()->mahasiswa->id != $data->mahasiswa_id) {
                return abort(404);
            }
        } else if (!\Auth::user()->hasRole(['super-admin', 'admin-jurusan'])){
            return abort(404);
        }

        if(!empty($data->file)){
            $path = storage_path('app/attachments/mahasiswa/'.$data->mahasiswa_id.'/organisasi/'.$data->file);
            
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
}
