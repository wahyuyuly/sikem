<?php

namespace App\Http\Controllers\Backend\Pengaturan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Session;
use Image;
use File;
use Auth;

use App\User;
use App\Role;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::user()->hasPermission('kelola-pengguna') == false) {
            abort(404);
        }
        if ($request->ajax()) {
            $data = User::select(['id', 'name', 'photo', 'username', 'email', 'status'])
                ->with(['roles' => function($q) {
                    $q->first();
                }])
                ->where('status', '!=', 'pending')
                ->orderBy('created_at', 'asc');
            
            if(isset($request->role) && !empty($request->role)) {
                $role = $request->role;
                $data->whereHas('roles', function($q) use ($role) {
                    $q->whereIn('name', $role);
                });
            }

            if(isset($request->status) && !empty($request->status)) {
                $data->whereIn('status', $request->status);
            }

            $data->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('name', function($data){
                    if(!empty($data->photo)) {
                        $photo = asset('storage/photos/'.$data->photo);
                    } else {
                        $photo = asset('assets/img/foto-m.png');
                    }
                    $ret = '<div class="media">
                        <img alt="image" class="mr-3 rounded-circle" width="40" height="40" src="'.$photo.'">
                        <div class="media-body">
                            <div class="media-title">'.$data->name.'</div>
                            <div class="text-job text-muted">'.$data->role->display_name.'</div>
                        </div>
                    </div>';

                    return $ret;
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
                        <a href="'.route('pengguna.edit', $data->id).'"><button type="button" class="btn btn-sm btn-icon icon-left btn-success"><i class="fas fa-pencil-alt"></i> Edit</button></a>
                        <button type="button" id="'.$data->id.'" class="delete btn btn-sm btn-icon icon-left btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                    </div>';
                    
                    return $btn;
                })
                ->rawColumns(['name', 'status', 'action'])
                ->make(true);
        }

        $roles = \App\Role::pluck('display_name','name')->all();

        return view('backend.pengaturan.pengguna.index', ['roles'=>$roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->hasPermission('kelola-pengguna') == false) {
            abort(404);
        }
        $role = Role::pluck('display_name', 'id');
        return view('backend.pengaturan.pengguna.create', compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->hasPermission('kelola-pengguna') == false) {
            abort(404);
        }
        $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',            
            're-password' => 'same:password',
            'role_access' => 'required',
            'status' => 'required',
            'photo' => 'nullable|mimes:jpeg,jpg,png'
        ]);

        $req = $request->except(['role_accesss', 'photo']);
        $req['password'] = bcrypt($req['password']);

        if($request->hasFile('photo')) {
            $path = storage_path('app/public/photos');
   
            if(!File::isDirectory($path)){
                File::makeDirectory($path, 0755, true, true);
            }

            $image = $request->file('photo');
            $images = $req['username'] . '_' . time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path('app/public/photos/' . $images));

            $req['photo'] = $images;
        }

        $data = User::create($req);
        $data->syncRoles([$request->role_access]);
        
        Session::flash("result", [
            'title' => 'Sukses!',
            'type' => 'success',
            "message" => "Data pengguna berhasil ditambahkan."
        ]);
        
        return redirect()->route('pengguna.index');
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
        $role = Role::pluck('display_name', 'id');
        $data = User::findOrFail($id);

        return view('backend.pengaturan.pengguna.edit', compact(['data', 'role']));
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
            'name' => 'required|max:255',
            'username' => 'required|unique:users,username,'.$id,
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|min:6',            
            're-password' => 'same:password',
            'role_access' => 'sometimes|required',
            'status' => 'sometimes|required',
            'photo' => 'nullable|mimes:jpeg,jpg,png'
        ]);

        $password = $request->password;

        if(empty($password)) {
            $req = $request->except(['role_accesss', 'password', 'photo']);
        } else {
            $req = $request->except(['role_accesss', 'photo']);            
            $req['password'] = bcrypt($req['password']);
        }

        $data = User::findOrFail($id);

        if($request->hasFile('photo')) {
            $path = storage_path('app/public/photos');
   
            if(!File::isDirectory($path)){
                File::makeDirectory($path, 0755, true, true);
            }

            if(!empty($data->photo)){
                $path = storage_path('app/public/photos/'.$data->photo);
                
                if(file_exists($path)) {
                    unlink($path);
                }
            }

            $image = $request->file('photo');
            $images = $req['username'] . '_' . time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path('app/public/photos/' . $images));

            $req['photo'] = $images;
        }

        $data->update($req);
        if(Auth::user()->hasRole('super-admin')) {
            $data->syncRoles([$request->role_access]);
        }

        Session::flash("result", [
            'title' => 'Sukses!',
            'type' => 'success',
            "message"   => "Data pengguna berhasil diubah."
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
        if(Auth::user()->hasPermission('kelola-pengguna') == false) {
            abort(404);
        }
        $data = User::findOrFail($id);

        if(!empty($data->photo)){
            $path = storage_path('app/public/photos/'.$data->photo);
            
            if(file_exists($path)) {
                unlink($path);
            }
        }

        $data->destroy($id);

        return response()->json([
            'title' => 'Sukses!',
            'type' => 'success',
            'message'=>'Data pengguna berhasil dihapus!'
        ]);
    }
}
