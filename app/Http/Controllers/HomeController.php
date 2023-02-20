<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (\Auth::user()->hasRole(['super-admin'])) {
            $request_user = \App\User::where('status', 'pending')->count();

            $mahasiswa = \App\User::where('status', 'active')
                ->whereHas('mahasiswa', function($q) {
                    $q->where('status', 'AKTIF');
                })->count();

            $alumni = \App\User::where('status', 'active')
                ->whereHas('mahasiswa', function($q) {
                    $q->where('status', 'LULUS');
                })->count();

            $alumni_chart = \App\User::select('id', 'status')
                ->where('status', 'active')
                ->whereHas('mahasiswa', function($q) {
                    $q->select(['id', 'tahun_masuk']);
                    $q->where('status', 'LULUS');
                })->get();

            $data = [
                'req_user' => $request_user,
                'mahasiswa' => $mahasiswa,
                'alumni' => $alumni
            ];
            //dd($data);
            
            return view('backend.dashboard.admin', with(compact(['data'])));
        } else {
            return view('backend.dashboard.mahasiswa');
        }
    }

    public function chart(Request $request)
    {
        $data = array();
        $filter = $request->filter;
        $status = array_map('trim', explode(',', $request->status));

        if($filter == 'tahun') {
            $chart = \App\Model\Mahasiswa\Mahasiswa::select('tahun_masuk', \DB::raw('count(*) as total'))
                ->whereHas('account',function($account) {
                    $account->where('status', '<>', 'pending');
                })
                ->whereIn('status', $status)
                ->groupBy('tahun_masuk')
                ->get();

            foreach($chart as $item) {
                $data[] = [
                    'name' => 'Tahun '.$item->tahun_masuk,
                    'y' => $item->total
                ];
            }
        } elseif ($filter == 'prodi') {
            $chart = \App\Model\Master\Prodi::select(\DB::raw("prodi.id as id_prodi, concat(tingkat_pendidikan.name, ' - ',prodi.name) as names"))
                ->join('tingkat_pendidikan', 'tingkat_pendidikan.id', '=', 'prodi.tingkat_id')
                ->orderBy('names', 'asc')
                ->whereHas('mahasiswa', function($item) use($status) {
                    $item->whereIn('status', $status);
                })
                ->withCount('mahasiswa')
                ->get();
            
            foreach($chart as $item) {
                $data[] = [
                    'name' => $item->names,
                    'y' => $item->mahasiswa_count
                ];
            }
        } else {
            return abort(404);
        }

        return response()->json($data);
    }
}
