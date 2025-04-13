<div x-data="{ isStudentModalOpen: false }"
    x-bind:class="{ 'overflow-hidden': $store.modalState.isShowModalOpen }"
    @keydown.escape.window="$store.modalState.isShowModalOpen = false"
    @open-modal.window="isShowModalOpen = false;"
    @close-modal.window="isShowModalOpen = false; isStudentModalOpen = false;"
>
    <div class="card has-table">
        <header class="card-header">
            <p class="card-header-title">
                <span class="icon"><i class="mdi mdi-school"></i></span>
                Listado de Representantes
            </p>
            <div class="navbar-item ">
                <div class="control flex items-center space-x-2">
                    <x-input wire:model.live.debounce.500ms="search" autocomplete="off" type="text" class="border-gray-50"
                        placeholder="Buscar representante..." />
                </div>
            </div>
        </header>

        <div class="card has-table">
            <div class="card-content">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Estudiantes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($representatives as $representative)
                            <tr>
                                <td>{{ $representative->id }}</td>
                                <td>{{ $representative->name }}</td>
                                <td>{{ $representative->email }}</td>
                                <td>{{ $representative->phone }}</td>
                                <td>
                                    <button 
                                        wire:click="loadStudents({{ $representative->id }})"
                                        @click="isStudentModalOpen = true"
                                        class="bg-blue-500 hover:bg-blue-600 text-white rounded-full px-4 py-1 transition-colors duration-200"
                                    >
                                        {{ $representative->students->count() }}
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">No hay representantes registrados</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                @if($representatives->hasPages())
                    <div class="mt-4 flex justify-end">
                        @include('components.pagination', [
                            'paginator' => $representatives,
                        ])
                    </div>
                @endif
            </div>
        </div>

        <!-- Modal de Visualización -->
        <div 
        x-show="$store.modalState.isShowModalOpen"
        @keydown.escape.window="$store.modalState.isShowModalOpen = false"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform scale-95"
        x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-95"
        class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center"
        x-cloak
        >
            <div class="bg-white p-6 rounded-lg w-full max-w-2xl">
                <h2 class="text-xl font-bold mb-4">
                    Detalles del Representante
                </h2>
                
                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Campos en modo lectura -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nombre:</label>
                            <p class="mt-1">{{ $name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email:</label>
                            <p class="mt-1">{{ $email }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Teléfono:</label>
                            <p class="mt-1">{{ $phone }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-4 flex justify-end">
                    <x-button @click.prevent="$store.modalState.isShowModalOpen = false" class="px-2 py-2">
                        Cerrar
                    </x-button>
                </div>
            </div>
        </div>

        <!-- Modal de Alumnos -->
        <div 
        x-show="isStudentModalOpen" 
        @keydown.escape.window="isStudentModalOpen = false"
        class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center"
        x-cloak
        >
            <div class="bg-white p-6 rounded-lg w-full max-w-2xl max-h-[80vh] overflow-y-auto">
                <h2 class="text-xl font-bold mb-4">
                    Alumnos de {{ $selectedRepresentativeName }}
                </h2>
                
                <div class="space-y-4">
                    @forelse ($students as $student)
                        <div class="border rounded-lg p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="font-semibold">{{ $student->first_name.' '.$student->last_name }}</p>
                                </div>
                                <div class="text-sm text-gray-500">
                                    Edad: {{ $student->age }} años
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4 text-gray-500">
                            No hay alumnos registrados
                        </div>
                    @endforelse
                </div>

                <div class="mt-4 flex justify-end">
                    <x-button @click.prevent="isStudentModalOpen = false" class="px-4 py-2">
                        Cerrar
                    </x-button>
                </div>
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

        Livewire.on('show-modal', () => {
        });
        
        Livewire.on('show-modal-open', () => {
            Alpine.store('modalState').openShowModal();
        });
    });

    document.addEventListener('alpine:init', () => {
        Alpine.store('modalState', {
            isShowModalOpen: false,

            openShowModal() {
                this.isShowModalOpen = true;
            }
        });
    });

</script>