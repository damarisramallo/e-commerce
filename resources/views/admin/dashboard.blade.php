<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ]
]">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-slate-700 rounded-lg shadow-xl p-6" >
            <div class="flex items-center">
                <img class="size-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                <div class="ml-4 flex-1">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                        Bienvenida, {{ auth()->user()->name }}
                    </h2>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-300 dark:hover:text-blue-500">
                            Cerrar sesión
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="bg-slate-700 rounded-lg shadow-xl p-6 flex items-center justify-center" >
            <h2 class="text-xl font-semibold dark:text-gray-200">
                "Nombre de la empresa"
            </h2>
        </div>
    

    </div>
</x-admin-layout>