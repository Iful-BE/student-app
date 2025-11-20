<?php

namespace App\Livewire;

use App\Exports\StudentsExport;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Student;
use App\Models\Lembaga;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Maatwebsite\Excel\Facades\Excel;

class StudentPage extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $filterLembaga = '';
    public $perPage = 10;

    public $showModal = false;
    public $student_id, $lembaga_id, $nis, $nama, $email, $foto;
 
    public $lembagas;
    public $sortField = 'nis';
    public $sortDirection = 'asc';
    public $fotoFile;
    public $photoPreview;

    protected $listeners = ['edit' => 'edit', 'openModal' => 'openModal', 'closeModal' => 'closeModal'];

    public $toasts = [];

    public function mount()
    {
        $this->lembagas = Lembaga::where('status',0)->get();
    }

    public function updatingSearch() { $this->resetPage(); }
    public function updatingFilterLembaga() { $this->resetPage(); }

  public function resetForm()
{
    $this->reset(['student_id', 'lembaga_id', 'nis', 'nama', 'email', 'foto', 'fotoFile', 'photoPreview']);
}

  public function openModal()
{
    $this->resetForm();
    $this->showModal = true;
}

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function edit($id)
    {
        $s = Student::findOrFail($id);

        $this->student_id = $s->id;
        $this->lembaga_id = $s->lembaga_id;
        $this->nis        = $s->nis;
        $this->nama       = $s->nama;
        $this->email      = $s->email;
        $this->foto       = $s->foto;
        $this->photoPreview = $s->foto ? asset('storage/' . $s->foto) : null;

        $this->showModal = true;
    }

  public function updatedFotoFile()
{
    if ($this->fotoFile) {
        $this->photoPreview = $this->fotoFile->temporaryUrl();
    }
}



    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function save()
{
    $this->validate([
        'lembaga_id' => 'required',
        'nis'        => 'required|numeric|unique:students,nis,' . $this->student_id,
        'nama'       => 'required',
        'email'      => 'required|email',
        'fotoFile'   => 'nullable|image|mimes:jpg,png|max:1024',
    ]);

    $data = [
        'lembaga_id' => $this->lembaga_id,
        'nis'        => $this->nis,
        'nama'       => $this->nama,
        'email'      => $this->email,
    ];

   if ($this->fotoFile) {
    $filePath = $this->fotoFile->store('students', 'public');
    $data['foto'] = $filePath;
    $this->foto = $filePath; // update model
    $this->photoPreview = asset('storage/' . $filePath);
}


    $student = Student::updateOrCreate(
        ['id' => $this->student_id],
        $data
    );

    $this->closeModal();
    $this->resetForm();
    $this->resetPage();
    $this->dispatch('refresh-students');

    $this->addToast(
        $student->wasRecentlyCreated ? 'Student created successfully!' : 'Student updated successfully!',
        'success'
    );
}

    public function updateStatus($id, $value)
    {
        $student = Student::find($id);
        $student->update(['status' => (int) $value]);

        $this->addToast('Student status updated successfully!');
    }

    public function addToast($message, $type = 'success')
    {
        $this->toasts[] = [
            'message' => $message,
            'type' => $type,
        ];
    }

    public function removeToast($index)
    {
        unset($this->toasts[$index]);
        $this->toasts = array_values($this->toasts);
    }

    public function getFilteredQuery()
    {
        return Student::with('lembaga')
            ->where(function ($q) {
                $q->where('nama', 'like', "%{$this->search}%")
                  ->orWhere('nis', 'like', "%{$this->search}%");
            })
            ->when($this->filterLembaga, fn($q) => $q->where('lembaga_id', $this->filterLembaga))
            ->orderBy($this->sortField, $this->sortDirection);
    }

    public function exportExcel()
    {
        return Excel::download(
            new StudentsExport($this->getFilteredQuery()->get()),
            'students.xlsx'
        );
    }

    public function render()
    {
        return view('livewire.student-page', [
            'students' => $this->getFilteredQuery()->paginate($this->perPage),
        ]);
    }
}
