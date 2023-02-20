<?php

namespace App\Http\Controllers\Backend\File;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Download extends Controller
{
    /**
     * Return the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index($file)
    {
        $myFile = storage_path('app/attachments/permohonan/legalisir/'.$file);
    	$headers = ['Content-Type: application/pdf'];

    	return response()->file($myFile, $headers);
    }

    /**
     * Return the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function fileMahasiswa($file)
    {
        $data = \App\Model\Mahasiswa\FileMahasiswa::findOrFail($file);
        if(\Auth::user()->hasRole('mahasiswa')) {
            if(\Auth::user()->mahasiswa->id != $data->mahasiswa_id) {
                return abort(404);
            }
        } else if (!\Auth::user()->hasRole(['super-admin', 'admin-jurusan'])){
            return abort(404);
        }

        $myFile = storage_path('app/attachments/mahasiswa/'.$data->mahasiswa->id.'/'.$data->file);

    	return response()->download($myFile);
    }

    /**
     * Return the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function attachment($file)
    {
        $myFile = storage_path('app/attachments/mahasiswa/'.base64_decode($file));

    	if(!empty($myFile)){
            if(file_exists($myFile)) {
                return response()->download($myFile);
            }
        }

        return abort(404);
    }

    /**
     * Return the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function filePublic($loc, $file)
    {
        $myFile = storage_path('app/attachments/'.$loc.'/'.$file);
        if(!empty($myFile)){
            if(file_exists($myFile)) {
                return response()->download($myFile);
            }
        }
        return abort(404);	
    }
}
