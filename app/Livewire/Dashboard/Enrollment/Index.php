<?php

namespace App\Livewire\Dashboard\Enrollment;

use Livewire\Component;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Student;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use WithPagination;

    public $search = '';
    public $showCreateModal = false;
    public $showEditModal = false;
    public $editingEnrollment = null;
    public $selectedEnrollmentName  = null;

    // Campos del formulario
    public $student_id;
    public $course_id;
    public $enrollment_id;
    public $payment_method;
    public $amount;

    protected $rules = [
        'student_id' => 'required|exists:students,id',
        'course_id' => 'required|exists:courses,id',
        'payment_method' => 'required|in:cash,bank_transfer',
        'amount' => 'required|numeric|min:0'
    ];

    public function openCreateModal()
    {
        $this->resetForm();
        $this->showCreateModal = true;
    }

    public function openEditModal(Enrollment $enrollment)
    {
        $this->editingEnrollment = $enrollment;
        $this->student_id = $enrollment->student_id;
        $this->course_id = $enrollment->course_id;
        $this->payment_method = $enrollment->payment->method;
        $this->amount = $enrollment->payment->amount;
        $this->showEditModal = true;
    }

    public function createEnrollment()
    {
        $this->validate();

        $enrollment = Enrollment::create([
            'student_id' => $this->student_id,
            'course_id' => $this->course_id,
        ]);

        $enrollment->payments()->create([
            'method' => $this->payment_method,
            'amount' => $this->amount,
            'payment_date' => now()
        ]);

        $this->showCreateModal = false;
        $this->dispatch('notify', type: 'success', message: 'Matrícula registrada exitosamente');
    }

    public function updateEnrollment()
    {
        $this->validate();

        $this->editingEnrollment->update([
            'student_id' => $this->student_id,
            'course_id' => $this->course_id,
        ]);

        $this->editingEnrollment->payments()->update([
            'method' => $this->payment_method,
            'amount' => $this->amount
        ]);

        $this->showEditModal = false;
        $this->dispatch('notify', type: 'success', message: 'Matrícula actualizada exitosamente');
    }

    public function deleteEnrollment(Enrollment $enrollment)
    {
        $enrollment->payments()->delete();
        $enrollment->delete();
        $this->dispatch('notify', type: 'success', message: 'Matrícula eliminada exitosamente');
    }

    private function resetForm()
    {
        $this->reset([
            'student_id', 
            'course_id', 
            'enrollment_id',
            'payment_method',
            'amount'
        ]);
        $this->resetErrorBag();
    }

    public function render()
    {
        $enrollments = Enrollment::with(['student.representative', 'course.academy', 'payments'])
        ->when($this->search, function ($query) {
            $query->whereHas('student', function ($q) {
                $q->where('first_name', 'like', '%'.$this->search.'%')
                  ->orWhere('last_name', 'like', '%'.$this->search.'%');
            });
        })
        ->latest()
        ->paginate(10);

        return view('livewire.dashboard.enrollment.index', [
            'enrollments' => $enrollments,
            'students' => Student::all(),
            'courses' => Course::with('academy')->get()
        ]);
    }
}
