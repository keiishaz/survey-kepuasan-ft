<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Illuminate\Contracts\View\View;

class FormInfoSheet implements FromView, WithTitle
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('Admin.Form.export.excel-form-info', [
            'form' => $this->data['form'],
            'sections' => $this->data['sections'],
            'questionStats' => $this->data['questionStats'],
            'respondens' => $this->data['respondens'],
            'totalResponden' => $this->data['totalResponden'],
            'totalQuestions' => $this->data['totalQuestions'],
            'identitasConfig' => $this->data['identitasConfig'],
        ]);
    }

    public function title(): string
    {
        return 'Info Form';
    }
}