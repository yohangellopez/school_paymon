<?php

namespace App\Livewire\Frontend;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Payment;
use App\Models\Student;
use Livewire\Component;

class EnrollmentForm extends Component
{
    public $currentStep = 1;
    public $totalSteps = 3;

    // Paso 1: Selección de curso
    public $selectedCourse;
    public $courses;

    // Paso 2: Datos del estudiante
    public $student = [
        'first_name' => '',
        'last_name' => '',
        'birthdate' => '',
        'parent_email' => '',
        'parent_phone' => ''
    ];

    // Paso 3: Información de pago
    public $paymentMethod = 'cash';
    public $amount;

    protected $rules = [
        // Paso 1
        'selectedCourse' => 'required|exists:courses,id',
        
        // Paso 2
        'student.first_name' => 'required|string|max:50',
        'student.last_name' => 'required|string|max:50',
        'student.birthdate' => 'required|date|before:-5 years',
        'student.parent_email' => 'required|email',
        'student.parent_phone' => 'required|string|max:15',
        
        // Paso 3
        'paymentMethod' => 'required|in:cash,bank_transfer',
        'amount' => 'required|numeric|min:0'
    ];

    protected $messages = [
        'student.birthdate.before' => 'El estudiante debe tener al menos 5 años',
        'selectedCourse.required' => 'Debe seleccionar un curso',
        'paymentMethod.in' => 'Método de pago no válido'
    ];

    public function mount()
    {
        $this->courses = Course::with('academy')
            ->orderBy('name')
            ->get();
    }

    public function selectCourse($courseId)
    {
        $this->selectedCourse = Course::with('academy')->find($courseId);
    }

    public function getSelectedCourseProperty()
    {
        if($this->selectedCourse) {
            return Course::with('academy')->find($this->selectedCourse);
        }
        return null;
    }

    public function render()
    {
        return view('livewire.frontend.enrollment-form');
    }

    public function nextStep()
    {
        $this->validateCurrentStep();
        $this->currentStep < $this->totalSteps && $this->currentStep++;
    }

    public function previousStep()
    {
        $this->currentStep > 1 && $this->currentStep--;
    }

    private function validateCurrentStep()
    {
        switch($this->currentStep) {
            case 1:
                $this->validateOnly('selectedCourse');
                break;
            case 2:
                $this->validateOnly('student.*');
                break;
            case 3:
                $this->validateOnly('paymentMethod');
                $this->validateOnly('amount');
                break;
        }
    }

    public function submitEnrollment()
    {
        $this->validate();

        try {
            // Registrar estudiante
            $student = Student::create($this->student);

            // Crear matrícula
            $enrollment = Enrollment::create([
                'student_id' => $student->id,
                'course_id' => $this->selectedCourse,
                'enrollment_date' => now()
            ]);

            // Registrar pago
            Payment::create([
                'enrollment_id' => $enrollment->id,
                'method' => $this->paymentMethod,
                'amount' => $this->amount,
                'payment_date' => now()
            ]);

            $this->resetForm();
            $this->dispatchBrowserEvent('enrollment-success');

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('enrollment-error');
        }
    }

    private function resetForm()
    {
        $this->resetExcept('courses');
        $this->currentStep = 1;
    }
}
