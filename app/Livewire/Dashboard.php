<?php

namespace App\Livewire;

use App\Models\Student;
use App\Models\User;
use Livewire\Component;
use Livewire\Volt\Compilers\Mount;

class Dashboard extends Component
{
    public $activeStudents;
    public $inactiveStudents;
    public $lembagaStudents;
    public function mount(){
        $this->activeStudents=Student::where('status',0)->count('id');
        $this->inactiveStudents=Student::where('status',1)->count('id');
        $this->lembagaStudents = Student::select('lembaga_id')
        ->selectRaw('COUNT(*) as total')
        ->groupBy('lembaga_id')
        ->with('lembaga')
        ->get();
    }
    public function render()
    {
        return view('livewire.dashboard');
    }
}
