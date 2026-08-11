<div class="bg-white py-12">
    <x-container class="px-4 md:flex">
        @if (count($options))
            <aside class="md:w-52 md:flex-shrink-0 md:mr-8 mb-8 md:mb-0">
                <ul class="space-y-4">
                    @foreach($options as $option)
                        <li x-data="{
                            open: true
                        }">
                            <button class="px-4 py-2 bg-gray-200 w-full text-left text-gray-700 flex justify-between items-center" x-on:click="open = !open">    
                                {{ $option['name'] }}
                                <i class="fas fa-chevron-down ml-2" 
                                    x-bind:class="{
                                        'fa-chevron-down' : open,
                                        'fa-chevron-up' : !open,
                                    }"></i>
                            </button>

                            <ul class="mt-2 space-y-2" x-show="open">
                                @foreach($option['features'] as $feature)
                                    <li>
                                        <label 
                                            value="{{ $feature['id'] }}"
                                            wire:model.live="selected_features"
                                            class="inline-flex items-center">
                                            <input type="checkbox" class="rounded border-gray-400 text-indigo-600 shadow-sm focus:ring-indigo-500 mr-2">
                                            {{ $feature['description'] }}
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    
                    @endforeach
                </ul>
            </aside>
        @endif
            

        <div class="md:flex-1">
            <div class="flex items-center">
                <span class="mr-2">
                    Ordenar por:
                </span>

                <select class="'border-gray-300  focus:border-indigo-500 focus:ring-indigo-500  rounded-md shadow-sm'">
                    <option value="1">
                        Relevancia
                    </option>

                    <option value="2">
                        Precio: Mayor a menor
                    </option>

                    <option value="3">
                        Precio: Menor a mayor
                    </option>
                </select>
            </div>

            <hr class="my-4">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid:cols-4 gap-6">
                @foreach ($products as $product)
                  <article class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{$product->image}}" class="w-full h-48 object-cover object-center">
                    <div class="p-4">
                      <h2 class="text-lg font-bold text-gray-800 line-clamp-2 min-h-[56px] mb-2">{{$product->name}}</h2>
                      <p class="text-gray-600 mb-4">${{number_format($product->price, 2)}}</p>

                      <a href="" class="btn btn-dark-green block w-full text-center">Ver más</a>

                    </div>

                  </article>
                @endforeach

            </div>

            <div class="mt-8">
                {{ $products->links() }}
            </div>

            @dump($selected_features)
        </div>
    </x-container>
</div>
