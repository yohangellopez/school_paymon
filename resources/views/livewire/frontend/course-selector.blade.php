<div>
    <div class="mb-8">
        <x-input wire:model.debounce.300ms="search" 
                 placeholder="Buscar cursos..." 
                 icon="magnify"
                 class="w-full max-w-xl mx-auto" />
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($academies as $academy)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $academy->name }}</h3>
                    <p class="text-gray-600 mb-4">{{ $academy->description }}</p>
                    
                    <div class="space-y-4">
                        @foreach($academy->courses as $course)
                            <div class="border-l-4 border-blue-600 pl-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="font-semibold text-gray-900">{{ $course->name }}</h4>
                                        <div class="flex items-center space-x-2 text-sm text-gray-600">
                                            <span>{{ $course->duration_hours }} horas</span>
                                            <span>•</span>
                                            <span class="capitalize">{{ $course->modality }}</span>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-lg font-bold text-blue-600">
                                            ${{ number_format($course->cost, 2) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-600">No se encontraron cursos disponibles</p>
            </div>
        @endforelse
    </div>
</div>