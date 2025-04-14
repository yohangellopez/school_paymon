<?php

namespace App\Livewire\Frontend;

use App\Models\Academy;
use Livewire\Component;

class CourseSelector extends Component
{
    public $selectedAcademy;
    public $search = '';

    public function render()
    {
        return view('livewire.frontend.course-selector', [
            'academies' => Academy::with(['courses' => function($query) {
                $query->when($this->search, function($q) {
                    $q->where('name', 'like', '%'.$this->search.'%')
                      ->orWhere('description', 'like', '%'.$this->search.'%');
                });
            }])->get()
        ]);
    }
}
