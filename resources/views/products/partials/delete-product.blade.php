<form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin di apus?');">
    @csrf
    @method('DELETE')
    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-4 rounded flex items-center justify-between w-full">
        Hapus Produk
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m-7 0a2 2 0 012-2h4a2 2 0 012 2m-8 0h8" />
        </svg>
    </button>
</form>
