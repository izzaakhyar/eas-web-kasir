<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Game;
use App\Models\User;
use Auth;
use Alert;

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
            // $products = Product::orderBy('name', 'asc')->simplePaginate(8);
        }

        $carts = Cart::with('product')
            ->where('user_id', auth()->id())
            ->where('checkout', 0) // Hanya ambil produk dengan nilai checkout = 0
            ->get();
        $totalProducts = $carts->where('checkout', 0)->count();
        
        $user_id = auth()->id();

        $gameCount = Game::where('user_id', $user_id)
            ->groupBy('product_id')
            ->selectRaw('count(*) as count')
            ->get()
            ->count();
        $totalUsers =Game::groupBy('user_id')
        ->selectRaw('count(*) as count')
        ->get()
        ->count();
        // all();

        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('listProduct', compact('products', 'totalProducts', 'gameCount', 'totalUsers'));
    }

    public function totalProduct() {
        $carts = Cart::with('product')
            ->where('user_id', auth()->id())
            ->where('checkout', 0) // Hanya ambil produk dengan nilai checkout = 0
            ->get();
        $totalProducts = $carts->where('checkout', 0)->count();

        return view('layouts.navbar', compact('totalProducts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add()
    {
        $carts = Cart::with('product')
            ->where('user_id', auth()->id())
            ->where('checkout', 0) // Hanya ambil produk dengan nilai checkout = 0
            ->get();
        $totalProducts = $carts->where('checkout', 0)->count();

        return view('create', compact('totalProducts'));
    }
    public function create(Request $request)
    {
        // Validasi request, jika diperlukan
    
        if ($request->hasFile('image_url')) {
            // $imagePath = $request->file('image_url')->store('storage/products');
            // $image_url = basename($imagePath);
            $image = $request->file('image_url');
            $imageName = $image->getClientOriginalName();
            $imagePath = $image->move('produk', $imageName);
            $image_url = basename($imagePath);
        } if ($request->hasFile('portrait_cover')) {
            // $imagePath = $request->file('image_url')->store('storage/products');
            // $image_url = basename($imagePath);
            $imagePortrait = $request->file('portrait_cover');
            $imageNamePortrait = $imagePortrait->getClientOriginalName();
            $imagePathPortrait = $imagePortrait->move('produk', $imageNamePortrait);
            $image_portrait = basename($imagePathPortrait);
        } else {
            $imageName = null; // Atau Anda bisa menetapkan nilai default untuk gambar jika tidak ada yang diunggah
        }

        
        
        // Simpan data ke database
        DB::table('products')->insert([
            'name' => $request->name,
            'price' => $request-> price,
            'description' => $request->description,
            'image_url' => $image_url,
            'portrait_cover' => $image_portrait, // Kolom untuk menyimpan nama gambar
        ]);

        //$imageUrl = Storage::url('products/' . $image_url);
        
        // Redirect atau tindakan lain setelah upload berhasil
        $message = "Game berhasil ditambahkan";
        Alert::success('Success', $message);
        return redirect('/list');
    }

    public function edit(string $id)
    {
        $products = Product::find($id);
        $carts = Cart::with('product')
            ->where('user_id', auth()->id())
            ->where('checkout', 0) // Hanya ambil produk dengan nilai checkout = 0
            ->get();
        $totalProducts = $carts->where('checkout', 0)->count();
        $gameCount = Game::where('user_id', auth()->id())->count();
        return view('edit', compact('products', 'totalProducts', 'gameCount'));
    }

    public function update(Request $request, $id)
    {
        $products = \App\Models\Product::find($id);
        if ($request->hasFile('image_url')) {
            $image = $request->file('image_url');
            $imageName = $image->getClientOriginalName();
            $imagePath = $image->move(public_path('produk'), $imageName);
            $image_url = basename($imagePath);
            $products->image_url = $image_url;
        } if ($request->hasFile('portrait_cover')) {
            $image = $request->file('portrait_cover');
            $imageName = $image->getClientOriginalName();
            $imagePath = $image->move(public_path('produk'), $imageName);
            $image_url = basename($imagePath);
            $products->portrait_cover = $image_url;
        }
        $products->update($request->except('image_url', 'portrait_cover'));
        // $products->update($request->all());
        $message = "Game berhasil diupdate";
        Alert::success('Success', $message);
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
