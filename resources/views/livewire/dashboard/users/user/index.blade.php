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
                Listado de Usuarios Registrados
            </p>
            <div class="navbar-item ">
                <div class="control flex items-center space-x-2">
                    <x-input wire:model.live.debounce.500ms="search" autocomplete="off" type="text" class="border-gray-50"
                        placeholder="Buscar usuario..." />
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
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <x-button class="px-2 py-2"  wire:click="showModal({{ $user->id }})" color="gray">
                                        <i class="mdi mdi-eye"></i>
                                    </x-button>
                                    <x-button class="px-2 py-2"  wire:click="openModal({{ $user->id }})" color="gray">
                                        <i class="mdi mdi-pencil"></i>
                                    </x-button>
                                    <x-button class="px-2 py-2"  wire:click="confirmDelete({{ $user->id }})"  color="gray">
                                        <i class="mdi mdi-delete"></i>
                                    </x-button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">No hay Usuarios registrados</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                @if($users->hasPages())
                    <div class="mt-4 flex justify-end">
                        @include('components.pagination', [
                            'paginator' => $users,
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
                    {{ $user_id ? 'Editar' : 'Crear' }} Usuario
                </h2>
                <!-- Formulario de creación -->
                <form wire:submit.prevent="save">
                    <div class="space-y-4">
                        <div class="flex flex-wrap md:flex-nowrap space-x-2">
                            <div class="w-full">
                                <x-label>Nombre:</x-label>
                                <x-input type="text" class="border-gray-50 w-full" 
                                    placeholder="Juan" wire:model="name" />
                                @error('name')
                                    <span class="text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="w-full">
                                <x-label>Teléfono:</x-label>
                                <x-input type="text" class="border-gray-50 w-full" 
                                    placeholder="041X-" wire:model="phone" />
                                @error('phone')
                                    <span class="text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="flex flex-wrap md:flex-nowrap space-x-2">
                            <div class="w-full">
                                <x-label>Correo electronico:</x-label>
                                <x-input type="text" class="border-gray-50 w-full" 
                                    placeholder="xxxxxxx@xxxx.com" wire:model="email" />
                                @error('email')
                                    <span class="text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="w-full">
                                <x-label>Contraseña:</x-label>
                                <x-input type="password" class="border-gray-50 w-full" 
                                    placeholder="***********" wire:model="password" />
                                @error('password')
                                    <span class="text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="mt-4 flex justify-end space-x-2">
                        <x-button @click.prevent="isModalOpen = false" class="px-2 py-2">Cancelar</x-button>
                        <x-button type="submit" color="blue" class="bg-blue-700 hover:bg-blue-800 px-2 py-2">Guardar</x-button>
                    </div>
                </form>
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
                    Detalles del Usuario
                </h2>
                
                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Campos en modo lectura -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nombre:</label>
                            <p class="mt-1">{{ $name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Teléfono:</label>
                            <p class="mt-1">{{ $phone }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email:</label>
                            <p class="mt-1">{{ $email }}</p>
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

        Livewire.on('show-delete-confirmation', (event) => {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡Esta acción no se puede revertir!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log('Evento show-delete-confirmation recibido');
                    // Aquí puedes llamar a la función de Livewire para eliminar el usuario
                    Livewire.dispatch('delete-user', {userId: event.userId});
                }
            });
        });

        // Añade esto a tus listeners
        Livewire.on('delete-user', (event) => {
            Livewire.dispatch('deleteUser', {userId: event.userId});
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