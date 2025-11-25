<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Illuminate\Contracts\View\View;

class RespondenSheet implements FromView, WithTitle
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('Admin.Form.export.excel-responden', [
            'form' => $this->data['form'],
            'respondens' => $this->data['respondens'],
            'sections' => $this->data['sections'],
            'questionStats' => $this->data['questionStats'],
            'identitasConfig' => $this->data['identitasConfig'],
        ]);
    }

    public function title(): string
    {
        return 'Data Responden';
    }
}