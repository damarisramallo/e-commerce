<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Portadas',
        'route' => route('admin.covers.index'),

    ],
    [
        'name' => 'Nuevo'
    ]
]">

    <form action="{{route('admin.covers.store')}}" 
        method="POST"
        enctype="multipart/form-data">
        @csrf
        <x-validation-errors class="mb-4" />
        
        <figure class="mb-4 relative">
            <div class="absolute top-8 right-8">
                <label class="flex items-center px-4 py-2 rounded-lg bg-gray-500 cursor-pointer text-white">
                    <i class="fas fa-camera mr-2"></i>
                    Actualizar imagen
                    <input type="file" 
                        accept="image/*"
                        class="hidden"
                        name="image"
                        onchange="previewImage(event, '#imgPreview')">
                </label>
            </div>

            <img id="imgPreview" src="{{asset('img/no-image-horizontal.png')}}" alt="Portada" class="w-full aspect-[3/1] object-cover object-center rounded-lg">
        </figure>

        <div class="mb-4">
            <x-label>
                Nombre
            </x-label>

            <x-input 
                name="title"
                value="{{old('title')}}"
                class="w-full"
                placeholder="Ingrese el nombre de la portada"/>
        </div>

        <div class="mb-4">
            <x-label>
                Fecha de inicio
            </x-label>

            <x-input 
                type="date"
                name="start_at"
                value="{{old('start_at', now()->format('Y-m-d'))}}"
                class="w-full" />
        </div>

        <div class="mb-4">
            <x-label>
                Fecha de finalización (opcional)
            </x-label>

            <x-input 
                type="date"
                name="end_at"
                value="{{old('end_at')}}"
                class="w-full" />
        </div>

        <div class="mb-4 flex space-x-2">
            <label class="font-medium text-sm text-gray-700 dark:text-gray-300">
                <x-input 
                    type="radio"
                    name="is_active"
                    value="1" 
                    checked/>
                Activo
            </label>

            <label class="font-medium text-sm text-gray-700 dark:text-gray-300">
                <x-input 
                    type="radio"
                    name="is_active"
                    value="0" />
                Inactivo
            </label>

        </div>

        <div class="flex justify-end">
            <x-button>
                Guardar portada
            </x-button>
        </div>
    </form>

    @push('js')
        <script>
            function previewImage(event, querySelector){
            	let input = event.target;

            	let imgPreview = document.querySelector(querySelector);

            	if(!input.files.length) return

            	let file = input.files[0];

            	let objectURL = URL.createObjectURL(file);

            	imgPreview.src = objectURL;

            }
        </script>
    @endpush

</x-admin-layout>