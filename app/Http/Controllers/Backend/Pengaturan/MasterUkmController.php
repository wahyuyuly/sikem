<?php

namespace App\Http\Controllers\Backend\Pengaturan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Master\UKM;
use DataTables;

class MasterUkmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = UKM::orderBy('created_at', 'desc');

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                        $btn = '<div class="btn-group mb-3" role="group" aria-label="">
                        <a href="'.route('master-ukm.edit', $data->id).'"><button type="button" class="btn btn-sm btn-icon icon-left btn-success"><i class="fas fa-pencil-alt"></i> Edit</button></a>
                        <button type="button" id="'.$data->id.'" class="delete btn btn-sm btn-icon icon-left btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                    </div>';
                    
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('backend.pengaturan.ukm.index', ['root'=>'master', 'sub'=>'ukm']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pengaturan.ukm.create', ['root'=>'master', 'sub'=>'ukm']);
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
            'name' => 'required|max:255|unique:ukm,name'
        ]);

        $req = $request->all();
        $data = UKM::create($req);

        \Session::flash("result", [
            'title' => 'Sukses!',
            'type' => 'success',
            "message" => "UKM berhasil ditambahkan."
        ]);
        
        return redirect()->route('master-ukm.index');
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
        $data = UKM::findOrFail($id);
        return view('backend.pengaturan.ukm.edit', ['root'=>'master', 'data'=>$data]);
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
            'name' => 'required|max:255|unique:ukm,name,'.$id
        ]);
        
        $data = UKM::findOrFail($id);
        $req = $request->all();
        $data->update($req);

        \Session::flash("result", [
            'title' => 'Sukses!',
            'type' => 'success',
            "message" => "Data UKM berhasil diubah."
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
        $data = UKM::findOrFail($id);
        
        if (count($data->minat) < 1) {
            $data->destroy($id);            

            $title = 'Sukses!';
            $type = 'success';
            $mesaage = 'UKM berhasil dihapus!';
        } else {
            $title = 'Gagal!';
            $type = 'info';
            $mesaage = 'Ada data yang terkait dengan ukm, data ukm tidak dapat dihapus!';
        }

        return response()->json([
            'title' => $title,
            'type' => $type,
            'message'=> $mesaage
        ]);
    }
}
