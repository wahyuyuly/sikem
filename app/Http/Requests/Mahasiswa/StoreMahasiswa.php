<?php

namespace App\Http\Requests\Mahasiswa;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class StoreMahasiswa extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'npm' => 'required|max:255|unique:mahasiswa,npm',
            'nama' => 'required',
            'nama_panggilan' => 'required',
            'nik' => 'numeric|min:16|nullable',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'date|nullable',
            'telp' => 'numeric|digits_between:10,14|nullable',
            'alamat' => 'required',
            'kelurahan_id' => 'required',
            'alamat_tinggal' => 'required',
            'kelurahan_tinggal' => 'required',
            'status_tinggal'=>'required',

            'prodi_id' => 'required',
            'tahun_masuk' => 'numeric|nullable',
            'jalur_penerimaan' => 'required',
            'status' => 'required',
            'tanggal_yudisium' => 'required_if:status,LULUS',

            'email' => 'email|nullable',
            'photo' => 'nullable|mimes:jpeg,jpg,png',
            
            'sd.nama' => 'required',
            'sd.tahun_masuk' => 'required|numeric',
            'sd.tahun_lulus' => 'required|numeric',
            'sd.nilai' => 'nullable|numeric|between:0,100.00',
            'sd.ijazah' => 'mimes:pdf|max:3000',

            'smp.nama' => 'required',
            'smp.tahun_masuk' => 'required|numeric',
            'smp.tahun_lulus' => 'required|numeric',
            'smp.nilai' => 'nullable|numeric|between:0,100.00',
            'smp.ijazah' => 'mimes:pdf|max:3000',

            'sma.sma' => 'required',
            'sma.jurusan' => 'required',
            'sma.nama' => 'required',
            'sma.tahun_masuk' => 'required|numeric',
            'sma.tahun_lulus' => 'required|numeric',
            'sma.nilai' => 'nullable|numeric|between:0,100.00',
            'sma.ijazah' => 'mimes:pdf|max:3000',

            'bapak.nama' => 'required_with:bapak.tanggal_lahir,bapak.pendidikan_id,bapak.nik,bapak.telp,bapak.pekerjaan,bapak.agama,bapak.penghasilan,bapak.alamat,bapak.tempat_lahir',
            'bapak.tanggal_lahir' => 'date|nullable',
            'bapak.agama' => 'required_with_all:bapak.nama',
            'bapak.penghasilan' => 'required_with_all:bapak.nama',
            'bapak.tanggal_lahir' => 'required_with_all:bapak.nama',
            'bapak.tempat_lahir' => 'required_with_all:bapak.nama',
            'bapak.pendidikan_id' => 'required_with_all:bapak.nama',
            'bapak.pekerjaan' => 'required_with_all:bapak.nama',
            'bapak.nik' => 'numeric|min:16|nullable',
            'bapak.telp' => 'numeric|digits_between:10,14|nullable',

            'ibu.nama' => 'required_with:ibu.tanggal_lahir,ibu.pendidikan_id,ibu.nik,ibu.telp,ibu.pekerjaan,ibu.agama,ibu.penghasilan,ibu.alamat,ibu.tempat_lahir',
            'ibu.tanggal_lahir' => 'date|nullable',
            'ibu.agama' => 'required_with_all:ibu.nama',
            'ibu.penghasilan' => 'required_with_all:ibu.nama',
            'ibu.tanggal_lahir' => 'required_with_all:ibu.nama',
            'ibu.tempat_lahir' => 'required_with_all:ibu.nama',
            'ibu.pendidikan_id' => 'required_with_all:ibu.nama',
            'ibu.pekerjaan' => 'required_with_all:ibu.nama',
            'ibu.nik' => 'numeric|min:16|nullable',
            'ibu.telp' => 'numeric|digits_between:10,14|nullable',

            'wali.nama' => 'required_with:wali.tanggal_lahir,wali.pendidikan_id,wali.nik,wali.telp,wali.pekerjaan,wali.agama,wali.penghasilan,wali.alamat,wali.tempat_lahir',
            'wali.tanggal_lahir' => 'date|nullable',
            'wali.agama' => 'required_with_all:wali.nama',
            'wali.penghasilan' => 'required_with_all:wali.nama',
            'wali.tanggal_lahir' => 'required_with_all:wali.nama',
            'wali.tempat_lahir' => 'required_with_all:wali.nama',
            'wali.pendidikan_id' => 'required_with_all:wali.nama',
            'wali.pekerjaan' => 'required_with_all:wali.nama',
            'wali.nik' => 'numeric|min:16|nullable',
            'wali.telp' => 'numeric|digits_between:10,14|nullable',

            'penyakit.*' => 'nullable',
            'tahun_sakit.*' => 'numeric',

            'asuransi' => 'nullable',
            'file_asuransi' => 'mimes:pdf|max:3000',
            'kartu' => 'nullable',
            'file_kartu' => 'mimes:pdf|max:3000'
        ];
    }
}
