<?php

namespace App\Http\Controllers\Backend\Mahasiswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
//use File;
use DataTables;
use Carbon\Carbon;

use App\Model\Mahasiswa\Mahasiswa;
use App\Model\Mahasiswa\OrangTua;
use App\Http\Requests\Mahasiswa\StoreMahasiswa;
use App\Http\Requests\Mahasiswa\UpdateMahasiswa;

class MahasiwaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(\Auth::user()->hasPermission('kelola-mahasiswa') == false) {
            abort(404);
        }
        if ($request->ajax()) {
            $data = Mahasiswa::select(['id', 'nama', 'npm', 'prodi_id', 'jenis_kelamin', 'tahun_masuk', 'account_id'])
                ->whereHas('account',function($account) {
                    $account->where('status', '<>', 'pending');
                })
                ->orderBy('created_at', 'asc')
                ->where('status', 'AKTIF');
            
                if(isset($request->prodi_id) && !empty($request->prodi_id)) {
                    $data->whereIn('prodi_id', $request->prodi_id);
                }
    
                if(isset($request->tahun_start) && !empty($request->tahun_start)) {
                    $data->where('tahun_masuk', '>=', $request->tahun_start);
                }
    
                if(isset($request->tahun_end) && !empty($request->tahun_end)) {
                    $data->where('tahun_masuk', '<=', $request->tahun_end);
                }
    
                if(isset($request->jenis_kelamin) && !empty($request->jenis_kelamin)) {
                    $data->whereIn('jenis_kelamin', $request->jenis_kelamin);
                }
    
                $data->get();;
                
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('nama', function($data){
                    if(!empty($data->account->photo)) {
                        $path = public_path('storage/photos/'.$data->account->photo);
                        
                        if(file_exists($path)) {
                            $photo = asset('storage/photos/'.$data->account->photo);
                        } else {
                            $photo = asset('assets/img/foto-m.png');
                        }
                        
                    } else {
                        $photo = asset('assets/img/foto-m.png');
                    }
                    $prodi = '-';
                    if($data->prodi()->count() > 0) {
                        $prodi = $data->prodi->name;
                    }
                    $ret = '<a href="'.route('mahasiswa.show', $data->id).'"><div class="media">
                        <img alt="image" class="mr-3 rounded-circle" width="40" height="40" src="'.$photo.'">
                        <div class="media-body">
                        <div class="media-title">'.$data->nama.'</div>
                            <div class="text-job text-muted">'.$data->prodi->tingkat->name.' - '.$prodi.'</div>
                        </div>
                    </div></a>';

                    return $ret;
                })
                ->addColumn('action', function($data) {
                        $btn = '<div class="btn-group mb-3" role="group">
                        <a href="'.route('mahasiswa.edit', $data->id).'"><button type="button" class="btn btn-sm btn-icon icon-left btn-success"><i class="fas fa-pencil-alt"></i> Edit</button></a>
                        <button type="button" id="'.$data->id.'" class="delete btn btn-sm btn-icon icon-left btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                    </div>';
                    
                    return $btn;
                })
                ->rawColumns(['nama', 'action'])
                ->make(true);
        }

        $prodi =  \App\Model\Master\Prodi::select(\DB::raw("prodi.id as id_prodi, concat(tingkat_pendidikan.name, ' - ',prodi.name) as names"))
        ->join('tingkat_pendidikan', 'tingkat_pendidikan.id', '=', 'prodi.tingkat_id')
        ->orderBy('names', 'asc')
        ->pluck('names', 'id_prodi')->all();

        return view('backend.mahasiswa.index', ['root'=>'mahasiswa', 'sub'=>'index', 'prodi'=>$prodi]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(\Auth::user()->hasPermission('kelola-mahasiswa') == false) {
            abort(404);
        }
        $pendidikan = \App\Model\Master\TingkatPendidikan::orderBy('name', 'asc')->pluck('name', 'id')->all();
        $prodi =  \App\Model\Master\Prodi::select(\DB::raw("prodi.id as id_prodi, concat(tingkat_pendidikan.name, ' - ',prodi.name) as names"))
            ->join('tingkat_pendidikan', 'tingkat_pendidikan.id', '=', 'prodi.tingkat_id')
            ->orderBy('names', 'asc')
            ->pluck('names', 'id_prodi')->all();
        $ukm = \App\Model\Master\UKM::orderBy('name', 'asc')->pluck('name', 'id')->all();

        return view('backend.mahasiswa.create', ['root'=>'mahasiswa', 'sub'=>'add', 'pendidikan'=>$pendidikan, 'prodi'=>$prodi, 'ukm'=>$ukm]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMahasiswa $request)
    {
        if(\Auth::user()->hasPermission('kelola-mahasiswa') == false) {
            abort(404);
        }

        $req = $request->all();
        $req['tanggal_lahir'] = Carbon::parse($req['tanggal_lahir'])->format('Y-m-d');
        if(isset($req['tanggal_yudisium'])) {
            $req['tanggal_yudisium'] = Carbon::parse($req['tanggal_yudisium'])->format('Y-m-d');
        }

        $mahasiswa = Mahasiswa::create($req);

        $user = new \App\User();
        $user->name = $mahasiswa->nama;
        $user->username = $mahasiswa->npm;
        $user->email = $request->email;
        $user->status = 'active';
        $user->password = !empty($request->password) ? Hash::make($request->password) : Hash::make($mahasiswa->npm);
        if($request->hasFile('photo')) {
            $path = storage_path('app/public/photos');
   
            if(!\File::isDirectory($path)){
                \File::makeDirectory($path, 0755, true, true);
            }

            $image = $request->file('photo');
            $images = $user->username . '_' . time() . '.' . $image->getClientOriginalExtension();
            \Image::make($image)->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path('app/public/photos/' . $images));

            $user->photo = $images;
        }
        $user->save();
        $user->syncRoles(['mahasiswa']);
        $mahasiswa->account_id = $user->id;
        $mahasiswa->save();

        $sd = $request->sd;
        if(!empty($sd['nama'])) {
            $sdSave = new \App\Model\Mahasiswa\RiwayatSekolah();
            $sdSave->mahasiswa_id = $mahasiswa->id;
            $sdSave->tingkat = 'SD';
            $sdSave->nama = $sd['nama'];
            $sdSave->tahun_masuk = $sd['tahun_masuk'];
            $sdSave->tahun_lulus = $sd['tahun_lulus'];
            $sdSave->nilai = $sd['nilai'];
            $sdSave->save();

            if($request->hasFile('sd.ijazah')) {
                $path = storage_path('app/attachments/mahasiswa/'.$mahasiswa->id.'/ijazah/');
       
                if(!\File::isDirectory($path)) {
                    \File::makeDirectory($path, 0755, true, true);
                }
    
                $file = $request->file('sd.ijazah');
                $files = md5(time().'-'.rand()) . '.' . $file->getClientOriginalExtension();
                $file->move($path, $files);
                
                $sdSave->ijazah = $files;
                $sdSave->save();
            }
        }

        $smp = $request->smp;
        if(!empty($smp['nama'])) {
            $smpSave = new \App\Model\Mahasiswa\RiwayatSekolah();
            $smpSave->mahasiswa_id = $mahasiswa->id;
            $smpSave->tingkat = 'SMP';
            $smpSave->nama = $smp['nama'];
            $smpSave->tahun_masuk = $smp['tahun_masuk'];
            $smpSave->tahun_lulus = $smp['tahun_lulus'];
            $smpSave->nilai = $smp['nilai'];
            $smpSave->save();

            if($request->hasFile('smp.ijazah')) {
                $path = storage_path('app/attachments/mahasiswa/'.$mahasiswa->id.'/ijazah/');
       
                if(!\File::isDirectory($path)) {
                    \File::makeDirectory($path, 0755, true, true);
                }
    
                $file = $request->file('smp.ijazah');
                $files = md5(time().'-'.rand()) . '.' . $file->getClientOriginalExtension();
                $file->move($path, $files);
                
                $smpSave->ijazah = $files;
                $smpSave->save();
            }
        }

        $sma = $request->sma;
        if(!empty($sma['nama'])) {
            $smaSave = new \App\Model\Mahasiswa\RiwayatSekolah();
            $smaSave->mahasiswa_id = $mahasiswa->id;
            $smaSave->tingkat = 'SMA';
            $smaSave->sma = $sma['sma'];
            $smaSave->jurusan = $sma['jurusan'];
            $smaSave->nama = $sma['nama'];
            $smaSave->tahun_masuk = $sma['tahun_masuk'];
            $smaSave->tahun_lulus = $sma['tahun_lulus'];
            $smaSave->nilai = $sma['nilai'];
            $smaSave->save();

            if($request->hasFile('sma.ijazah')) {
                $path = storage_path('app/attachments/mahasiswa/'.$mahasiswa->id.'/ijazah/');
       
                if(!\File::isDirectory($path)) {
                    \File::makeDirectory($path, 0755, true, true);
                }
    
                $file = $request->file('sma.ijazah');
                $files = md5(time().'-'.rand()) . '.' . $file->getClientOriginalExtension();
                $file->move($path, $files);
                
                $smaSave->ijazah = $files;
                $smaSave->save();
            }
        }

        $bapak = $request->bapak;
        if(!empty($bapak['nama'])) {
            $bapak['tanggal_lahir'] = Carbon::parse($bapak['tanggal_lahir'])->format('Y-m-d');
            $bapak['mahasiswa_id'] = $mahasiswa->id;
            $bapakSave = OrangTua::create($bapak);
        }

        $ibu = $request->ibu;
        if(!empty($ibu['nama'])) {
            $ibu['tanggal_lahir'] = Carbon::parse($ibu['tanggal_lahir'])->format('Y-m-d');
            $ibu['mahasiswa_id'] = $mahasiswa->id;        
            $ibuSave = OrangTua::create($ibu);
        }

        $wali = $request->wali;
        if(!empty($wali['nama'])) {
            $wali['tanggal_lahir'] = Carbon::parse($wali['tanggal_lahir'])->format('Y-m-d');
            $wali['mahasiswa_id'] = $mahasiswa->id;
            $waliSave = OrangTua::create($wali);
        }

        $minat = \App\Model\Mahasiswa\MinatBakat::create([
            'mahasiswa_id' => $mahasiswa->id,
            'minat_ukm' => isset($request->minat_ukm) ? implode(',', $request->minat_ukm) : null,
            'exchange' => $request->exchange,
            'overseas' => $request->overseas
        ]);

        if(isset($req['penyakit']) && $req['penyakit'] != null && !empty($req['penyakit'])) {
            foreach ($req['penyakit'] as $key => $value) {
                $val = [
                    'mahasiswa_id' => $mahasiswa->id,
                    'nama' => $value,
                    'tahun' => $req['tahun_sakit'][$key]
                ];
                $penyakit = \App\Model\Mahasiswa\Penyakit::create($val);
            }
        }

        if(isset($req['asuransi']) && $req['asuransi'] != null) {
            $val = [
                'mahasiswa_id' => $mahasiswa->id,
                'nama' => $req['asuransi']
            ];
            $asuransi = \App\Model\Mahasiswa\Asuransi::create($val);
            if($request->hasFile('file_asuransi')) {
                $path = storage_path('app/attachments/mahasiswa/'.$mahasiswa->id.'/asuransi/');
        
                if(!\File::isDirectory($path)) {
                    \File::makeDirectory($path, 0755, true, true);
                }
    
                $file = $request->file('file_asuransi');
                $files = md5(time().'-'.rand()) . '.' . $file->getClientOriginalExtension();
                $file->move($path, $files);
                
                $asuransi->file = $files;
                $asuransi->save();
            }
        }

        if(isset($req['kartu']) && $req['kartu'] != null) {
            $val = [
                'mahasiswa_id' => $mahasiswa->id,
                'nama' => $req['kartu']
            ];
            $kartu = \App\Model\Mahasiswa\Kartu::create($val);
            if($request->hasFile('file_kartu')) {
                $path = storage_path('app/attachments/mahasiswa/'.$mahasiswa->id.'/kartu/');
        
                if(!\File::isDirectory($path)) {
                    \File::makeDirectory($path, 0755, true, true);
                }
    
                $file = $request->file('file_kartu');
                $files = md5(time().'-'.rand()) . '.' . $file->getClientOriginalExtension();
                $file->move($path, $files);
                
                $kartu->file = $files;
                $kartu->save();
            }
        }
        
        $mailData = [
            'name' => $user->name,
            'username' => $user->username,
            'email' => $user->email,
            'password' => $user->username,
            'message' => '',
            'url' => route('login')
        ];
        Mail::to($request->email)->send(new \App\Mail\NewUserNotification($mailData));

        \Session::flash("result", [
            'title' => 'Sukses!',
            'type' => 'success',
            "message"   => "Data mahasiswa berhasil ditambahkan."
        ]);
        
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Mahasiswa::with(['files' => function($q) {
            $q->orderBy('created_at', 'asc');
        }])->findOrFail($id);

        return view('backend.mahasiswa.show', compact(['data']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Mahasiswa::findOrFail($id);

        //$provinsi = \App\Model\Master::
        $pendidikan = \App\Model\Master\TingkatPendidikan::orderBy('name', 'asc')->pluck('name', 'id')->all();
        $prodi =  \App\Model\Master\Prodi::select(\DB::raw("prodi.id as id_prodi, concat(tingkat_pendidikan.name, ' - ',prodi.name) as names"))
            ->join('tingkat_pendidikan', 'tingkat_pendidikan.id', '=', 'prodi.tingkat_id')
            ->orderBy('names', 'asc')
            ->pluck('names', 'id_prodi')->all();
        $ukm = \App\Model\Master\UKM::orderBy('name', 'asc')->pluck('name', 'id')->all();

        return view('backend.mahasiswa.edit', ['root'=>'mahasiswa', 'data'=>$data, 'pendidikan'=>$pendidikan, 'prodi'=>$prodi, 'ukm'=>$ukm]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMahasiswa $request, $id)
    {
        //dd($request->minat_ukm);
        $req = $request->all();
        $req['tanggal_lahir'] = Carbon::parse($req['tanggal_lahir'])->format('Y-m-d');
        if(isset($req['tanggal_yudisium'])) {
            $req['tanggal_yudisium'] = Carbon::parse($req['tanggal_yudisium'])->format('Y-m-d');
        }
        
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->update($req);
        $mahasiswa->orangtua()->delete();

        $sd = $request->sd;
        if(!empty($sd['nama'])) {
            $sdSave = \App\Model\Mahasiswa\RiwayatSekolah::firstOrCreate([
                'mahasiswa_id'=>$mahasiswa->id,
                'tingkat'=>'SD'
            ]);
            $sdSave->update($sd);

            if($request->hasFile('sd.ijazah')) {
                $path = storage_path('app/attachments/mahasiswa/'.$mahasiswa->id.'/ijazah/');
       
                if(!\File::isDirectory($path)) {
                    \File::makeDirectory($path, 0755, true, true);
                }

                if(file_exists($path.$sdSave->ijazah)) {
                    unlink($path.$sdSave->ijazah);
                }
    
                $file = $request->file('sd.ijazah');
                $files = md5(time().'-'.rand()) . '.' . $file->getClientOriginalExtension();
                $file->move($path, $files);
                
                $sdSave->ijazah = $files;
                $sdSave->save();
            }
        }

        $smp = $request->smp;
        if(!empty($smp['nama'])) {
            $smpSave = \App\Model\Mahasiswa\RiwayatSekolah::firstOrCreate([
                'mahasiswa_id'=>$mahasiswa->id,
                'tingkat'=>'SMP'
            ]);
            $smpSave->update($smp);

            if($request->hasFile('smp.ijazah')) {
                $path = storage_path('app/attachments/mahasiswa/'.$mahasiswa->id.'/ijazah/');
       
                if(!\File::isDirectory($path)) {
                    \File::makeDirectory($path, 0755, true, true);
                }

                if(file_exists($path.$smpSave->ijazah)) {
                    unlink($path.$smpSave->ijazah);
                }
    
                $file = $request->file('smp.ijazah');
                $files = md5(time().'-'.rand()) . '.' . $file->getClientOriginalExtension();
                $file->move($path, $files);
                
                $smpSave->ijazah = $files;
                $smpSave->save();
            }
        }

        $sma = $request->sma;
        if(!empty($sma['nama'])) {
            $smaSave = \App\Model\Mahasiswa\RiwayatSekolah::firstOrCreate([
                'mahasiswa_id'=>$mahasiswa->id,
                'tingkat'=>'SMA'
            ]);
            $smaSave->update($sma);

            if($request->hasFile('sma.ijazah')) {
                $path = storage_path('app/attachments/mahasiswa/'.$mahasiswa->id.'/ijazah/');
       
                if(!\File::isDirectory($path)) {
                    \File::makeDirectory($path, 0755, true, true);
                }

                if(file_exists($path.$smaSave->ijazah)) {
                    unlink($path.$smaSave->ijazah);
                }
    
                $file = $request->file('sma.ijazah');
                $files = md5(time().'-'.rand()) . '.' . $file->getClientOriginalExtension();
                $file->move($path, $files);
                
                $smaSave->ijazah = $files;
                $smaSave->save();
            }
        }

        $bapak = $request->bapak;
        if(!empty($bapak['nama'])) {
            $bapak['tanggal_lahir'] = Carbon::parse($bapak['tanggal_lahir'])->format('Y-m-d');
            $bapak['mahasiswa_id'] = $mahasiswa->id;
            $bapakSave = OrangTua::create($bapak);
        }

        $ibu = $request->ibu;
        if(!empty($ibu['nama'])) {
            $ibu['tanggal_lahir'] = Carbon::parse($ibu['tanggal_lahir'])->format('Y-m-d');
            $ibu['mahasiswa_id'] = $mahasiswa->id;        
            $ibuSave = OrangTua::create($ibu);
        }

        if(isset($req['penyakit']) && $req['penyakit'] != null) {
            if(!empty($mahasiswa->penyakit())) {
                $mahasiswa->penyakit()->delete();
            }
            foreach ($req['penyakit'] as $key => $value) {
                $val = [
                    'mahasiswa_id' => $mahasiswa->id,
                    'nama' => $value,
                    'tahun' => $req['tahun_sakit'][$key]
                ];
                $penyakit = \App\Model\Mahasiswa\Penyakit::create($val);
            }
        }

        $minat = \App\Model\Mahasiswa\MinatBakat::updateOrCreate([
            'mahasiswa_id' => $mahasiswa->id
        ], [
            'minat_ukm' => isset($request->minat_ukm) ? implode(',', $request->minat_ukm) : null,
            'exchange' => $request->exchange,
            'overseas' => $request->overseas
        ]);

        if(isset($req['asuransi']) && $req['asuransi'] != null) {
            $asuransi = \App\Model\Mahasiswa\Asuransi::firstOrCreate([
                'mahasiswa_id' => $mahasiswa->id
            ], [
                'nama' => $req['asuransi']
            ]);
            $asuransi->update([
                'nama' => $req['asuransi']
            ]);

            if($request->hasFile('file_asuransi')) {
                $path = storage_path('app/attachments/mahasiswa/'.$mahasiswa->id.'/asuransi/');
        
                if(!\File::isDirectory($path)) {
                    \File::makeDirectory($path, 0755, true, true);
                }

                if($asuransi->file != null && !empty($asuransi->file)) {
                    if(file_exists($path.$asuransi->file)) {
                        unlink($path.$asuransi->file);
                    }
                }
    
                $file = $request->file('file_asuransi');
                $files = md5(time().'-'.rand()) . '.' . $file->getClientOriginalExtension();
                $file->move($path, $files);
                
                $asuransi->file = $files;
                $asuransi->save();
            }
        }

        if(isset($req['kartu']) && $req['kartu'] != null) {
            $kartu = \App\Model\Mahasiswa\Kartu::firstOrCreate([
                'mahasiswa_id' => $mahasiswa->id
            ], [
                'nama' => $req['kartu']
            ]);
            $kartu->update([
                'nama' => $req['kartu']
            ]);

            if($request->hasFile('file_kartu')) {
                $path = storage_path('app/attachments/mahasiswa/'.$mahasiswa->id.'/kartu/');
        
                if(!\File::isDirectory($path)) {
                    \File::makeDirectory($path, 0755, true, true);
                }

                if($kartu->file != null && !empty($kartu->file)) {
                    if(file_exists($path.$kartu->file)) {
                        unlink($path.$kartu->file);
                    }
                }
    
                $file = $request->file('file_kartu');
                $files = md5(time().'-'.rand()) . '.' . $file->getClientOriginalExtension();
                $file->move($path, $files);
                
                $kartu->file = $files;
                $kartu->save();
            }
        }

        \Session::flash("result", [
            'title' => 'Sukses!',
            'type' => 'success',
            "message"   => "Data mahasiswa berhasil diubah."
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
        if(\Auth::user()->hasPermission('kelola-mahasiswa') == false) {
            abort(404);
        }
        $data = Mahasiswa::findOrFail($id);
        $data->orangtua()->delete();

        if(!empty($data->account->photo)){
            $path = storage_path('app/public/photos/'.$data->account->photo);
            
            if(file_exists($path)) {
                unlink($path);
            }
        }
        $data->account()->delete();
        $data->destroy($id);

        return response()->json([
            'title' => 'Sukses!',
            'type' => 'success',
            'message'=>'Data mahasiswa berhasil dihapus!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function mahasiswaList(Request $request)
    {
        $data = Mahasiswa::select('id', 'nama', 'npm', 'account_id', 'prodi_id')->with(['account:id,photo', 'prodi:id,name']);
        if($request->has('search'))
        {
            $data->where('nama', 'like', "%$request->search%");
            $data->orWhere('npm', 'like', "%$request->search%");
        }
        $result = $data->get();

        return response()->json($result);
    }
}
