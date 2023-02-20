<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MahasiswaExport implements WithMultipleSheets
{
    use Exportable;

    public function __construct(Array $req)
    {
        $this->req = $req;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];
        
        $sheets[] = new \App\Exports\Sheets\MahasiswaSheet($this->req);
        $sheets[] = new \App\Exports\Sheets\OrangTuaSheet($this->req);

        return $sheets;
    }
}
