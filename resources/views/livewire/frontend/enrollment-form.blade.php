<!-- Actualización en la vista -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    @forelse($courses as $course)
        <div 
            wire:click="selectCourse({{ $course->id }})"
            class="border-2 rounded-xl p-6 cursor-pointer transition-all
                  @if($selectedCourse && $selectedCourse->id == $course->id) border-blue-600 bg-blue-50 @else border-gray-200 hover:border-blue-400 @endif"
        >
            <div class="flex justify-between items-start">
                <div>
                    <h4 class="text-lg font-semibold text-gray-800">
                        {{ $course->name }}
                        @if($selectedCourse && $selectedCourse->id == $course->id)
                            <i class="mdi mdi-check-circle text-blue-600 ml-2"></i>
                        @endif
                    </h4>
                    <p class="text-sm text-gray-600 mt-2">
                        {{ $course->academy->name }}
                    </p>
                </div>
                <div class="text-right">
                    <div class="text-xl font-bold text-blue-600">
                        ${{ number_format($course->cost, 2) }}
                    </div>
                    <span class="text-sm text-gray-500">
                        {{ $course->duration_hours }} horas
                    </span>
                </div>
            </div>
            <div class="mt-4 text-sm text-gray-600">
                <i class="mdi mdi-clock-outline mr-2"></i>
                Modalidad: {{ ucfirst($course->modality->value) }}
            </div>
        </div>
    @empty
        <div class="col-span-full text-center py-12">
            <p class="text-gray-600">No hay cursos disponibles en este momento</p>
        </div>
    @endforelse
</div>

<!-- Mostrar detalles del curso seleccionado -->
@if($selectedCourse)
<div class="mt-6 bg-blue-50 p-4 rounded-lg">
    <h4 class="font-semibold text-blue-800 mb-2">
        <i class="mdi mdi-information-outline mr-2"></i>
        Curso Seleccionado
    </h4>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <p class="text-sm"><span class="font-medium">Nombre:</span> 
            {{ $this->selectedCourse->name }}</p>
            <p class="text-sm"><span class="font-medium">Academia:</span> 
            {{ $this->selectedCourse->academy->name }}</p>
        </div>
        <div>
            <p class="text-sm"><span class="font-medium">Duración:</span> 
            {{ $this->selectedCourse->duration_hours }} horas</p>
            <p class="text-sm"><span class="font-medium">Modalidad:</span> 
            {{ ucfirst($this->selectedCourse->modality->value) }}</p>
        </div>
    </div>
</div>
@endif