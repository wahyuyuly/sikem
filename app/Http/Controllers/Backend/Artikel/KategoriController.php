<?php

namespace App\Http\Controllers\Backend\Artikel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use Auth;
use Session;
use App\Model\Artikel\Kategori;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Kategori::with(['user:id,name,photo'])->orderBy('created_at', 'desc');
            if(Auth::user()->hasRole(['bem'])) {
                $data->where('user_id', Auth::user()->id);
            }
            $data->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', function($data){
                    $check = '<div class="custom-checkbox custom-control">
                        <input name="check[]" value="'.$data->id.'" type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="'.$data->id.'">
                        <label for="'.$data->id.'" class="custom-control-label">&nbsp;</label>
                    </div>';

                    return $check;
                })
                ->addColumn('author', function($data) {
                    $author = '<img alt="image" src="'.asset("storage/photos/".$data->user->photo).'" class="rounded-circle" width="35" height="35" data-toggle="title" title="">
                    <span class="d-inline-block ml-1">'.$data->user->name.'</span>';

                    return $author;
                })           
                ->addColumn('status', function($data){
                    if ($data->status == 'active') {
                        $status = '<span class="badge badge-primary">Aktif</span>';
                    } else if ($data->status == 'pending') {
                        $status = '<span class="badge badge-warning">Pending</span>';
                    } else if ($data->status == 'non-active') {
                        $status = '<span class="badge badge-light">Tidak Aktif</span>';
                    } else {
                        $status = '<span class="badge badge-light">-</span>';
                    }
                    
                    return $status;
                })
                ->addColumn('action', function($data){
                        $btn = '<div class="btn-group mb-3" role="group" aria-label="Basic example">
                        <a href="'.route('kategori.edit', $data->id).'"><button type="button" class="btn btn-sm btn-icon icon-left btn-success"><i class="fas fa-pencil-alt"></i> Edit</button></a>
                        <button type="button" id="'.$data->id.'" class="delete btn btn-sm btn-icon icon-left btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                    </div>';
                    
                    return $btn;
                })
                ->rawColumns(['checkbox', 'author', 'status', 'action'])
                ->make(true);
        }

        return view('backend.artikel.kategori.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.artikel.kategori.create');
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
            'name' => 'required|max:255|unique:post_category,name',
            'status' => 'required',
        ]);

        $req = $request->all();
        $req['user_id'] = Auth::user()->id;
        $data = Kategori::create($req);

        Session::flash("result", [
            'title' => 'Sukses!',
            'type' => 'success',
            "message"   => "Data kategori berhasil ditambahkan."
        ]);
        
        return redirect()->route('kategori.index');
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
        $data = Kategori::findOrFail($id);

        return view('backend.artikel.kategori.edit', compact(['data']));
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
            'name' => 'required|max:255|unique:post_category,name,'.$id,
            'status' => 'required',
        ]);

        $data = Kategori::findOrFail($id);

        $req = $request->all();
        // $req['user_id'] = Auth::user()->id;
        
        $data->update($req);

        Session::flash("result", [
            'title' => 'Sukses!',
            'type' => 'success',
            "message"   => "Data kategori berhasil diubah."
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
        $data = Kategori::findOrFail($id);
        
        if (count($data->posts) < 1) {
            $data->destroy($id);            

            $title = 'Sukses!';
            $type = 'success';
            $mesaage = 'Kategori berhasil dihapus!';
        } else {
            $title = 'Gagal!';
            $type = 'info';
            $mesaage = 'Ada artikel yang berkaitan, kategori tidak dapat dihapus!';
        }

        return response()->json([
            'title' => $title,
            'type' => $type,
            'message'=> $mesaage
        ]);
    }
}
