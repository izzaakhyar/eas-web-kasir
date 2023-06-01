<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $products = Product::where('name', 'LIKE', '%' .$request->search. '%')->paginate(8);
        } else {
            $products = Product::simplePaginate(8);
        }
        
        // all();
        return view('listProduct', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add()
    {
        return view('create');
    }
    public function create(Request $request)
    {
        // Validasi request, jika diperlukan
    
    if ($request->hasFile('image_url')) {
        // $imagePath = $request->file('image_url')->store('storage/products');
        // $image_url = basename($imagePath);
        $image = $request->file('image_url');
        $imageName = $image->getClientOriginalName();
        $imagePath = $image->move('storage/products', $imageName);
        $image_url = basename($imagePath);
    } else {
        $imageName = null; // Atau Anda bisa menetapkan nilai default untuk gambar jika tidak ada yang diunggah
    }
    
    // Simpan data ke database
    DB::table('products')->insert([
        'name' => $request->name,
        'price' => $request-> price,
        'stock' => $request->stock,
        'description' => $request->description,
        'image_url' => $image_url, // Kolom untuk menyimpan nama gambar
    ]);

    //$imageUrl = Storage::url('products/' . $image_url);
    
    // Redirect atau tindakan lain setelah upload berhasil
    
    return redirect('/list');
    }

    public function edit(string $id)
    {
        $products = \App\Models\Product::find($id);
        return view('edit', compact('products'));
    }

    public function update(Request $request, $id)
    {
        $products = \App\Models\Product::find($id);
        $products->update($request->all());
        return redirect('/list')->with('sukses','Data berhasil diupdate');
    }

    public function delete($id){
        $products = \App\Models\Product::find($id);
        $products->delete($products);
        return redirect('/list')->with('sukses','Data berhasil dihapus');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = DB::table('products')->find($id);
    
    // Menggunakan Storage::url() untuk mendapatkan URL gambar
    

    return view('listProduct', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    

    /**
     * Update the specified resource in storage.
     */
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
