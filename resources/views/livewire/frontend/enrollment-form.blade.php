<div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-8">
    <!-- Progress Steps -->
    <div class="mb-8">
        <div class="flex justify-between">
            @foreach(range(1, $totalSteps) as $step)
                <div class="w-1/3 text-center">
                    <div class="h-2 bg-gray-200 rounded-full mb-2">
                        <div class="h-full bg-blue-600 rounded-full transition-all duration-300"
                             :class="{ 'w-full': currentStep >= $step, 'w-0': currentStep < $step }"></div>
                    </div>
                    <span class="text-sm font-medium" 
                          :class="{ 'text-blue-600': currentStep >= $step, 'text-gray-400': currentStep < $step }">
                        Paso {{ $step }}
                    </span>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Step Content -->
    <div class="space-y-8">
        <!-- Paso 1: Selección de Curso -->
        <div x-show="currentStep == 1">
            <h3 class="text-2xl font-bold mb-6 text-gray-800">Selecciona el Curso</h3>
            
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
            @error('selectedCourse')
                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Paso 2: Datos del Estudiante -->
        <div x-show="currentStep === 2">
            <h3 class="text-2xl font-bold mb-6 text-gray-800">Datos del Estudiante</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <x-label>Nombre del Estudiante</x-label>
                    <x-input wire:model="student.first_name" 
                             placeholder="Ej: María" />
                    @error('student.first_name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <x-label>Apellido</x-label>
                    <x-input wire:model="student.last_name" 
                             placeholder="Ej: González" />
                    @error('student.last_name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <x-label>Fecha de Nacimiento</x-label>
                    <x-input type="date" wire:model="student.birthdate" />
                    @error('student.birthdate')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <x-label>Email del Representante</x-label>
                    <x-input type="email" wire:model="student.parent_email" 
                             placeholder="tucorreo@ejemplo.com" />
                    @error('student.parent_email')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="md:col-span-2">
                    <x-label>Teléfono de Contacto</x-label>
                    <x-input wire:model="student.parent_phone" 
                             placeholder="Ej: +58 412 1234567" />
                    @error('student.parent_phone')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Paso 3: Información de Pago -->
        <div x-show="currentStep === 3">
            <h3 class="text-2xl font-bold mb-6 text-gray-800">Información de Pago</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <x-label>Método de Pago</x-label>
                    <x-select wire:model="paymentMethod">
                        <option value="">Seleccionar método</option>
                        <option value="cash">Efectivo</option>
                        <option value="bank_transfer">Transferencia Bancaria</option>
                    </x-select>
                    @error('paymentMethod')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <x-label>Monto a Pagar</x-label>
                    <x-input type="number" 
                             wire:model="amount" 
                             step="0.01"
                             placeholder="Ej: 150.00" />
                    @error('amount')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="md:col-span-2 bg-blue-50 p-4 rounded-lg">
                    <div class="flex items-center">
                        <i class="mdi mdi-information-outline text-blue-600 mr-2"></i>
                        <p class="text-sm text-blue-800">
                            El monto mínimo para reservar la matrícula es de $50. 
                            El saldo restante debe cancelarse antes del inicio del curso.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Buttons -->
    <div class="mt-8 flex justify-between">
        <div>
            @if($currentStep > 1)
                <x-button color="gray" wire:click="previousStep">
                    <i class="mdi mdi-arrow-left mr-2"></i> Anterior
                </x-button>
            @endif
        </div>
        
        <div>
            @if($currentStep < $totalSteps)
                <x-button color="blue" class="bg-blue-700 hover:bg-blue-800 p-2" wire:click="nextStep">
                    Siguiente <i class="mdi mdi-arrow-right ml-2"></i>
                </x-button>
            @else
                <x-button color="green" class="bg-green-700 hover:bg-green-800 p-2" wire:click="submitEnrollment">
                    <i class="mdi mdi-check-circle-outline mr-2"></i> Confirmar Matrícula
                </x-button>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('livewire:load', function() {
        Livewire.on('enrollment-success', () => {
            Swal.fire({
                icon: 'success',
                title: '¡Matrícula Exitosa!',
                html: `
                    <div class="text-left">
                        <p class="mb-2">Hemos enviado un correo de confirmación a:</p>
                        <p class="font-semibold text-blue-600">${@this.student.parent_email}</p>
                        <p class="mt-4 text-sm text-gray-600">Guarde este número de referencia: 
                            <span class="font-mono">#${Math.floor(100000 + Math.random() * 900000)}</span>
                        </p>
                    </div>
                `,
                confirmButtonText: 'Aceptar'
            });
        });

        Livewire.on('enrollment-error', () => {
            Swal.fire({
                icon: 'error',
                title: 'Error en la Matrícula',
                text: 'Ocurrió un error al procesar su solicitud. Por favor intente nuevamente.',
                confirmButtonText: 'Entendido'
            });
        });
    });
</script>
@endpush