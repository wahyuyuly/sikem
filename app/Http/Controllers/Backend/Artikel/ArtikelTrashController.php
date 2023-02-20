<?php

namespace App\Http\Controllers\Backend\Artikel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use Auth;
use Session;

use App\Model\Artikel\Artikel;

class ArtikelTrashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request)
    {
        if ($request->ajax()) {
            $data = Artikel::with(['category:id,name', 'user:id,name,photo']);
            if(Auth::user()->hasRole(['bem'])) {
                $data->where('user_id', Auth::user()->id);
            }
            $data->onlyTrashed();
            $data->orderBy('deleted_at', 'desc');
            $data->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('title', function($data) {
                    $title = $data->title.'
                    <div class="table-links">
                        <a href="#" id="'.$data->id.'" class="restore text-success">Pulihkan</a>
                        <div class="bullet"></div>
                        <a href="#" id="'.$data->id.'" class="delete text-danger">Hapus Permanen</a>
                    </div>';

                    return $title;
                })
                ->addColumn('author', function($data) {
                    $author = '<img alt="image" src="'.asset("storage/photos/".$data->user->photo).'" class="rounded-circle" width="35" height="35" data-toggle="title" title="">
                    <span class="d-inline-block ml-1">'.$data->user->name.'</span>';

                    return $author;
                })
                ->addColumn('checkbox', function($data) {
                    $check = '<div class="custom-checkbox custom-control">
                        <input name="check[]" value="'.$data->id.'" type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="'.$data->id.'">
                        <label for="'.$data->id.'" class="custom-control-label">&nbsp;</label>
                    </div>';

                    return $check;
                })                
                ->addColumn('status', function($data) {                   
                    $status = '<span class="badge badge-danger">Dihapus</span>';
                    return $status;
                })
                ->rawColumns(['author', 'checkbox', 'status', 'title'])
                ->make(true);
        }

        return view('backend.artikel.artikel.trash');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $data = Artikel::onlyTrashed()
            ->where('id', $id)
            ->first();

        $data->restore();
        
        return response()->json([
            'title' => 'Sukses!',
            'type' => 'success',
            "message" => "Artikel berhasil dipulihkan."
        ]);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function force($id)
    {
        $data = Artikel::onlyTrashed()
            ->where('id', $id)
            ->first();

        if(!empty($data->image)){
            $path = storage_path('app/public/posts/cover/'.$data->image);
            
            if(file_exists($path)) {
                unlink($path);
            }
        }

        $data->forceDelete($id);
        
        return response()->json([
            'title' => 'Sukses!',
            'type' => 'success',
            "message" => "Artikel berhasil dihapus permanen."
        ]);
        
    }
}
