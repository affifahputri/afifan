<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-2">
        @if(session()->has('success'))
            <x-alert message="{{ session('success') }}"/>
        @endif

        <div class="flex mt-4 items-center justify-between">
            <h2 class="font-semibold text-xl">List Produk</h2>
            <button id="cartButton" class="bg-gray-100 px-10 py-2 rounded-md font-semibold relative">
                Lihat Keranjang <span id="cartNotification" class="hidden absolute top-0 right-0 bg-red-500 text-white text-xs px-2 py-1 rounded-full">0</span>
            </button>
        </div>

        <div class="grid md:grid-cols-3 grid-cols-1 gap-4 mt-4">
            @foreach($products as $product)
                <div>
                    <img src="{{ url('storage/'.$product->foto) }}" />
                    <div class="my-2">
                        <p class="text-xl font-light">{{ $product->nama }}</p>
                        <p class="font-semibold text-gray-400">Rp.{{ number_format($product->harga) }}</p>
                    </div>
                    <button class="add-to-cart bg-gray-100 px-10 py-2 rounded-md font-semibold" 
                        data-id="{{ $product->id }}" 
                        data-nama="{{ $product->nama }}" 
                        data-harga="{{ $product->harga }}"
                        data-foto="{{ url('storage/'.$product->foto) }}">Buy</button>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>

   <!-- Modal Keranjang -->
<div id="cartModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg w-80 md:w-96 p-6 relative max-h-96 overflow-auto">
        <button id="closeModal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">✖</button>
        <h3 class="text-lg font-semibold mb-4 text-center">Keranjang Anda</h3>
        <div class="max-h-64 overflow-y-auto">
            <ul id="cartItems" class="space-y-2">
                <!-- Barang dalam keranjang -->
            </ul>
        </div>
        
        <!-- Form Data Pelanggan -->
        <div class="mt-4">
            <input type="text" id="customerName" placeholder="Nama Anda" class="w-full px-4 py-2 border rounded-md mb-2" required>
            <input type="tel" id="customerPhone" placeholder="Nomor WhatsApp" class="w-full px-4 py-2 border rounded-md" required>
        </div>
        
        <button id="checkoutButton" class="bg-green-500 text-black px-10 py-2 rounded-md font-semibold mt-4 w-full hidden">
            Checkout via WhatsApp
        </button>
    </div>
</div>

<script>
    const cartNotification = document.getElementById('cartNotification');
    const cartButton = document.getElementById('cartButton');
    const cartModal = document.getElementById('cartModal');
    const closeModal = document.getElementById('closeModal');
    const cartItemsContainer = document.getElementById('cartItems');
    const checkoutButton = document.getElementById('checkoutButton');
    const customerNameInput = document.getElementById('customerName');
    const customerPhoneInput = document.getElementById('customerPhone');
    let cartItems = [];

    function updateCartNotification() {
        const totalQuantity = cartItems.reduce((sum, item) => sum + item.quantity, 0);
        if (totalQuantity > 0) {
            cartNotification.textContent = totalQuantity;
            cartNotification.classList.remove('hidden');
        } else {
            cartNotification.classList.add('hidden');
        }
    }

    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.dataset.id;
            const productName = this.dataset.nama;
            const productPrice = parseInt(this.dataset.harga);
            const productFoto = this.dataset.foto;
            const existingItem = cartItems.find(item => item.id === productId);
            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cartItems.push({ id: productId, name: productName, price: productPrice, quantity: 1, foto: productFoto });
            }
            updateCartNotification();
        });
    });

    cartButton.addEventListener('click', function () {
        cartModal.classList.remove('hidden');
        renderCart();
    });

    closeModal.addEventListener('click', function () {
        cartModal.classList.add('hidden');
    });

    function renderCart() {
        cartItemsContainer.innerHTML = '';
        if (cartItems.length === 0) {
            cartItemsContainer.innerHTML = '<li class="text-gray-700">Keranjang kosong.</li>';
            checkoutButton.classList.add('hidden');
            return;
        }
        checkoutButton.classList.remove('hidden');
        cartItems.forEach((item, index) => {
            const listItem = document.createElement('li');
            listItem.innerHTML = `<div class="flex items-center space-x-2">
                                    <img src="${item.foto}" class="w-12 h-12 rounded"/>
                                    <div>
                                        <p>${item.name} x${item.quantity}</p>
                                        <p>Rp. ${(item.price * item.quantity).toLocaleString()}</p>
                                    </div>
                                    <button class="add-item text-green-500 ml-2" data-index="${index}">➕</button>
                                    <button class="remove-item text-red-500 ml-2" data-index="${index}">➖</button>
                                  </div>`;
            cartItemsContainer.appendChild(listItem);
        });

        document.querySelectorAll('.add-item').forEach(button => {
            button.addEventListener('click', function () {
                const index = this.dataset.index;
                cartItems[index].quantity += 1;
                renderCart();
                updateCartNotification();
            });
        });

        document.querySelectorAll('.remove-item').forEach(button => {
            button.addEventListener('click', function () {
                const index = this.dataset.index;
                if (cartItems[index].quantity > 1) {
                    cartItems[index].quantity -= 1;
                } else {
                    cartItems.splice(index, 1);
                }
                renderCart();
                updateCartNotification();
            });
        });
    }
</script>
</x-app-layout>
