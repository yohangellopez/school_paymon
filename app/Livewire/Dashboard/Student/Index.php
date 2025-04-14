<?php

namespace App\Livewire\Dashboard\Student;

use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $search = "";
    public $first_name;
    public $last_name;
    public $date_of_birth;
    public $rep_search;
    public $representative_id;

    public function showModal($studentId)
    {
        $student = Student::findOrFail($studentId);
        $this->first_name              = $student->first_name;
        $this->last_name               = $student->last_name;
        $this->date_of_birth           = $student->date_of_birth;
        $this->representative_id       = $student->representative_id;
        $this->rep_search              = $student->representative->name . ' ' . $student->representative->last_name;

        $this->dispatch('show-modal-open'); // Nombre actualizado
    }

    public function render() {
        $students = Student::query()
        ->when($this->search, function ($query) {
            // Siempre aplicar filtro de profesor
            $query->when($this->search, function($q) {
                $q->where('first_name', 'like', '%'.$this->search.'%')
                  ->orWhere('last_name', 'like', '%'.$this->search.'%');
            });
        })
        ->paginate(10);

        return view('livewire.dashboard.student.index', [
            'students' => $students
        ]);
    }
}
