<div x-data="{ isModalOpen: false }"
    x-bind:class="{ 'overflow-hidden': $store.modalState.isShowModalOpen }"
    @keydown.escape.window="$store.modalState.isShowModalOpen = false"
    @open-modal.window="isModalOpen = true; isShowModalOpen = false;"
    @close-modal.window="isModalOpen = false; isShowModalOpen = false;"
>
    <div class="card has-table">
        <header class="card-header">
            <p class="card-header-title">
                <span class="icon"><i class="mdi mdi-school"></i></span>
                Listado de Alumnos
            </p>
            <div class="navbar-item ">
                <div class="control flex items-center space-x-2">
                    <x-input wire:model.live.debounce.500ms="search" autocomplete="off" type="text" class="border-gray-50"
                        placeholder="Buscar alumno..." />
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
                            <th>Representante</th>
                            <th>Edad</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($students as $student)
                            <tr>
                                <td>{{ $student->id }}</td>
                                <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                                <td>{{ $student->representative->first_name.' '.$student->representative->last_name }}</td>
                                <td>{{ \Carbon\Carbon::parse($student->date_of_birth)->age }} años</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">No hay alumnos registrados</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                @if($students->hasPages())
                    <div class="mt-4 flex justify-end">
                        @include('components.pagination', [
                            'paginator' => $students,
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
                    Detalles del Alumno
                </h2>
                
                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Campos en modo lectura -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nombre:</label>
                            <p class="mt-1">{{ $first_name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Apellido:</label>
                            <p class="mt-1">{{ $last_name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Fecha de Nacimiento:</label>
                            <p class="mt-1">{{ $date_of_birth ? \Carbon\Carbon::parse($date_of_birth)->format('d/m/Y') : '' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Representante:</label>
                            <p class="mt-1">{{ $rep_search }}</p>
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
            console.log('Evento show-modal recibido');
        });
            
        Livewire.on('show-modal-open', () => {
            console.log('Evento recibido - Abriendo modal');
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