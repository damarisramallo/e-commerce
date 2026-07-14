<div>
    <form wire:submit="addFeature"class="flex space-x-4">
        <div class="flex-1">
            <x-label class="mb-2">
                Valor
            </x-label>
            
            @switch($option->type)
                @case(1)
                    <x-input 
                        wire:model="newFeature.value"
                        class="w-full" 
                        placeholder="Ingrese el valor de la opción."/>
                    @break
                @case(2)
                    <div class="border border-gray-700 rounded-md h-12 flex items-center justify-between px-3 text-zinc-200">
                        {{ $newFeature['value'] ?: 'Seleccione un color' }}
                       <x-input 
                        wire:model.live="newFeature.value"
                        type="color"
                        />
                
                    </div>
                    @break
                @default
                    
            @endswitch
        </div>

        <div class="flex-1">
            <x-label class="mb-2">
                Descripción
            </x-label>
            <x-input 
                wire:model="newFeature.description"
                class="w-full" 
                placeholder="Ingrese la descripción de la opción."/>
        </div>

        <div class="pt-8">
            <x-button>
                Agregar

            </x-button>
        </div>

        

    </form>
</div>
