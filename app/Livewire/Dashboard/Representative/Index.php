<?php

namespace App\Livewire\Dashboard\Representative;

use App\Models\Representative;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $search = "";

    public $representative_id;
    public $name;
    public $email;
    public $phone;

    public $students = [];
    public $selectedRepresentativeName;

    public function loadStudents($representativeId)
    {
        $representative = Representative::with('students')->find($representativeId);
    
        $this->students = $representative->students;
        $this->selectedRepresentativeName = $representative->name; // Asegúrate de tener el atributo full_name en tu modelo
    }

    public function showModal($representativeId)
    {
        $representative = Representative::findOrFail($representativeId);
        $this->representative_id = $representative->id;
        $this->name = $representative->name;
        $this->email = $representative->email;
        $this->phone = $representative->phone;

        $this->dispatch('show-modal-open'); // Nombre actualizado
    }

    public function render() {

        $representatives = Representative::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%'.$this->search.'%')
                        ->orWhere('email', 'like', '%'.$this->search.'%');
            })
            ->paginate(10);


        return view('livewire.dashboard.representative.index', [
            'representatives' => $representatives
        ]);
    }
}
