<div x-data="{ isModalOpen: false, isCourseModalOpen: false}"
@open-modal.window="isModalOpen = true"
     @close-modal.window="isModalOpen = false; isCourseModalOpen = false;">
    <div class="card has-table">
        <header class="card-header">
            <p class="card-header-title">
                <span class="icon"><i class="mdi mdi-school"></i></span>
                Listado de Academias
            </p>
            <div class="navbar-item ">
                <div class="control flex items-center space-x-2">
                    <x-input wire:model.live.debounce.500ms="search" autocomplete="off" type="text" class="border-gray-50"
                        placeholder="Buscar academia..." />
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
                            <th>Nombre</th>
                            <th>Cursos</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($academies as $academy)
                            <tr>
                                <td>{{ $academy->name }}</td>
                                <td>
                                    <button 
                                        wire:click="loadCourses({{ $academy->id }})" 
                                        @click="$store.modalState.isCourseModalOpen = true"
                                        class="bg-blue-500 hover:bg-blue-600 text-white rounded-full px-4 py-1 transition-colors duration-200"
                                    >
                                        {{ $academy->courses->count() }} Cursos
                                    </button>
                                </td>
                                <td>
                                    <x-button class="bg-blue-500 hover:bg-blue-600 text-black p-2" wire:click="openModal({{ $academy->id }})" color="blue">
                                        <i class="mdi mdi-pencil"></i>
                                    </x-button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">No hay academias registrados</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                @if($academies->hasPages())
                    <div class="mt-4 flex justify-end">
                        @include('components.pagination', [
                            'paginator' => $academies,
                        ])
                    </div>
                @endif
            </div>
        </div>

        <!-- Modal de Cursos -->
        <div 
        x-show="$store.modalState.isCourseModalOpen"
        @keydown.escape.window="$store.modalState.isCourseModalOpen = false"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform scale-95"
        x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-95"
        class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center"
        x-cloak
        >
            <div class="bg-white p-6 rounded-lg w-full max-w-4xl">
                <h2 class="text-xl font-bold mb-4">
                    Cursos de: {{ $selectedAcademyName }}
                </h2>
                
                <div class="space-y-4">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-4 py-2 text-left">Nombre</th>
                                <th class="px-4 py-2 text-left">Modalidad</th>
                                <th class="px-4 py-2 text-left">Costo</th>
                                <th class="px-4 py-2 text-left">Duración (horas)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($courses_show as $course)
                                <tr>
                                    <td class="px-4 py-2">{{ $course->name }}</td>
                                    <td class="px-4 py-2">
                                        @if($course->modality === 'in_person')
                                            Presencial
                                        @else
                                            Virtual
                                        @endif
                                    </td>
                                    <td class="px-4 py-2">${{ number_format($course->cost, 2) }}</td>
                                    <td class="px-4 py-2">{{ $course->duration_hours }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-2 text-center text-gray-500">
                                        No hay cursos registrados
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 flex justify-end">
                    <x-button @click.prevent="$store.modalState.isCourseModalOpen = false" class="px-2 py-2">
                        Cerrar
                    </x-button>
                </div>
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
                    {{ $academy_id ? 'Editar' : 'Crear' }} Academia
                </h2>
                <!-- Formulario de creación -->
                <form wire:submit.prevent="save">
                    <div class="space-y-4">
                        <div class="flex flex-wrap md:flex-nowrap space-x-2">
                            <div class="w-full">
                                <x-label>Nombre:</x-label>
                                <x-input type="text" class="border-gray-50 w-full" 
                                    placeholder="1er Academia" wire:model="name" />
                                @error('name')
                                    <span class="text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="flex flex-wrap md:flex-nowrap space-x-2">
                            <div class="w-full">
                                <textarea 
                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                        placeholder="Descripción de la academia..." 
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
                                                @foreach ($modalities as $modality)
                                                    <option value="{{ $modality->value }}">{{ $modality->name }}</option>
                                                @endforeach
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