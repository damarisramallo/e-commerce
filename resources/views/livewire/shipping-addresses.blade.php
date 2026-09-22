<div>
    <section class="bg-white rounded-lg shadow overflow-hidden">
        <header class="bg-gray-900 px-4 py-2">
            <h2 class="text-white text-lg">
                Direcciones de envío guardadas
            </h2>
        </header>

        <div class="p-4">
            @if ($newAddress)
                <x-validation-errors class="mb-4" />
                <div class="grid grid-cols-4 gap-4">
                    <div class="col-span-1">
                        <x-select-white wire:model="createAddress.type">
                            <option value="1">
                                Tipo de dirección
                            </option>

                            <option value="2">
                                Domicilio
                            </option>

                            <option value="3">
                                Domicilio de trabajo
                            </option>
                        </x-select-white>
                    </div>

                    <div class="col-span-3 ml-2">
                        <x-input-white
                            wire:model="createAddress.address" 
                            class="w-full" 
                            type="text"
                            placeholder="Dirección"  />
                    </div>

                    <div class="col-span-2">
                        <x-input-white
                            wire:model="createAddress.state" 
                            class="w-full" 
                            type="text"
                            placeholder="Provincia"  />
                    </div>

                    <div class="col-span-2">
                        <x-input-white
                            wire:model="createAddress.city" 
                            class="w-full" 
                            type="text"
                            placeholder="Ciudad"  />
                    </div>

                    <div class="col-span-2">
                        <x-input-white
                            wire:model="createAddress.reference" 
                            class="w-full" 
                            type="text"
                            placeholder="Referencia"  />
                    </div>
                </div>

                <hr class="my-4">

                <div x-data="{
                    receiver: @entangle('createAddress.receiver'),
                    receiver_info: @entangle('createAddress.receiver_info'),
                }" x-init="
                    $watch('receiver' , value => {
                        if(value == 1) {
                            receiver_info.name = '{{ auth()->user()->name }}';
                            receiver_info.last_name = '{{ auth()->user()->last_name }}';
                            receiver_info.document_type = '{{ auth()->user()->document }}';
                            receiver_info.document_number = '{{ auth()->user()->document_number }}';
                            receiver_info.phone = '{{ auth()->user()->phone }}';
                        } else {
                            receiver_info.name = '';
                            receiver_info.last_name = '';
                            receiver_info.document_number = '';
                            receiver_info.phone = '';
                        }
                    })
                ">
                    <p class="font-semibold mb-2">
                        ¿Quién recibirá el pedido?
                    </p>

                    <div class="flex space-x-2 mb-4">
                        <label class="flex items-center">
                            <input x-model="receiver" type="radio" value="1" class="mr-1" wire:model="createAddress.receiver" class="mr-2">
                            Seré yo
                        </label>

                        <label class="flex items-center">
                            <input x-model="receiver" type="radio" value="2" class="mr-1" wire:model="createAddress.receiver" class="mr-2">
                            Otra persona
                        </label>
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <x-input-white
                                x-bind:disabled="receiver == 1"
                                x-model="receiver_info.name"
                                class="w-full" 
                                type="text"
                                placeholder="Nombres"  />
                        </div>

                        <div>
                            <x-input-white
                                x-bind:disabled="receiver == 1"
                                x-model="receiver_info.last_name"
                                class="w-full"
                                type="text"
                                placeholder="Apellidos"  />
                        </div>

                        <div>
                            <div class="flex space-x-2">
                                <x-select-white x-model="receiver_info.document_type" class="w-1/2">
                                    @foreach (\App\Enums\TypeOfDocuments::cases() as $item)
                                        <option value="{{ $item->value }}">{{ $item->name }}</option>
                                    @endforeach
                                </x-select-white>

                                <x-input-white
                                    x-model="receiver_info.document_number"
                                    class="w-full" 
                                    type="text"
                                    placeholder="Número de documento"  />

                            </div>
                        </div>

                        <div>
                            <x-input-white
                                x-model="receiver_info.phone"
                                class="w-full" 
                                type="text"
                                placeholder="Teléfono"  />
                        </div>

                        <div>
                            <button class="btn btn-outline-gray w-full"
                                wire:click="$set('newAddress', false)">
                                Cancelar
                            </button>
                        </div>

                        <div>
                            <button 
                                wire:click="store"
                                class="btn btn-dark-green w-full">
                                Guardar
                            </button>
                        </div>
                    </div>
                </div>
            @else
                @if ($addresses->count())
                    
                @else
                    <p class="text-center text-gray-500 text-sm">
                        No se ha encontrado direcciones
                    </p>
                @endif

                <button class="btn btn-outline-gray w-full flex items-center justify-center mt-4"
                    wire:click="$set('newAddress', true)">
                    Agregar <i class="fa-solid fa-plus ml-2"></i> 
                </button>

            @endif
        </div>
    </section>
</div>
