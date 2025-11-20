<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Student;
use App\Models\Lembaga;

class StudentModal extends Component
{
    use WithFileUploads;
    public $lembagas;
    public $status = 0;
    public $lembaga_id, $nis, $nama, $email, $foto;

    public function mount()
    {
        $this->lembagas = Lembaga::all();
    }

    public function resetForm()
    {
        $this->reset(['lembaga_id', 'nis', 'nama', 'email', 'foto']);
    }

        

    public function render()
    {
        return view('livewire.student-modal');
    }
}
