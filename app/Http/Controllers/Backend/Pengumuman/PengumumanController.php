<?php

namespace App\Http\Controllers\Backend\Pengumuman;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\Model\Pengumuman\Pengumuman;
use App\Model\Pengumuman\KategoriPengumuman as Kategori;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Pengumuman::with(['category:id,name', 'user:id,name,photo']); 

            if(isset($request->navigasi)) {
                if($request->navigasi == 'publish') {
                    $data->where('status', 'publish');
                }
                if($request->navigasi == 'unpublish') {
                    $data->where('status', 'unpublish');
                }
            };            
            $data->orderBy('created_at', 'desc');
            $data->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('title', function($data) {
                    $title = $data->title.'
                    <div class="table-links">
                        <a href="'.route('f-announ', $data->slug).'" target="_blank">Lihat</a>
                        <div class="bullet"></div>
                        <a href="'.route('pengumuman.edit', $data->id).'">Edit</a>
                        <div class="bullet"></div>
                        <a href="#" id="'.$data->id.'" class="delete text-danger">Hapus</a>
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
                    if ($data->status == 'publish') {
                        $status = '<span class="badge badge-success">Publish</span>';
                    } else if ($data->status == 'draft') {
                        $status = '<span class="badge badge-warning">Draft</span>';
                    } else if ($data->status == 'unpublish') {
                        $status = '<span class="badge badge-secondary">Unpublish</span>';
                    } else {
                        $status = '<span class="badge badge-light">-</span>';
                    }
                    
                    return $status;
                })
                ->rawColumns(['author', 'checkbox', 'status', 'title'])
                ->make(true);
        }

        return view('backend.pengumuman.pengumuman.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::orderby('name', 'asc')->pluck('name', 'id');

        return view('backend.pengumuman.pengumuman.create', compact('kategori'));
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
            'title' => 'required|max:255|unique:posts,title',
            'status' => 'required',
            'image' => 'nullable|mimes:jpeg,jpg,png',
            'file' => 'nullable|mimes:pdf,xls,xlsx,ppt,pptx,doc,docx,jpeg,jpg,png|max:3072'
        ]);

        $req = $request->except(['image', 'file']);
        $req['user_id'] = \Auth::user()->id;

        if($request->hasFile('image')) {
            $path = storage_path('app/public/pengumuman/cover');
   
            if(!\File::isDirectory($path)){
                \File::makeDirectory($path, 0755, true, true);
            }

            $image = $request->file('image');
            $images = str_slug($req['title']) . '_' . time() . '.' . $image->getClientOriginalExtension();
            \Image::make($image)->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path('app/public/pengumuman/cover/' . $images));

            $req['image'] = $images;
        }

        if($request->hasFile('file')) {
            $path = storage_path('app/attachments/pengumuman/');
   
            if(!File::isDirectory($path)) {
                File::makeDirectory($path, 0755, true, true);
            }

            $file = $request->file('file');
            $files = md5(time().'-'.rand()) . '.' . $file->getClientOriginalExtension();
            $file->move($path, $files);

            $req['file'] = $files;
        }

        $data = Pengumuman::create($req);
        
        \Session::flash("result", [
            'title' => 'Sukses!',
            'type' => 'success',
            "message" => "Pengumuman berhasil ditambahkan."
        ]);
        
        return redirect()->route('pengumuman.index');
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
        $kategori = Kategori::orderby('name', 'asc')->pluck('name', 'id');
        $data = Pengumuman::findOrFail($id);
        
        return view('backend.pengumuman.pengumuman.edit', compact(['data', 'kategori']));
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
            'title' => 'required|max:255|unique:posts,title',
            'status' => 'required',
            'image' => 'nullable|mimes:jpeg,jpg,png',
            'file' => 'nullable|mimes:pdf,xls,xlsx,ppt,pptx,doc,docx,jpeg,jpg,png|max:3072'
        ]);
        
        $data = Pengumuman::findOrFail($id);
        $req = $request->except(['image', 'file']);

        if($request->hasFile('image')) {
            $path = storage_path('app/public/pengumuman/cover');
   
            if(!\File::isDirectory($path)){
                \File::makeDirectory($path, 0755, true, true);
            }

            if(!empty($data->image)){
                $path = storage_path('app/public/pengumuman/cover/'.$data->image);
                
                if(file_exists($path)) {
                    unlink($path);
                }
            }

            $image = $request->file('image');
            $images = str_slug($req['title']) . '_' . time() . '.' . $image->getClientOriginalExtension();
            \Image::make($image)->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path('app/public/pengumuman/cover/' . $images));

            $req['image'] = $images;
        }

        if($request->hasFile('file')) {
            $path = storage_path('app/attachments/pengumuman/');
   
            if(!\File::isDirectory($path)) {
                \File::makeDirectory($path, 0755, true, true);
            }

            if(!empty($data->file)){
                $path = storage_path('app/attachments/pengumuman/'.$data->file);
                
                if(file_exists($path)) {
                    unlink($path);
                }
            }

            $file = $request->file('file');
            $files = md5(time().'-'.rand()) . '.' . $file->getClientOriginalExtension();
            $file->move($path, $files);

            $req['file'] = $files;
        }

        $data->update($req);
        
        \Session::flash("result", [
            'title' => 'Sukses!',
            'type' => 'success',
            "message" => "Pengumuman berhasil diubah." 
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
        $data = Pengumuman::findOrFail($id);

        $data->destroy($id);
        
        return response()->json([
            'title' => 'Sukses!',
            'type' => 'success',
            "message" => "Pengumuman berhasil dihapus."
        ]);
    }
}
