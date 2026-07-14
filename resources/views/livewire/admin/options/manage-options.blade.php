<div>
    <section class="rounded-lg bg-inherit shadow-lg">
        
        <header class="border-b border-gray-700 px-6 py-4">
                <div class="flex justify-between">
                    <h1 class="text-lg font-semibold text-gray-300">
                        Opciones
                    </h1>

                    <x-button wire:click="$set('newOption.openModal', true)">
                        Nuevo
                    </x-button>

                </div>
        </header>
           
        <div class="p-6">
            <div class="space-y-6">
                @foreach ($options as $option)
                    <div class="p-6 rounded-lg border border-gray-700 relative"
                        wire:key="option-{{ $option->id }}">
                        <div class="absolute -top-3 px-4 dark:bg-gray-800">
                            <button class="ml-1"
                                onclick="confirmDelete({{ $option->id }}, 'option')">
                                <i class="fa-solid fa-trash-can text-red-500 hover:text-red-700"></i>
                            </button>

                            <span class="text-gray-400">
                                {{ $option->name }}
                            </span>
                        </div>

                        <div class="flex flex-wrap mb-4">
                            @foreach ($option->features as $feature)
                                @switch($option->type)
                                    @case(1)
                                        <span class="bg-gray-100 text-gray-800 text-xs font-medium me-2 pl-2.5 pr-1.5 py-0.5 rounded-sm dark:bg-gray-700 dark:text-gray-300">
                                            {{ $feature->description }}

                                            <button class="ml-1"
                                                onclick="confirmDelete({{ $feature->id }}, 'feature')">
                                                <i class="fa-solid fa-xmark hover:text-red-500"></i>
                                                </i>
                                            </button>
                                        </span>
                                        @break
                                    @case(2)
                                        <div class="relative">
                                            <span class="inline-block h-6 w-6 shadow-lg rounded-full border-2 border-gray-700 mr-4" style="background-color: {{ $feature->value }};">

                                            <button class="absolute z-10 left-3 -top-2 rounded-full bg-gray-500 h-4 w-4 flex justify-center items-center">
                                                <i class="fa-solid fa-xmark it text-xs text-gray-300 hover:text-red-500"
                                                    onclick="confirmDelete({{ $feature->id }}, 'feature')"></i>
                                            </button>
                                        </span>
                                        </div>
                                        @break
                                    @default
                                        
                                @endswitch

                            @endforeach
                        </div>

                        <div>
                            @livewire('admin.options.add-new-feature', ['option' => $option], key('add-new-feature-'.$option->id))
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <x-dialog-modal wire:model="newOption.openModal">
        <x-slot name="title">
            Crear nueva opción
        </x-slot>
        
        <x-slot name="content">
            <x-validation-errors class="mb-4" />
            <div class="grid grid-cols-2 gap-6 mb-4">
                <div>
                    <x-label class="mb-2">
                        Nombre
                    </x-label>
                    <x-input 
                        wire:model="newOption.name"
                        class="w-full" 
                        placeholder="Por ejemplo: Tamaño, Color"/>
                </div>

                <div>
                    <x-label class="mb-2">
                        Tipo
                    </x-label>

                    <x-select 
                        wire:model.live="newOption.type"
                        class="w-full">
                        <option value="1">Texto</option>
                        <option value="2">Color</option>

                    </x-select>
                </div>
            </div>

            <div class="flex items-center mb-4">
                <hr class="flex-1">
                <span class="mx-4 ">
                    Valores
                </span>
                <hr class="flex-1">
            </div>

            <div class="mb-4 space-y-4">
                @foreach ($newOption->features as $index => $feature)
                    <div class="p-6 rounded-lg border border-gray-700 relative"
                        wire:key="feature-{{ $index }}">
                        <div class="absolute -top-3 px-4 dark:bg-gray-800">
                            <button wire:click="removeFeature({{ $index }})">
                                <i class="fas fa-trash text-red-500 hover:text-red-700"></i>
                            </button>
                        </div>
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <x-label class="mb-2">
                                    Valor
                                </x-label>
                               

                                @switch($newOption->type)
                                    @case(1)
                                        <x-input 
                                            wire:model="newOption.features.{{ $index }}.value"
                                            class="w-full" 
                                            placeholder="Ingrese el valor de la opción."/>
                                        @break
                                    @case(2)
                                        <div class="border border-gray-700 rounded-md h-12 flex items-center justify-between px-3">
                                            {{ $newOption->features[$index]['value'] ?: 'Seleccione un color' }}
                                           <x-input 
                                            wire:model.live="newOption.features.{{ $index }}.value"
                                            type="color"
                                            />

                                        </div>
                                        
                                        
                                        @break
                                    @default
                                        
                                @endswitch
                            </div>

                            <div>
                                <x-label class="mb-2">
                                    Descripción
                                </x-label>
                                <x-input 
                                    wire:model="newOption.features.{{ $index }}.description"
                                    class="w-full" 
                                    placeholder="Ingrese la descripción de la opción."/>
                            </div>

                        </div>
                    </div>

                @endforeach
            </div>    

            <div class="flex justify-end">
                <x-button 
                    wire:click="addFeature"
                >
                    Agregar valor
                </x-button>
            </div>
        </x-slot>

        <x-slot name="footer">
            <button 
                class="btn btn-green"
                wire:click="addOption">
                Crear opción 
            </button>
        </x-slot>
    </x-dialog-modal>

    @push('js')
        <script>
            function confirmDelete(id, type){
                Swal.fire({
                  title: "¿Estás seguro?",
                  text: "¡No podrás revertir esto!",
                  icon: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#3085d6",
                  cancelButtonColor: "#d33",
                  confirmButtonText: "Si, bórralo!",
                  cancelButtonText: "Cancelar"
                }).then((result) => {
                  if (result.isConfirmed){
                    switch(type){
                        case 'feature':
                            @this.call('deleteFeature', id);
                        break;
                        case 'option':
                            @this.call('deleteOption', id);
                        break;
                    }
                  }
                
                });
            }
        </script>
    @endpush
</div>
 