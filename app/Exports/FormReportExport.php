<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithProperties;

class FormReportExport implements WithMultipleSheets, WithProperties
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function sheets(): array
    {
        return [
            new \App\Exports\FormInfoSheet($this->data),
            new \App\Exports\RespondenSheet($this->data),
        ];
    }

    public function properties(): array
    {
        return [
            'creator' => 'SIPULAS System',
            'title' => 'Laporan Form - ' . $this->data['form']->nama,
            'subject' => 'Laporan Survei Kepuasan',
            'description' => 'Laporan hasil survei untuk form: ' . $this->data['form']->nama,
            'keywords' => 'survei, kepuasan, laporan, form',
            'category' => 'Laporan Survei',
        ];
    }
}