<div>
    <section class="rounded-lg border border-gray-600 bg-inherit shadow-lg">
        <header class="border-b border-gray-700 px-6 py-4">
                <div class="flex justify-between">
                    <h1 class="text-lg font-semibold text-gray-300">
                        Opciones
                    </h1>

                    <x-button wire:click="$set('openModal', true)">
                        Nuevo
                    </x-button>

                </div>
        </header>
           
        <div class="p-6">
            @if ($product->options->count())
                <div class="space-y-6">
                    @foreach ($product->options as $option)
                        <div wire:key="product-option-{{$option->id}}"
                            class="p-6 rounded-lg border border-gray-700 relative">
                            <div class="absolute -top-3 px-4 dark:bg-gray-800">
                                <button onclick="confirmDeleteOption({{ $option->id }})">
                                <i class="fa-solid fa-trash-can text-red-500 hover:text-red-600"></i>
                                </button>

                                <span class="ml-2 text-gray-400">
                                    {{ $option->name }}
                                </span>
                            </div>

                            <div class="flex flex-wrap">
                                @foreach ($option->pivot->features as $feature)
                                    <div wire:key="option-{{$option->id}}-feature-{{$feature['id']}}">
                                        @switch($option->type)
                                            @case(1)
                                                <span class="bg-gray-100 text-gray-800 text-xs font-medium me-2 pl-2.5 pr-1.5 py-0.5 rounded-sm dark:bg-gray-700 dark:text-gray-300">
                                                    {{ $feature['description'] }}

                                                    <button class="ml-1"
                                                        onclick="confirmDeleteFeature({{ $option->id }} ,{{ $feature['id'] }}, 'feature')">
                                                        <i class="fa-solid fa-xmark hover:text-red-500"></i>
                                                        </i>
                                                    </button>
                                                </span>
                                            @break
                                            @case(2)
                                                <div class="relative">
                                                    <span class="inline-block h-6 w-6 shadow-lg rounded-full border-2 border-gray-700 mr-4" style="background-color: {{ $feature['value'] }};">

                                                    <button class="absolute z-10 left-3 -top-2 rounded-full bg-gray-500 h-4 w-4 flex justify-center items-center">
                                                        <i class="fa-solid fa-xmark it text-xs text-gray-300 hover:text-red-500"
                                                            onclick="confirmDeleteFeature({{ $option->id }} ,{{ $feature['id'] }}, 'feature')"></i>
                                                    </button>
                                                    </span>
                                                </div>
                                            @break
                                            @default
                                                
                                        @endswitch
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

            @else
                <div class="bg-gray-700 border-t-4 border-gray-300 rounded-b text-gray-300 px-4 py-3 shadow-md" role="alert">
                  <div class="flex">
                    <div class="py-1"><svg class="fill-current h-6 w-6 text-gray-300 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0               0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                    <div>
                      <p class="font-bold">¡Atención!</p>
                      <p class="text-sm">Aún no hay opciones para este producto</p>
                    </div>
                  </div>
                </div>
            @endif
        </div>
    </section>


    @if ($product->variants->count())
        <section class="rounded-lg border border-gray-600 bg-inherit shadow-lg mt-12">
            <header class="border-b border-gray-700 px-6 py-4">
                    <div class="flex justify-between">
                        <h1 class="text-lg font-semibold text-gray-300">
                            Variantes
                        </h1>

                    </div>
            </header>
            
            <div class="p-6">
                <ul class="divide-y divide-gray-600 -my-4">
                    @foreach ($product->variants as $item)
                        <li class="py-4 flex items-center">
                            
                            <img src="{{$item->image}}" class="w-12 h-12 object-cover object-center">
                            <p class="divide-x divide-gray-600">
                                @foreach ($item->features as $feature)
                                    <span class="px-3 text-gray-400">
                                        {{$feature->description}}
                                    </span>
                                @endforeach
                            </p>

                            <a href="{{route('admin.products.variants', [$product, $item])}}" class="ml-auto btn btn-blue">
                                Editar
                            </a>
                        </li>
                    @endforeach
                </ul>

            </div>
        </section>
    @endif

    <x-dialog-modal wire:model="openModal">
        <x-slot name='title'>
            Agregar nueva opción
        </x-slot>

        <x-slot name='content'>
        <x-validation-errors class="mb-4" />
            <div class="mb-4">
                <x-label class="mb-1">
                    Opción
                </x-label>

                <x-select class="w-full" wire:model.live="variant.option_id">
                    <option value="" disabled>
                        Seleccione una opción
                    </option>
                    @foreach ($options as $option)
                        <option value="{{ $option->id }}">
                            {{ $option->name }}
                        </option>
                    @endforeach
                </x-select>

            </div>

            <div class="flex items-center mb-6">
                <hr class="flex-1">

                <span class="mx-4">
                    Valores
                </span>

                <hr class="flex-1">

            </div>

            <ul class="mb-4 space-y-4">
                @foreach ($variant['features'] as $index => $feature)
                    <li wire:key="variant-feature-{{ $index }}"
                        class="relative border border-gray-700 rounded-lg p-6">
                        <div class="absolute -top-3 dark:bg-gray-800 px-4">
                            <button wire:click="removeFeature({{ $index }})">
                                <i class="fa-solid fa-trash-can text-red-500 hover:text-red-700"></i>
                            </button>
                        </div>

                        

                        <div>
                            <x-label class="mb-1">
                                Valores
                            </x-label>

                            <x-select class="w-full" 
                                wire:model="variant.features.{{$index}}.id"
                                wire:change="featureChange({{$index}})">
                                <option value="" disabled selected>
                                    Seleccione un valor
                                </option>
                                @foreach ($this->features as $feature)
                                    <option value="{{ $feature->id }}">
                                        {{ $feature->description}}
                                    </option>
                                @endforeach
                            </x-select>
                        </div>

                    </li>
                @endforeach
            </ul>

            <div class="flex justify-end">
                <x-button wire:click="addFeature">
                    Agregar valor
                </x-button>
            </div>
        </x-slot>

        <x-slot name='footer'>
            <x-danger-button wire:click="$set('openModal', false)">
                Cancelar
            </x-danger-button>

            <x-button class="ml-2" wire:click="save">
                Guardar
            </x-button>
        </x-slot>
    </x-dialog-modal>

    @push('js')
        <script>
            function confirmDeleteFeature(option_id, feature_id){
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
                    @this.call('deleteFeature', option_id, feature_id);
                  }
                
                });
            }

            function confirmDeleteOption(option_id){
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
                    @this.call('deleteOption', option_id);
                  }
                
                });
            }
        </script>
    @endpush
</div>
