<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(1);

        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'harga' => 'required|numeric',
            'foto' => 'required|image|mimes:jpeg,png,jpg'
        ]);

        $foto = $request->file('foto');
        $foto->storeAs('public', $foto->hashName());

        product::create([
            'nama' => $request->nama,
            'harga'=> $request->harga,
            'deskripsi'=> $request->deskripsi,
            'foto'=>$foto->hashName()
        ]);

        return redirect()->route('products.index')->with('success', 'add product success');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public  function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'nama' => 'required',
            'harga' => 'required|numeric',
        ]);

        $product->nama = $request->nama;
        $product->harga = $request->harga;
        $product->deskripsi = $request->deskripsi;

        if($request->file('foto'))
        {
            Storage::disk('local')->delete('public/', $product->foto);
            $foto = $request->file('foto');
             $foto->storeAs('public', $foto->hashName());
             $product->foto = $foto->hashName();
        }

        $product->update();

        return redirect()->route('products.index')->with('success', 'Update product success');
    }

    public function destroy($id)
{
    $product = Product::findOrFail($id);
    $product->delete();

    return redirect()->route('products.index')->with('success', 'Berhasil Menghapus Produk Cuy.');
}
}
