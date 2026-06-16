@if (count($breadcrumbs))
    <nav class="mb-4">
        <ol class="flex flex-wrap items-center">
            @foreach ($breadcrumbs as $item)
                <li class="text-sm font-medium leading-normal text-gray-500 dark:text-gray-400 px-2">
                    
                    @isset($item['route'])
                        <a href="{{ $item['route'] }}" class="opacity-50">
                            {{ $item['name'] }}
                        </a>

                    @else
                        <span class="opacity-50">
                            {{ $item['name'] }}
                        </span>
                    @endisset
                </li> 
                @if (count($breadcrumbs) > 1)
                    <li class="text-sm font-medium leading-normal text-gray-500 dark:text-gray-400 px-2">
                        /
                    </li>
                @endif
                    
            @endforeach

            
        </ol>
        @if (count($breadcrumbs) > 1)
            <h6 class="text-sm font-medium leading-normal text-gray-500 dark:text-gray-400 px-2">
                {{ end($breadcrumbs)['name'] }}
            </h6>
        @endif
    </nav>
@endif

    