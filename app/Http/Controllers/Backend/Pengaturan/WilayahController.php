<?php

namespace App\Http\Controllers\Backend\Pengaturan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Master\Wilayah\Provinsi;
use App\Model\Master\Wilayah\Kota;
use App\Model\Master\Wilayah\Kecamatan;
use App\Model\Master\Wilayah\Kelurahan;

class WilayahController extends Controller
{
    public function index(Request $request)
    {
        $data = '';
        if($request->has('type') && $request->type == 'provinsi')
        {
            $prov = Provinsi::select('id', 'name');
            if($request->has('search'))
            {
                $prov->where('name', 'like', "%$request->search%");
            }
            $data = $prov->get();
        }

        if($request->has('type') && $request->type == 'kota')
        {
            $q = Kota::select('id', 'name')->where('provinsi_id', '=', $request->data);
            if($request->has('search'))
            {
                $q->where('name', 'like', "%$request->search%");
            }
            $data = $q->get();
        }

        if($request->has('type') && $request->type == 'kecamatan')
        {
            $q = Kecamatan::select('id', 'name')->where('kota_id', '=', $request->data);
            if($request->has('search'))
            {
                $q->where('name', 'like', "%$request->search%");
            }
            $data = $q->get();
        }

        if($request->has('type') && $request->type == 'kelurahan')
        {
            $q = Kelurahan::select('id', 'name')->where('kecamatan_id', '=', $request->data);
            if($request->has('search'))
            {
                $q->where('name', 'like', "%$request->search%");
            }
            $data = $q->get();
        }

        return response()->json($data);
    }
}
