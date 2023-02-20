<?php

namespace App\Http\Controllers\Backend\Artikel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use Auth;
use Session;
use File;
use Image;

use App\Model\Artikel\Artikel;
use App\Model\Artikel\Kategori;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Artikel::with(['category:id,name', 'user:id,name,photo']);
            if(Auth::user()->hasRole(['bem'])) {
                $data->where('user_id', Auth::user()->id);
            }

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
                        <a href="'.route('f-detail', $data->slug).'" target="_blank">Lihat</a>
                        <div class="bullet"></div>
                        <a href="'.route('artikel.edit', $data->id).'">Edit</a>
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

        return view('backend.artikel.artikel.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::orderby('name', 'asc')->pluck('name', 'id');

        return view('backend.artikel.artikel.create', compact('kategori'));
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
            'image' => 'nullable|mimes:jpeg,jpg,png'
        ]);

        $req = $request->except(['image']);
        $req['user_id'] = Auth::user()->id;

        if($request->hasFile('image')) {
            $path = storage_path('app/public/posts/cover');
   
            if(!File::isDirectory($path)){
                File::makeDirectory($path, 0755, true, true);
            }

            $image = $request->file('image');
            $images = str_slug($req['title']) . '_' . time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path('app/public/posts/cover/' . $images));

            $req['image'] = $images;
        }

        $data = Artikel::create($req);
        
        Session::flash("result", [
            'title' => 'Sukses!',
            'type' => 'success',
            "message" => "Artikel berhasil ditambahkan."
        ]);
        
        return redirect()->route('artikel.index');
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
        $data = Artikel::findOrFail($id);
        
        return view('backend.artikel.artikel.edit', compact(['data', 'kategori']));
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
            'title' => 'required|max:255|unique:posts,title,'.$id,
            'status' => 'required',
            'image' => 'nullable|mimes:jpeg,jpg,png'
        ]);
        
        $data = Artikel::findOrFail($id);

        $req = $request->except(['image']);
        // $req['user_id'] = Auth::user()->id;

        if($request->hasFile('image')) {
            $path = storage_path('app/public/posts/cover');
   
            if(!File::isDirectory($path)){
                File::makeDirectory($path, 0755, true, true);
            }

            if(!empty($data->photo)){
                $path = storage_path('app/public/posts/cover/'.$data->photo);
                
                if(file_exists($path)) {
                    unlink($path);
                }
            }

            $image = $request->file('image');
            $images = str_slug($req['title']) . '_' . time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path('app/public/posts/cover/' . $images));

            $req['image'] = $images;
        }

        $data->update($req);
        
        Session::flash("result", [
            'title' => 'Sukses!',
            'type' => 'success',
            "message" => "Artikel berhasil diubah."
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
        $data = Artikel::findOrFail($id);

        // if(!empty($data->image)){
        //     $path = storage_path('app/public/posts/cover/'.$data->image);
            
        //     if(file_exists($path)) {
        //         unlink($path);
        //     }
        // }

        $data->destroy($id);
        
        return response()->json([
            'title' => 'Sukses!',
            'type' => 'success',
            "message" => "Artikel berhasil dihapus."
        ]);        
    }
}
