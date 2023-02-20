<?php

namespace App\Http\Controllers\Backend\Permohonan\Surat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Permohonan\Legalisir;
use DataTables;
use File;
use Auth;
use Session;

class LegalisirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if(Auth::user()->hasRole('mahasiswa')) {
                $data = Legalisir::where('mahasiswa_id', '=', Auth::user()->mahasiswa->id)
                ->orderBy('created_at', 'desc')->get();
            } else {
                $data = Legalisir::orderBy('created_at', 'desc')->get();
            }
                
            return Datatables::of($data)
                ->addIndexColumn()   
                ->editColumn('status', function($data) {
                    $status = 'light';
                    if($data->status == 'PENDING') {
                        $status = 'warning';
                    } elseif ($data->status == 'DI TOLAK') {
                        $status = 'danger';
                    } elseif ($data->status == 'PROSES') {
                        $status = 'primary';
                    } elseif ($data->status == 'DAPAT DIAMBIL') {
                        $status = 'info';
                    } elseif ($data->status == 'SELESAI') {
                        $status = 'success';
                    }
                    return '<span class="badge badge-'.$status.'">'.$data->status.'</span>';
                })             
                ->addColumn('action', function($data) {
                    if(Auth::user()->hasRole('mahasiswa')) {                     
                        $btn = '<div class="btn-group mb-3" role="group" aria-label="Detail data">
                        <a href="'.route('legalisir.show', $data->id).'"><button type="button" class="btn btn-sm btn-icon icon-left btn-primary"><i class="far fa-eye"></i> Detail</button></a>
                        </div>';
                    } else {
                        $btn = '<div class="btn-group mb-3" role="group" aria-label="Detail data">
                            <a href="'.route('legalisir.show', $data->id).'"><button type="button" class="btn btn-sm btn-icon icon-left btn-primary"><i class="far fa-eye"></i> Detail</button></a><a href="'.route('legalisir.edit', $data->id).'"><button type="button" class="btn btn-sm btn-icon icon-left btn-warning"><i class="far fa-edit"></i> Edit</button></a><button type="button" id="'.$data->id.'" class="delete btn btn-sm btn-icon icon-left btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                        </div>';
                    }
                    
                    return $btn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('backend.permohonan.legalisir.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.permohonan.legalisir.create');
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
            'mahasiswa_id' => 'required',
            'jenis' => 'required',
            'keterangan' => 'required',
            'file' => 'nullable|mimes:pdf|max:3072'
        ]);

        $req = $request->except(['file']);
        $req['nomor'] = uniqid();
        if(Auth::user()->hasRole(['mahasiswa'])) {
            $req['mahasiswa_id'] = Auth::user()->mahasiswa->id;
        }

        if($request->hasFile('file')) {
            $path = storage_path('app/attachments/permohonan/legalisir/');
   
            if(!File::isDirectory($path)) {
                File::makeDirectory($path, 0755, true, true);
            }

            $file = $request->file('file');
            $files = md5(time().'-'.rand()) . '.' . $file->getClientOriginalExtension();
            $file->move($path, $files);

            $req['file'] = $files;
        }

        $data = Legalisir::create($req);
        
        Session::flash("result", [
            'title' => 'Sukses!',
            'type' => 'success',
            "message" => "Permohonan berhasil ditambahkan."
        ]);
        
        return redirect()->route('legalisir.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Legalisir::with(['mahasiswa.account'])->findOrFail($id);
        //dd($data);
        return view('backend.permohonan.legalisir.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Legalisir::with(['mahasiswa.account'])->findOrFail($id);

        return view('backend.permohonan.legalisir.edit', compact('data'));
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
        $data = Legalisir::findOrFail($id);
        $data->status = $request->status;        
        $data->save();

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
        $data = Legalisir::findOrFail($id);
        
        if(!empty($data->file)){
            $path = storage_path('app/attachments/permohonan/legalisir/'.$data->file);
            
            if(file_exists($path)) {
                unlink($path);
            }
        }
        $data->destroy($id);

        return response()->json([
            'title' => 'Sukses!',
            'type' => 'success',
            "message" => "Data berhasil dihapus."
        ]);
    }

    public function upload(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:3072'
        ]);

        $data = Legalisir::findOrFail($id);

        if($request->hasFile('file')) {
            $path = storage_path('app/attachments/permohonan/legalisir/');
   
            if(!File::isDirectory($path)) {
                File::makeDirectory($path, 0755, true, true);
            }

            $file = $request->file('file');
            $files = md5(time().'-'.rand()) . '.' . $file->getClientOriginalExtension();
            $file->move($path, $files);

            $data->file = $files;
        }
        $data->save();

        Session::flash("result", [
            'title' => 'Sukses!',
            'type' => 'success',
            "message" => "Dokumen berhasil perbarui."
        ]);

        return redirect()->back();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generateBukti($id)
    {
        $data = Legalisir::findOrFail($id);
        $pdf = \PDF::loadView('backend.permohonan.legalisir.bukti', [
            'data' => $data,
        ]);
        $pdf->setOptions(['dpi'=>150, 'defaultFont'=>'sans-serif']);
        return $pdf->stream('Bukti Pengambilan Surat_'.md5(microtime()).'.pdf');
    }
}
