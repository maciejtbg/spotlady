<x-layout>
    <x-slot:heading>
        products
    </x-slot:heading>
    <h1 class="text-2xl font-bold mb-6">These are all our products</h1>

    <!--
  This example requires some changes to your config:

  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/aspect-ratio'),
    ],
  }
  ```
-->
<div class="bg-white">
    <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
      <h2 class="text-2xl font-bold tracking-tight text-gray-900">Customers also purchased</h2>


        <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
            @foreach ($products as $product)

            <div class="group relative p-2 shadow-xl rounded-md">
              <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80">
                @if($product->images->isNotEmpty())
                <img src="{{ Storage::url($product->images->first()->url) }}" alt="{{ $product->name }}" class="h-full w-full object-cover object-center lg:h-full lg:w-full">
            @else
                <img src="{{ asset('\images\default-image.jpg') }}" alt="Default image" class="h-full w-full object-cover object-center lg:h-full lg:w-full">
            @endif              </div>
              <div class="mt-4 flex justify-between">
                <div>
                  <h3 class="text-sm text-gray-700">
                        <a href="/products/{{ $product->id }}">

                      <span aria-hidden="true" class="absolute inset-0"></span>
                      {{ $product->name }}
                    </a>
                  </h3>
                  {{-- <p class="mt-1 text-sm text-gray-500">{{ $product->tags->name }}</p> --}}
                </div>
                <p class="text-sm font-medium text-gray-900">${{ number_format($product->price, 2) }}</p>
              </div>
            </div>
        @endforeach
      </div>
    </div>
  </div>



{{--
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($products as $product)
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            @if ($product->images)
                @php
                    $images = json_decode($product->images);
                @endphp
                @if (count($images) > 0)
                    <img src="{{ $images[0] }}" alt="product Image" class="w-full h-48 object-cover">
                @endif
            @endif
            <div class="p-4">
                <a href="/products/{{ $product->id }}" class="text-blue-600 hover:text-red-500">
                    <h2 class="text-lg font-semibold">{{ $product->title }}</h2>
                </a>
                <div class="flex items-center justify-between mt-4">
                    <p class="text-gray-700 mt-2">${{ number_format($product->price, 2) }}</p>
                    <button class="text-gray-500 hover:text-red-500 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 530 530" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6">
                            <g>
                                <path d="M256 455.516c-7.29 0-14.316-2.641-19.793-7.438-20.684-18.086-40.625-35.082-58.219-50.074l-.09-.078c-51.582-43.957-96.125-81.918-127.117-119.313C16.137 236.81 0 197.172 0 153.871c0-42.07 14.426-80.883 40.617-109.293C67.121 15.832 103.488 0 143.031 0c29.555 0 56.621 9.344 80.446 27.77C235.5 37.07 246.398 48.453 256 61.73c9.605-13.277 20.5-24.66 32.527-33.96C312.352 9.344 339.418 0 368.973 0c39.539 0 75.91 15.832 102.414 44.578C497.578 72.988 512 111.801 512 153.871c0 43.3-16.133 82.938-50.777 124.738-30.993 37.399-75.532 75.356-127.106 119.309-17.625 15.016-37.597 32.039-58.328 50.168a30.046 30.046 0 0 1-19.789 7.43zM143.031 29.992c-31.066 0-59.605 12.399-80.367 34.914-21.07 22.856-32.676 54.45-32.676 88.965 0 36.418 13.535 68.988 43.883 105.606 29.332 35.394 72.961 72.574 123.477 115.625l.093.078c17.66 15.05 37.68 32.113 58.516 50.332 20.961-18.254 41.012-35.344 58.707-50.418 50.512-43.051 94.137-80.223 123.469-115.617 30.344-36.618 43.879-69.188 43.879-105.606 0-34.516-11.606-66.11-32.676-88.965-20.758-22.515-49.3-34.914-80.363-34.914-22.758 0-43.653 7.235-62.102 21.5-16.441 12.719-27.894 28.797-34.61 40.047-3.452 5.785-9.53 9.238-16.261 9.238s-12.809-3.453-16.262-9.238c-6.71-11.25-18.164-27.328-34.61-40.047-18.448-14.265-39.343-21.5-62.097-21.5zm0 0" fill="#000000" opacity="1" data-original="#000000" class="">
                                    </path>
                                </g>
                            </svg>
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div> --}}
    <div class="my-8">
        {{$products->links()}}
    </div>
</x-layout>
