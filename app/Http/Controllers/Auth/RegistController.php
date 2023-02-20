<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\User;
use App\Model\Mahasiswa\Mahasiswa;
use App\Model\Mahasiswa\OrangTua;
use App\Http\Requests\Mahasiswa\StoreMahasiswa;
use App\Mail\NewUserNotification;
use Image;
use File;

class RegistController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pendidikan = \App\Model\Master\TingkatPendidikan::orderBy('name', 'asc')->pluck('name', 'id')->all();
        $prodi =  \App\Model\Master\Prodi::select(\DB::raw("prodi.id as id_prodi, concat(tingkat_pendidikan.name, ' - ',prodi.name) as names"))
            ->join('tingkat_pendidikan', 'tingkat_pendidikan.id', '=', 'prodi.tingkat_id')
            ->orderBy('names', 'asc')
            ->pluck('names', 'id_prodi')->all();
        $ukm = \App\Model\Master\UKM::orderBy('name', 'asc')->pluck('name', 'id')->all();

        return view('auth.register', compact(['pendidikan', 'prodi', 'ukm']));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(StoreMahasiswa $request)
    {
        try {
            // Begin Transaction
            \DB::beginTransaction();

            //dd($request->all());
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
            $user->status = 'pending';
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

            if(isset($req['penyakit']) && $req['penyakit'] != null) {
                foreach ($req['penyakit'] as $key => $value) {
                    $val = [
                        'mahasiswa_id' => $mahasiswa->id,
                        'nama' => $value,
                        'tahun' => $req['tahun_sakit'][$key]
                    ];
                    $penyakit = \App\Model\Mahasiswa\Penyakit::create($val);
                }
            }
            
            $mailData = [
                'name' => $user->name,
                'username' => $user->username,
                'email' => $user->email,
                'password' => $request->password,
                'message' => '',
                'url' => route('login')
            ];
            Mail::to($request->email)->send(new \App\Mail\NewUserNotification($mailData));

             // Commit Transaction
            \DB::commit();
            
            return view('auth.regist-success');
        } catch (\Exception $e) {
            // Rollback Transaction
            \DB::rollBack();
            return $e;
        }        
        
        return abort(404);
    }
}
