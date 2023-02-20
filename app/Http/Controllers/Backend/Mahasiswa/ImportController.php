<?php

namespace App\Http\Controllers\Backend\Mahasiswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Excel;
use DB;
use App\Imports\MahasiswaImport;
use Carbon\Carbon;
use App\Model\Mahasiswa\Mahasiswa;
use App\User;
use Hash;
use Session;

class ImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.mahasiswa.import');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $import = (new MahasiswaImport)->toCollection(request()->file('file'));
        
        try {
            // Begin Transaction
            DB::beginTransaction();
            
            foreach ($import[0] as $value) {
                $data = [
                    'npm' => str_replace(' ', '', $value['nim']),
                    'nama' => $value['nama'],
                    'status' => $value['status'],
                    'tahun_masuk' => $value['tahun_masuk'],
                    'jenis_kelamin' => $value['jenis_kelamin'],
                    'tempat_lahir' => $value['tempat_lahir'],
                    'tanggal_lahir' => $value['tanggal_lahir'] != null ? Carbon::createFromFormat('d/m/Y', $value['tanggal_lahir'])->format('Y-m-d') : null
                ];

                $mahasiswa = Mahasiswa::create($data);
                $user = User::create([
                    'username' => $mahasiswa->npm,
                    'email' => $mahasiswa->npm.'@poltekkes-tjk.ac.id',
                    'name' => $mahasiswa->nama,
                    'status' => 'active',
                    'password' => Hash::make($mahasiswa->npm)
                ]);
                $user->syncRoles(['mahasiswa']);
                $mahasiswa->account_id = $user->id;
                $mahasiswa->save();
            }

            // Commit Transaction
            DB::commit();
            $title = 'Sukses!';
            $type = 'success';
            $message = 'Data berhasil di-import.';
        } catch (\Exception $e) {
            // Rollback Transaction
            DB::rollBack();
            $title = 'Gagal!';
            $type = 'danger';
            $message = $e->getMessage();
        }

        Session::flash("result", [
            'title' => $title,
            'type' => $type,
            "message"   => $message
        ]);
        
        return redirect()->back();
    }
}
