<?php

namespace App\Http\Controllers\Backend\Mahasiswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Mahasiswa\Mahasiswa;
use App\Model\Mahasiswa\FileMahasiswa;
use DataTables;

class FileController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return "aa";
        if(\Auth::user()->hasRole(['mahasiswa'])) {
            $id = \Auth::user()->mahasiswa->id; 
        } else {
            $id = $request->data;
        }
        if ($request->ajax()) {
            $data = FileMahasiswa::orderBy('created_at', 'asc')
                ->where('mahasiswa_id', $id)
                ->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('file', function($data){
                    $status = '<a href="'.route('download.mahasiswa', $data->id).'" class="btn btn-sm btn-primary btn-icon icon-left"><i class="fas fa-file-download"></i> Unduh</a>';
                    
                    return $status;
                })
                ->addColumn('action', function($data){
                        $btn = '<button type="button" id="'.$data->id.'" class="delete btn btn-sm btn-icon icon-left btn-danger"><i class="fas fa-trash"></i> Hapus</button>';
                    
                    return $btn;
                })
                ->rawColumns(['file', 'action'])
                ->make(true);
        }
        return view('backend.file.index');
    }
    
    //
    public function create($id)
    {
        return view('backend.file.create', with(['id'=>$id]));
    }

    /**
     * Store uploaded file
     */
    public function upload(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'file' => 'required|max:25600|mimes:jpeg,jpg,png,pdf,zip,rar,xls,xlsx,doc,docx,ppt,pptx'
        ]);
        
        $mahasiswa = Mahasiswa::findOrFail($id);
        $data = new FileMahasiswa();
        $data->mahasiswa_id = $mahasiswa->id;
        $data->name = $request->name;
        $data->description = $request->description;

        if($request->hasFile('file')) {
            $path = storage_path('app/attachments/mahasiswa/'.$mahasiswa->npm.'/');
   
            if(!\File::isDirectory($path)) {
                \File::makeDirectory($path, 0755, true, true);
            }

            $file = $request->file('file');
            $files = md5(time().'-'.rand()) . '.' . $file->getClientOriginalExtension();
            $file->move($path, $files);

            $data->file = $files;
        }
        $data->save();

        \Session::flash("result", [
            'title' => 'Sukses!',
            'type' => 'success',
            "message"   => "Berhasil menambahkan berkas."
        ]);

        return redirect()->route('mahasiswa.show', $id);
    }

    public function destroy($id)
    {
        $data = FileMahasiswa::findOrFail($id);
        if(\Auth::user()->hasRole('mahasiswa')) {
            if(\Auth::user()->mahasiswa->id != $data->mahasiswa_id) {
                return abort(404);
            }
        } else if (!\Auth::user()->hasRole(['super-admin', 'admin-jurusan'])){
            return abort(404);
        }

        if(!empty($data->file)){
            $path = storage_path('app/attachments/mahasiswa/'.$data->mahasiswa->npm.'/'.$data->file);
            
            if(file_exists($path)) {
                unlink($path);
            }
        }

        $data->delete();

        \Session::flash("result", [
            'title' => 'Sukses!',
            'type' => 'warning',
            "message"   => "Dokumen berhasil dihapus."
        ]);

        return redirect()->back();
    }
}
