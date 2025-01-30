<x-app-layout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-2">

            <div class="flex mt-4 items-center justify-between">
                <h2 class="font-semibold text-xl">Edit Produk</h2>
                @include('products.partials.delete-product', ['product' => $product])

            </div>

            <div class="mt-4" x-data="{imageUrl: '/storage/{{$product->foto}}'}">
                <form enctype="multipart/form-data" method="POST" action="{{ route('products.update', $product)}}">
                    @csrf
                    @method('PUT')

                    <div class="w-1/2">
                        <img :src="imageUrl" class="rounded-md">
                    </div>

                   <div class="w-1/2">

                   <div class="mt-4">
                        <x-input-label for="foto" :value="__('foto')" />
                        <x-text-input accept="image/*" id="foto" 
                        class="block mt-1 w-full border p-2" 
                        type="file" name="foto" 
                        :value="$product->foto" 
                        @change="imageUrl = URL.createObjectURL($event.target.files[0])"
                        />
                        <x-input-error :messages="$errors->get('foto')" class="mt-2" />
                    </div>

                   <div class="mt-4">
                        <x-input-label for="nama" :value="__('nama')" />
                        <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama" :value="$product->nama" required />
                        <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="harga" :value="__('harga')" />
                        <x-text-input id="harga" class="block mt-1 w-full" type="text" name="harga" :value="$product->harga"  x-mask:dynamic="$money($input, ',')" required />
                        <x-input-error :messages="$errors->get('harga')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="deskripsi" :value="__('deskripsi')" />
                        <textarea id="deskripsi" class="block mt-1 w-full" type="text" name="deskripsi">{{$product->deskripsi}}</textarea>
                        <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                    </div>

                    <x-primary-button class="justify-center w-full mt-4">
                {{ __('Submit') }}
                     </x-primary-button>
                   </div>

                </form>
            </div>

        </div>
</x-app-layout>
