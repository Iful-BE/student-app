<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class StudentController extends Controller
{
    public function datatable(Request $r)
    {
        $q = Student::with('lembaga');

        if ($r->search) {
            $q->where(function ($s) use ($r) {
                $s->where('nis', 'like', "%{$r->search}%")
                  ->orWhere('nama', 'like', "%{$r->search}%");
            });
        }

        if ($r->lembaga) {
            $q->where('lembaga_id', $r->lembaga);
        }

        return DataTables::of($q)
            ->editColumn('lembaga', fn($row) => $row->lembaga->nama)
            ->make(true);
    }
}
