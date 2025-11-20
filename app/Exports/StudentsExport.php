<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentsExport implements FromCollection, WithHeadings
{
    protected $students;

    public function __construct($students)
    {
        $this->students = $students;
    }

    public function collection()
    {
        return $this->students->map(function ($s) {
            return [
                'NIS'         => $s->nis,
                'Name'        => $s->nama,
                'Email'       => $s->email,
                'Institution' => $s->lembaga->nama ?? '-',
                'Status'      => $s->status == 0 ? 'Active' : 'Inactive',
                'Created At'  => $s->created_at
                                    ? $s->created_at->format('d-m-Y H:i')
                                    : '-',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'NIS',
            'Name',
            'Email',
            'Institution',
            'Status',
            'Created At',
        ];
    }
}
