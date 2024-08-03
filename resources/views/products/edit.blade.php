<x-layout>
    <x-slot:heading>
        product
    </x-slot:heading>
    <h1 class="text-2xl font-bold mb-6">This is a product editor</h1>
    <!--
  This example requires some changes to your config:


// tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/forms'),
    ],
  }

-->
    {{-- <form action="/products/test" method="POST" enctype="multipart/form-data" id="uploadForm"> --}}
        <form action="/products/{{ $product->id }}" method="POST" enctype="multipart/form-data" id="uploadForm">

        {{-- <form action="/products" method="POST" enctype="multipart/form-data"> --}}

        @csrf
        @method('PUT')

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Profile</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">This information will be displayed publicly so be careful
                    what you share.</p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                        <div class="mt-2">
                            <div
                                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                <span
                                    class="flex select-none items-center pl-3 text-gray-500 sm:text-sm">spotlady_sh/</span>
                                <input type="text" name="name" id="name" autocomplete="name"
                                    value="{{ $product->name }}"
                                    class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                    placeholder="silk shirt">
                            </div>
                            @error('name')
                                <p class="text-xs text-red-500 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="category_id"
                            class="block text-sm font-medium leading-6 text-gray-900">Category</label>
                        <div class="mt-2">
                            <select id="category_id" name="category_id" autocomplete="category_id"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">

                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('category_id')
                                <p class="text-xs text-red-500 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="description"
                            class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                        <div class="mt-2">
                            <textarea id="description" name="description" rows="3"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 pl-3"></textarea>
                        </div>
                        <p class="mt-3 text-sm leading-6 text-gray-600">Write a description.</p>
                    </div>


                    <div class="sm:col-span-4">
                        <label for="price" class="block text-sm font-medium leading-6 text-gray-900">Price</label>
                        <div class="mt-2">
                            <div
                                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                {{-- <span class="flex select-none items-center pl-3 text-gray-500 sm:text-sm">spotlady_sh/</span> --}}
                                <input type="text" name="price" id="price" autocomplete="price"
                                    value="{{ $product->price }}"
                                    class="block flex-1 border-0 bg-transparent py-1.5 pl-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                    placeholder="100 $">
                            </div>
                            @error('price')
                                <p class="text-xs text-red-500 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="col-span-full">
                        <fieldset>
                            <legend class="text-sm font-semibold leading-6 text-gray-900">Tags</legend>
                            <div class="mt-6 flex flex-wrap gap-4">
                                @foreach ($tags as $tag)
                                    <div class="relative flex gap-x-3">
                                        <div class="flex h-6 items-center">
                                            <input id="tag-{{ $tag->id }}" name="tags[]" type="checkbox"
                                                value="{{ $tag->id }}"
                                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600"
                                                @if (in_array($tag->id, $product->tags->pluck('id')->toArray())) checked @endif>
                                        </div>
                                        <div class="text-sm leading-6">
                                            <label for="tag-{{ $tag->id }}"
                                                class="font-medium text-gray-900">{{ $tag->name }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @error('tags')
                                <p class="text-xs text-red-500 font-semibold">{{ $message }}</p>
                            @enderror
                        </fieldset>
                    </div>
                </div>
            </div>

            <form id="uploadForm" action="/products/test" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <section class="h-full p-8 w-full flex flex-col">
                    <h1 class="pt-8 block text-sm font-medium leading-6 text-gray-900">
                        Previously added
                    </h1>
                    <ul id="gallery-before" class="flex flex-1 flex-wrap -m-1 mt-2">
                        <li id="empty-before"
                            class="h-full w-full text-center flex flex-col justify-center items-center">
                            <img class="mx-auto w-32"
                                src="https://user-images.githubusercontent.com/507615/54591670-ac0a0180-4a65-11e9-846c-e55ffce0fe7b.png"
                                alt="no data" />
                            <span class="text-small text-gray-500">No files uploaded</span>
                        </li>
                    </ul>
                </section>

                <section class="h-full p-8 w-full flex flex-col">
                    <h1 class="pt-8 block text-sm font-medium leading-6 text-gray-900">
                        To upload
                    </h1>
                    <header
                        class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                        <div class="text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor"
                                aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                <label id="button" for="file-upload"
                                    class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                    <span>Upload a file</span>
                                    <input id="imageUpload" type="file" name="images-after[]" multiple accept="image/*"
                                        class="hidden">
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
                        </div>
                    </header>

                    <ul id="gallery-after" class="flex flex-1 flex-wrap m-1">
                        <li id="empty-after"
                            class="h-full w-full text-center flex flex-col justify-center items-center">
                            <img class="mx-auto w-32"
                                src="https://user-images.githubusercontent.com/507615/54591670-ac0a0180-4a65-11e9-846c-e55ffce0fe7b.png"
                                alt="no data" />
                            <span class="text-small text-gray-500">No files selected</span>
                        </li>
                    </ul>
                </section>
                <button type="submit" id="submitBtn"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>

            </form>

            <template id="image-template-before">
                <li class="block p-1 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6 xl:w-1/8 h-24">
                    <article tabindex="0"
                        class="image-card group hasImage w-full h-full rounded-md focus:outline-none focus:shadow-outline bg-gray-100 cursor-pointer relative text-transparent hover:text-white shadow-sm">
                        <img alt="upload preview"
                            class="img-preview w-full h-full sticky object-cover rounded-md bg-fixed" />
                        <input type="checkbox" name="images-before[]" class="image-checkbox" hidden unchecked>
                        <section
                            class="flex flex-col rounded-md text-xs break-words w-full h-full z-20 absolute top-0 py-2 px-3">
                            <h1 class="flex-1"></h1>
                            <div class="flex">
                                <span class="p-1">
                                    <i>
                                        <svg class="fill-current w-4 h-4 ml-auto pt-"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M5 8.5c0-.828.672-1.5 1.5-1.5s1.5.672 1.5 1.5c0 .829-.672 1.5-1.5 1.5s-1.5-.671-1.5-1.5zm9 .5l-2.519 4-2.481-1.96-4 5.96h14l-5-8zm8-4v14h-20v-14h20zm2-2h-24v18h24v-18z" />
                                        </svg>
                                    </i>
                                </span>
                                <p class="p-1 size text-xs"></p>
                                <a
                                    class="delete-btn-before delete ml-auto focus:outline-none bg-red-500 hover:bg-gray-300 p-1 rounded-md">
                                    <svg class="pointer-events-none fill-current w-4 h-4 ml-auto"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <path class="pointer-events-none"
                                            d="M3 6l3 18h12l3-18h-18zm19-4v2h-20v-2h5.711c.9 0 1.631-1.099 1.631-2h5.316c0 .901.73 2 1.631 2h5.711z" />
                                    </svg>
                                </a>
                            </div>
                        </section>
                    </article>
                </li>
            </template>

            <template id="image-template-after">
                <li class="block p-1 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6 xl:w-1/8 h-24">
                    <article tabindex="0"
                        class="image-card group hasImage w-full h-full rounded-md focus:outline-none focus:shadow-outline bg-gray-100 cursor-pointer relative text-transparent hover:text-white shadow-sm">
                        <img alt="upload preview"
                            class="img-preview w-full h-full sticky object-cover rounded-md bg-fixed" />
                        <section
                            class="flex flex-col rounded-md text-xs break-words w-full h-full z-20 absolute top-0 py-2 px-3">
                            <h1 class="flex-1"></h1>
                            <div class="flex">
                                <span class="p-1">
                                    <i>
                                        <svg class="fill-current w-4 h-4 ml-auto pt-"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M5 8.5c0-.828.672-1.5 1.5-1.5s1.5.672 1.5 1.5c0 .829-.672 1.5-1.5 1.5s-1.5-.671-1.5-1.5zm9 .5l-2.519 4-2.481-1.96-4 5.96h14l-5-8zm8-4v14h-20v-14h20zm2-2h-24v18h24v-18z" />
                                        </svg>
                                    </i>
                                </span>
                                <p class="p-1 size text-xs"></p>
                                <a class="delete-btn-after delete ml-auto focus:outline-none p-1 rounded-md bg-red-500"
                                    onmouseover="hoverEffect(true)" onmouseout="hoverEffect(false)">
                                    <svg class="pointer-events-none fill-current w-4 h-4 ml-auto"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <path class="pointer-events-none"
                                            d="M3 6l3 18h12l3-18h-18zm19-4v2h-20v-2h5.711c.9 0 1.631-1.099 1.631-2h5.316c0 .901.73 2 1.631 2h5.711z" />
                                    </svg>
                                </a>
                            </div>
                        </section>
                    </article>
                </li>
            </template>

            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const imageUpload = document.getElementById('imageUpload');
                    const galleryBefore = document.getElementById('gallery-before');
                    const galleryAfter = document.getElementById('gallery-after');

                    const imageTemplateBefore = document.getElementById('image-template-before').content;
                    const imageTemplateAfter = document.getElementById('image-template-after').content;

                    const button = document.getElementById('button');
                    const emptyBefore = document.getElementById("empty-before");
                    const emptyAfter = document.getElementById("empty-after");

                    button.addEventListener('click', () => imageUpload.click());
                    imageUpload.addEventListener('change', handleFileSelect);
                    galleryAfter.addEventListener('click', handleGalleryAfterClick);
                    galleryBefore.addEventListener('click', handleGalleryBeforeClick);

                    fetchImages(`products/` + {{$product->id}} + `/images`);


                    async function fetchImages(url) {
                        try {
                            const response = await fetch("../../" + url);
                            const images = await response.json();
                            if (images.length) {
                                emptyBefore.classList.add("hidden");
                                images.forEach(async image => {
                                    try {
                                        const imageResponse = await fetch("../../storage/" + image.url);
                                        const blob = await imageResponse.blob();
                                        const fileName = image.url.split('/').pop().split('?')[0];
                                        const file = new File([blob], fileName, {
                                            type: blob.type
                                        });
                                        addImageToGallery(file, image.id, true, galleryBefore);
                                    } catch (error) {
                                        console.error('Błąd podczas pobierania zdjęcia:', error);
                                    }
                                });
                            }
                        } catch (error) {
                            console.error('Błąd podczas pobierania zdjęć:', error);
                        }
                    }







                    function handleFileSelect(event) {
                        const files = event.target.files;
                        if (files.length) {
                            emptyAfter.classList.add("hidden");
                            while (galleryAfter.firstChild) {
                                galleryAfter.removeChild(galleryAfter.firstChild);
                            }
                            Array.from(files).forEach(addFileToGallery);
                        } else {
                            emptyAfter.classList.remove("hidden");
                        }
                    }

                    function addFileToGallery(file) {
                        if (!file.type.match('image.*')) {
                            alert('Proszę wybrać plik graficzny.');
                            return;
                        }


                        addImageToGallery(file, null, false, galleryAfter);
                    }

                    function addImageToGallery(file, id, existing, targetGallery) {
                        const objectURL = URL.createObjectURL(file);






                        const clone = (targetGallery === galleryBefore) ?
                            imageTemplateBefore.cloneNode(true) :
                            imageTemplateAfter.cloneNode(true);

                        clone.querySelector("h1").textContent = file.name;
                        clone.querySelector("li").id = objectURL;
                        clone.querySelector(".delete").dataset.target = objectURL;
                        clone.querySelector(".size").textContent =
                            file.size > 1024 ?
                            file.size > 1048576 ?
                            Math.round(file.size / 1048576) + "mb" :
                            Math.round(file.size / 1024) + "kb" :
                            file.size + "b";


                        clone.querySelector('.img-preview').src = objectURL;
                        if (targetGallery === galleryBefore) {
                            const checkbox = clone.querySelector('.image-checkbox');
                            checkbox.value = id;
                            if (existing) {
                                checkbox.dataset.existing = true;
                            }
                            emptyBefore.classList.add("hidden");
                        } else {
                            emptyAfter.classList.add("hidden");
                        }
                        targetGallery.appendChild(clone);
                    }

                    function handleGalleryBeforeClick(event) {
                        if (event.target.classList.contains('delete-btn-before')) {
                            event.preventDefault();
                            const imageCard = event.target.closest('.image-card');
                            const checkbox = imageCard.querySelector('.image-checkbox');
                            checkbox.checked = !checkbox.checked;
                            // checkbox.value = checkbox.checked ? 'enabled' : 'disabled';
                            const selection = event.target.closest('.flex .flex-col');
                            if (selection.classList.contains('bg-red-500')) {
                                selection.classList.remove('bg-red-500');
                                selection.classList.remove('bg-opacity-50');
                            } else {
                                selection.classList.add('bg-red-500');
                                selection.classList.add('bg-opacity-50');
                            }
                        }
                    }

                    function handleGalleryAfterClick(event) {
                        if (event.target.classList.contains('delete-btn-after')) {
                            while (galleryAfter.firstChild) {
                                galleryAfter.removeChild(galleryAfter.firstChild);
                            }
                            imageUpload.value = null;
                            emptyAfter.classList.remove("hidden");
                        }
                    }
                });

                function hoverEffect(isHovered) {
                    const items = document.querySelectorAll('.delete-btn-after');
                    if (isHovered) {
                        items.forEach(item => {
                            item.classList.remove('bg-red-500');
                            item.classList.add('bg-gray-300');
                        });
                    } else {
                        items.forEach(item => {
                            item.classList.remove('bg-gray-300');
                            item.classList.add('bg-red-300');
                        });
                    }
                };
            </script>


            <style>
                body {
                    font-family: Arial, sans-serif;
                    align-items: center;
                }

                #uploadForm {
                    margin-bottom: 20px;
                }

                #gallery-before,
                #gallery-after {
                    display: flex;
                    flex-wrap: wrap;
                    gap: 10px;
                }

                .image-card {
                    position: relative;
                    width: 150px;
                    height: 150px;
                    border: 2px solid #ccc;
                    border-radius: 10px;
                    overflow: hidden;
                }

                .img-preview {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                }

                .delete-btn-before,
                .delete-btn-after {
                    position: absolute;
                    bottom: 10px;
                    right: 10px;
                    padding: 5px;
                    color: white;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                }
            </style>

</x-layout>
