<?php

namespace App\Http\Controllers\Backend\Pengaturan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Master\Prodi;
use DataTables;

class MasterProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Prodi::with(['jurusan:id,name', 'tingkat:id,name'])->orderBy('created_at', 'desc');

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                        $btn = '<div class="btn-group mb-3" role="group">
                        <a href="'.route('master-prodi.edit', $data->id).'"><button type="button" class="btn btn-sm btn-icon icon-left btn-success"><i class="fas fa-pencil-alt"></i> Edit</button></a>
                        <button type="button" id="'.$data->id.'" class="delete btn btn-sm btn-icon icon-left btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                    </div>';
                    
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('backend.pengaturan.prodi.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jurusan = \App\Model\Master\Jurusan::pluck('name','id')->all();
        $tingkat = \App\Model\Master\TingkatPendidikan::orderBy('name', 'asc')->pluck('name','id')->all();

        return view('backend.pengaturan.prodi.create', compact(['jurusan', 'tingkat']));
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
            'jurusan_id' => 'required',
            'tingkat_id' => 'required',
            'name' => 'required|max:255'
        ]);

        $req = $request->all();
        $prodi = Prodi::create($req);

        \Session::flash("result", [
            'title' => 'Sukses!',
            'type' => 'success',
            "message" => "Program Studi berhasil ditambahkan."
        ]);
        
        return redirect()->route('master-prodi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Prodi::findOrFail($id);
        $jurusan = \App\Model\Master\Jurusan::pluck('name','id')->all();
        $tingkat = \App\Model\Master\TingkatPendidikan::orderBy('name', 'asc')->pluck('name','id')->all();

        return view('backend.pengaturan.prodi.edit', compact(['data', 'jurusan', 'tingkat']));
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
            'jurusan_id' => 'required',
            'tingkat_id' => 'required',
            'name' => 'required|max:255'
        ]);        
        
        $prodi = Prodi::findOrFail($id);
        $req = $request->all();

        $prodi->update($req);

        \Session::flash("result", [
            'title' => 'Sukses!',
            'type' => 'success',
            "message" => "Program Studi berhasil diubah."
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
        $data = Prodi::findOrFail($id);
        
        if (isset($data->mahasiswa) && $data->mahasiswa != null) {
            $data->destroy($id);            

            $title = 'Sukses!';
            $type = 'success';
            $mesaage = 'Program Studi berhasil dihapus!';
        } else {
            $title = 'Gagal!';
            $type = 'info';
            $mesaage = 'Ada mahasiswa yang terkait dengan program studi, data program studi tidak dapat dihapus!';
        }

        return response()->json([
            'title' => $title,
            'type' => $type,
            'message'=> $mesaage
        ]);
    }
}
