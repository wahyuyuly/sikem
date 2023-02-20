<?php

use Illuminate\Database\Seeder;
use App\Model\Master\TingkatPendidikan as Tingkat;
use App\Model\Master\Jurusan;
use App\Model\Master\Prodi;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tingkat = ['TK', 'SD / SEDERAJAT', 'SMP / SEDERAJAT', 'SMA / SEDERAJAT', 'D1', 'D2', 'S1', 'S2', 'S3', 'LAINNYA', 'TIDAK SEKOLAH'];

        for ($i=0; $i < 9 ; $i++) { 
            Tingkat::create(['name' => $tingkat[$i]]);
        }

        $d3 = Tingkat::create([
            'name' => 'D3',
            'description' => 'DIPLOMA 3'
        ]);

        $d4 = Tingkat::create([
            'name' => 'D4',
            'description' => 'DIPLOMA 4'
        ]);

        $profesi = Tingkat::create([
            'name' => 'PROFESI',
            'description' => 'PROFESI'
        ]);

        // $lain = Tingkat::create([
        //     'name' => 'LAINNYA',
        //     'description' => 'LAINNYA'
        // ]);
        
        $jurusan = ['Keperawatan', 'Kebidanan', 'Farmasi', 'Kesahatan Lingkungan', 'Gizi', 'Teknologi Laboratorium Medis', 'Kesehatan Gigi', 'Teknik'];
        $jurusan = array (
            0 => 
            array (
              'tingkat' => 'D3',
              'jurusan' => 'Analisis Kesehatan',
            ),
            1 => 
            array (
              'tingkat' => 'D3',
              'jurusan' => 'Farmasi',
            ),
            2 => 
            array (
              'tingkat' => 'D3',
              'jurusan' => 'Gizi',
            ),
            3 => 
            array (
              'tingkat' => 'D3',
              'jurusan' => 'Kebidanan',
            ),
            4 => 
            array (
              'tingkat' => 'D3',
              'jurusan' => 'Kebidanan (Kampus Metro)',
            ),
            5 => 
            array (
              'tingkat' => 'D3',
              'jurusan' => 'Keperawatan',
            ),
            6 => 
            array (
              'tingkat' => 'D3',
              'jurusan' => 'Keperawatan (Kampus Kota Bumi)',
            ),
            7 => 
            array (
              'tingkat' => 'D3',
              'jurusan' => 'Keperawatan Gigi',
            ),
            8 => 
            array (
              'tingkat' => 'D3',
              'jurusan' => 'Kesehatan Lingkungan',
            ),
            9 => 
            array (
              'tingkat' => 'D3',
              'jurusan' => 'Teknik Gigi',
            ),
            10 => 
            array (
              'tingkat' => 'D4',
              'jurusan' => 'Analisis Kesehatan',
            ),
            11 => 
            array (
              'tingkat' => 'D4',
              'jurusan' => 'Kebidanan',
            ),
            12 => 
            array (
              'tingkat' => 'D4',
              'jurusan' => 'Kebidanan (Kampus Metro)',
            ),
            13 => 
            array (
              'tingkat' => 'D4',
              'jurusan' => 'Keperawatan',
            ),
            14 => 
            array (
              'tingkat' => 'D4',
              'jurusan' => 'Kesehatan Lingkungan',
            ),
            15 => 
            array (
              'tingkat' => 'PROFESI',
              'jurusan' => 'Profesi Ners',
            ),
            16 => 
            array (
              'tingkat' => 'PROFESI',
              'jurusan' => 'Profesi Pendidikan Profesi Ners',
            ),
        );

        foreach ($jurusan as $data) {
            
        }
        
        // for ($i=0; $i < 8 ; $i++) { 
        //     $jur = Jurusan::create([
        //         'name' => $jurusan[$i]
        //     ]);

        //     Prodi::create([
        //         'jurusan_id' => $jur->id,
        //         'tingkat_id' => $d3->id,
        //         'name' => $d3->name.' - '.$jur->name
        //     ]);
        // }
    }
}
