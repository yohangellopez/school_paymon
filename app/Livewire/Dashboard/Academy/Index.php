<?php

namespace App\Livewire\Dashboard\Academy;

use App\Enum\Course\CourseModalityEnum;
use App\Models\Academy;
use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class Index extends Component
{
    use WithPagination;
    
    public $search = "";
    public $selectedAcademyName = "";
    public $academy_id;
    public $name;
    public $description;
    public $courses = [];
    public $courses_show = [];
    public $modalities = [];

    protected $rules = [
        'name'                     => 'required|string|max:50|unique:academies,name',
        'description'              => 'required|string|max:255',
        'courses'                  => 'array',
        'courses.*.name'           => 'required|string|max:100',
        'courses.*.description'    => 'required|string|max:255',
        'courses.*.cost'           => 'required|numeric|min:0',
        'courses.*.duration_hours' => 'required|integer|min:1',
        'courses.*.modality'       => 'required',
    ];

    public function loadCourses($academyId) {
        $academy = Academy::with('courses')->find($academyId);
        
        $this->courses_show = $academy->courses;
        $this->selectedAcademyName = $academy->name;
    }

    public function openModal($academy_id = null) {
        $this->reset([
            'name',
            'description',
            'courses',
            'academy_id'
        ]);
        if($academy_id) {
            $academy = Academy::find($academy_id);
            $this->academy_id = $academy->id;
            $this->name = $academy->name;
            $this->description = $academy->description;
            $this->courses = $academy->courses->map(function ($course) {
                return [
                    'id' => $course->id,
                    'name' => $course->name,
                    'description' => $course->description,
                    'cost' => $course->cost,
                    'duration_hours' => $course->duration_hours,
                    'modality' => $course->modality->value,
                ];
            })->toArray();
        }
        $this->dispatch('open-modal');
    }

    public function addSection()
    {
        $this->courses[] = [
            'name' => '',
            'description' => '',
            'cost' => '',
            'duration_hours' => '',
            'modality' => ''
        ]; 
    }

    public function save() {
        $this->rules['name'] = $this->academy_id ? 
            "required|unique:academies,name,{$this->academy_id}" : 
            "required|unique:academies,name";

        $this->validate();
        
        $academy = Academy::updateOrCreate(['id' => $this->academy_id], [
            'name' => $this->name,
            'description' => $this->description,
        ]);

        foreach ($this->courses as $course) {
            Course::updateOrCreate(
                ['id' => $course['id'] ?? null],
                [
                    'name' => $course['name'], 
                    'description' => $course['description'],
                    'cost' => $course['cost'],
                    'duration_hours' => $course['duration_hours'],
                    'modality' => $course['modality'],
                    'academy_id' => $academy->id
                ]
            );
        }

        
        $this->dispatch('showToast', type: 'success', message: 'Academía guardado');
        $this->dispatch('close-modal'); // documenterra el modal
        $this->reset();
    }

    public function render() {
        $this->modalities = CourseModalityEnum::list();
        return view('livewire.dashboard.academy.index', [
            'academies' => Academy::with('courses')
                ->where('name', 'like', "%{$this->search}%")
                ->orWhereHas('courses', function ($query) {
                    $query->where('name', 'like', "%{$this->search}%");
                })
                ->paginate(10)
        ]);
    }
}
