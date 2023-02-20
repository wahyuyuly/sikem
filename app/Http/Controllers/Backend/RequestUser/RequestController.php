<?php

namespace App\Http\Controllers\Backend\RequestUser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\User;
use App\Mail\ActivationUserNotification as ActiveMail;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select(['id', 'name', 'username', 'email', 'status', 'photo'])
                ->with(['roles' => function($q) {
                        $q->first();
                    }, 'mahasiswa'])
                ->where('status', '=', 'pending')
                ->orderBy('created_at', 'asc')
                ->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', function($data) {
                    $check = '<div class="custom-checkbox custom-control">
                        <input name="check[]" value="'.$data->id.'" type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="'.$data->id.'">
                        <label for="'.$data->id.'" class="custom-control-label">&nbsp;</label>
                    </div>';

                    return $check;
                })
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
                            <div class="text-job text-muted">'.$data->mahasiswa->prodi->full_name.'</div>
                        </div>
                    </div>';

                    return $ret;
                })
                ->addColumn('status', function($data){
                    $status = '<div class="dropdown">
                        <a href="#" data-toggle="dropdown" class="btn btn-sm btn-warning dropdown-toggle">PENDING</a>
                        <div class="dropdown-menu">
                            <a id="'.$data->id.'" href="#" class="update dropdown-item has-icon text-success"><i class="far fa-check-circle"></i> AKTIFKAN</a>                        
                        </div>
                    </div>';
                    
                    return $status;
                })
                ->addColumn('action', function($data){
                        $btn = '<div class="btn-group mb-3" role="group" aria-label="Basic example">
                        <a href="'.route('mahasiswa.show', $data->mahasiswa->id).'"><button type="button" class="btn btn-sm btn-icon icon-left btn-primary"><i class="fas fa-eye"></i> Detail</button></a>
                        <button type="button" id="'.$data->id.'" class="delete btn btn-sm btn-icon icon-left btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                    </div>';
                    
                    return $btn;
                })
                ->rawColumns(['checkbox', 'name', 'status', 'action'])
                ->make(true);
        }

        return view('backend.request-user.index');
    }

    public function update(Request $request, $id)
    {
        $data = User::findOrFail($id);
        $data->status = 'active';
        $data->save();

        $details = [
            'name' => $data->name,
            'username' => $data->username,
            'email' => $data->email,
            'password' => '********',
            'message' => '',
            'url' => route('login')
        ];
        dispatch(new \App\Jobs\SendEmail($details));

        return response()->json([
            'title' => 'Sukses!',
            'type' => 'success',
            "message" => "Pengguna berhasil diaktifkan."
        ]);
    }

    public function batchupdate(Request $request)
    {        
        try {
            foreach ($request->id as $id) {
                $data = User::findOrFail($id);
                $data->status = 'active';
                $data->save();

                $details = [
                    'name' => $data->name,
                    'username' => $data->username,
                    'email' => $data->email,
                    'password' => '********',
                    'message' => '',
                    'url' => route('login')
                ];
                dispatch(new \App\Jobs\SendEmail($details));
            }

            return response()->json([
                'title' => 'Sukses!',
                'type' => 'success',
                "message" => "Pengguna berhasil diaktifkan."
            ]);
        } catch (\Exception $e) {
            return $e;
        }        
    }

    public function destroy($id)
    {
        try {
            $data = User::findOrFail($id);
            $data->mahasiswa()->forceDelete();
            $data->forceDelete();

            return response()->json([
                'title' => 'Sukses!',
                'type' => 'success',
                "message" => "Data berhasil dihapus."
            ]);
        } catch (\Exception $e) {
            return $e;
        }
    }
}
