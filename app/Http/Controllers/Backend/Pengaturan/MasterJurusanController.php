<?php

namespace App\Http\Controllers\Backend\Pengaturan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Master\Jurusan;
use DataTables;

class MasterJurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Jurusan::orderBy('created_at', 'desc');

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                        $btn = '<div class="btn-group mb-3" role="group" aria-label="Basic example">
                        <a href="'.route('master-jurusan.edit', $data->id).'"><button type="button" class="btn btn-sm btn-icon icon-left btn-success"><i class="fas fa-pencil-alt"></i> Edit</button></a>
                        <button type="button" id="'.$data->id.'" class="delete btn btn-sm btn-icon icon-left btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                    </div>';
                    
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('backend.pengaturan.jurusan.index', ['root'=>'master', 'sub'=>'jurusan']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pengaturan.jurusan.create', ['root'=>'master']);
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
            'name' => 'required|max:255'
        ]);

        $req = $request->all();
        $jurusan = Jurusan::create($req);

        \Session::flash("result", [
            'title' => 'Sukses!',
            'type' => 'success',
            "message" => "Jurusan berhasil ditambahkan."
        ]);
        
        return redirect()->route('master-jurusan.index', ['root'=>'master']);
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
        $data = Jurusan::findOrFail($id);
        return view('backend.pengaturan.jurusan.edit', ['root'=>'master', 'data'=>$data]);
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
            'name' => 'required|max:255'
        ]);
        
        $jurusan = Jurusan::findOrFail($id);
        $req = $request->all();
        $jurusan->update($req);

        \Session::flash("result", [
            'title' => 'Sukses!',
            'type' => 'success',
            "message" => "Data jurusan berhasil diubah."
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
        $data = Jurusan::findOrFail($id);
        
        if (count($data->prodi) < 1) {
            $data->destroy($id);            

            $title = 'Sukses!';
            $type = 'success';
            $mesaage = 'Jurusan berhasil dihapus!';
        } else {
            $title = 'Gagal!';
            $type = 'info';
            $mesaage = 'Ada program studi yang terkait dengan jurusan, data jurusan tidak dapat dihapus!';
        }

        return response()->json([
            'title' => $title,
            'type' => $type,
            'message'=> $mesaage
        ]);
    }
}
