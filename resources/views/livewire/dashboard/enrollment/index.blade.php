<div x-data="{ isModalOpen: false, isCourseModalOpen: false}"
@open-modal.window="isModalOpen = true"
     @close-modal.window="isModalOpen = false; isCourseModalOpen = false;">
    <div class="card has-table">
        <header class="card-header">
            <p class="card-header-title">
                <span class="icon"><i class="mdi mdi-school"></i></span>
                Listado de Matriculas
            </p>
            <div class="navbar-item ">
                <div class="control flex items-center space-x-2">
                    <x-input wire:model.live.debounce.500ms="search" autocomplete="off" type="text" class="border-gray-50"
                        placeholder="Buscar matricula..." />
                </div>
            </div>
            <div class="navbar-item">
                <div class="buttons">
                    <x-button color="green" secondary="800" primary="500" class="px-2.5 py-2" wire:click="openModal()"
                        @click="isModalOpen = true;" ><i class="mdi mdi-plus-circle"></i>
                    </x-button>
                </div>
            </div>
        </header>

        <div class="card has-table">
            <div class="card-content">
                <table>
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Alumno</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Curso</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pago</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($enrollments as $enrollment)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $enrollment->student->first_name }} {{ $enrollment->student->last_name }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $enrollment->student->representative->name }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $enrollment->course->name }}</div>
                                <div class="text-sm text-gray-500">{{ $enrollment->course->academy->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $enrollment->created_at->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($enrollment->payments->isNotEmpty())
                                        @foreach($enrollment->payments as $payment)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $payment->method === 'cash' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                                {{ strtoupper($payment->method) }}: ${{ number_format($payment->amount, 2) }}
                                            </span>
                                        @endforeach
                                    @else
                                        <span class="text-gray-500 text-sm">Sin pagos</span>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap text-left text-sm font-medium">
                                    <button wire:click="openEditModal({{ $enrollment->id }})" 
                                            class="text-indigo-600 hover:text-indigo-900 mr-4">
                                        <i class="mdi mdi-pencil"></i>
                                    </button>
                                    <button wire:click="deleteEnrollment({{ $enrollment->id }})" 
                                            class="text-red-600 hover:text-red-900">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                    No se encontraron matrículas registradas
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                @if($enrollments->hasPages())
                    <div class="mt-4 flex justify-end">
                        @include('components.pagination', [
                            'paginator' => $enrollments,
                        ])
                    </div>
                @endif
            </div>
        </div>

        <!-- Modal de Creación -->
        <div 
            x-show="isModalOpen" 
            @keydown.escape.window="isModalOpen = false"
            class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center"
            x-cloak
        >
            <div class="bg-white p-6 rounded-lg w-full max-w-2xl">
                <!-- Título dinámico -->
                <h2 class="text-xl font-bold mb-4">
                    {{ $enrollment_id ? 'Editar' : 'Crear' }} Matricula
                </h2>
                <!-- Formulario de creación -->
                <form wire:submit.prevent="save">
                    <div class="space-y-4">
                        <div class="flex flex-wrap md:flex-nowrap space-x-2">
                            <div class="w-full">
                                <x-label>Nombre:</x-label>
                                <x-input type="text" class="border-gray-50 w-full" 
                                    placeholder="1er Matricula" wire:model="name" />
                                @error('name')
                                    <span class="text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="flex flex-wrap md:flex-nowrap space-x-2">
                            <div class="w-full">
                                <textarea 
                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                        placeholder="Descripción de la Matricula..." 
                                        wire:model="description"
                                        rows="2" cols="70">
                                </textarea>
                                @error('description')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="border-t pt-4">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="font-semibold">Cursos</h3>
                                <x-button type="button" wire:click="addSection" icon="plus" color="gray">Agregar</x-button>
                            </div>
                            
                            <div class="space-y-4">
                                @foreach($courses as $index => $course)
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <!-- Nombre -->
                                        <div>
                                            <x-label>Nombre del Curso:</x-label>
                                            <x-input type="text" 
                                                placeholder="Matemáticas Avanzadas" 
                                                wire:model="courses.{{ $index }}.name" />
                                            @error("courses.{$index}.name") 
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Modalidad -->
                                        <div>
                                            <x-label>Modalidad:</x-label>
                                            <x-select 
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2 px-3"
                                            wire:model="courses.{{ $index }}.modality">
                                                <option value="">Seleccione...</option>
                                               
                                            </x-select>
                                            @error("courses.{$index}.modality")
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Descripción -->
                                        <div class="md:col-span-2">
                                            <x-label>Descripción:</x-label>
                                            <textarea 
                                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                                placeholder="Descripción del curso..." 
                                                wire:model="courses.{{ $index }}.description"
                                                rows="2" cols="70">
                                            </textarea>
                                            @error("courses.{$index}.description")
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Costo y Duración -->
                                        <div>
                                            <x-label>Costo (USD):</x-label>
                                            <x-input type="number" 
                                                placeholder="Ej: 199.99" 
                                                step="0.01"
                                                wire:model="courses.{{ $index }}.cost" />
                                            @error("courses.{$index}.cost")
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div>
                                            <x-label>Duración (horas):</x-label>
                                            <x-input type="number" 
                                                placeholder="Ej: 40" 
                                                wire:model="courses.{{ $index }}.duration_hours" />
                                            @error("courses.{$index}.duration_hours")
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Botón para eliminar curso -->
                                    @if($index > 0)
                                        <div class="mt-2 text-right">
                                            <x-button 
                                                type="button" 
                                                wire:click="removeSection({{ $index }})" 
                                                color="red" 
                                                class="px-2 py-1 text-sm">
                                                Eliminar Curso
                                            </x-button>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="mt-4 flex justify-end space-x-2">
                        <x-button @click.prevent="isModalOpen = false" class="px-2 py-2">Cancelar</x-button>
                        <x-button type="submit" class="px-2 py-2 bg-blue-700 hover:bg-blue-800">Guardar</x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('livewire:initialized', () => {
    Livewire.on('showToast', (params) => {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
        });
        Toast.fire({
            icon: params.type || 'success',
            title: params.message || 'Operación exitosa'
        });
    });
    });

    document.addEventListener('alpine:init', () => {
        Alpine.store('modalState', {
            isShowModalOpen: false,
            isCourseModalOpen: false // Añade este estado
        });
    });
</script>