<x-app-layout>
    @push('css')
        <link
          rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css"
        />
    @endpush

  
    <div class="swiper mb-12">
   
      <div class="swiper-wrapper">
  
        @foreach ($covers as $cover)
            <div class="swiper-slide">
                <img src="{{$cover->image}}" class="w-full aspect-[3/1] object-cover object-center">
            </div>

        @endforeach
        
      </div>
      
      <div class="swiper-pagination"></div>


      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>

    </div>

    <x-container>
        <h1 class="text-2xl font-bold text-gray-500 mb-4">
            Ultimos productos
        </h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($lastProducts as $product)
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
    </x-container>

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>

        <script>
            const swiper = new Swiper('.swiper', {
              // Optional parameters
              loop: true,
              autoplay: {
                delay: 6000, 
                disableOnInteraction: false,
              },

              // If we need pagination
              pagination: {
                el: '.swiper-pagination',
              },
          
              // Navigation arrows
              navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
              },
          
            });
        </script>
    @endpush
</x-app-layout>