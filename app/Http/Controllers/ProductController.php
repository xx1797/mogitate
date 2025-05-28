<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Season;
use App\Models\Product;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function create()
    {
        $seasons = Season::all();
        return view('products.create', compact('seasons'));
    }

    public function store(ProductRequest $request)
    {
        // 画像アップロード処理
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/fruits-img', 'public');
        }

        $validated = $request->validated();

        $imagePath = $request->file('image')->store('images', 'public');
        
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        $product->seasons()->attach($request->seasons);

        return redirect()->route('products.index');
    }

    public function index(Request $request)
    {
        $query = Product::with('seasons');
        
        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        if ($request->sort === 'high') {
            $query->orderBy('price', 'desc');
        } elseif ($request->sort === 'low') {
            $query->orderBy('price', 'asc');
        }   

        $products = $query->paginate(6);

        return view('products.index', compact('products'));
    }

    public function edit(Product $product)
    {
        $seasons = Season::all();
        $selectedSeasons = $product->seasons->pluck('id')->toArray();

        return view('products.edit', compact('product', 'seasons', 'selectedSeasons'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        // 新しい画像があれば保存
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/fruits-img', 'public');
            $product->image = $path;
        }

        // 更新
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        // 中間テーブル更新
        $product->seasons()->sync($request->seasons);

        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {   
        $product->seasons()->detach(); // 中間テーブルも忘れず
        $product->delete();

        return redirect()->route('products.index');
    }

    public function show($id)
    {
        $product = Product::with('seasons')->findOrFail($id);
        return view('products.show', compact('product'));
    }
}
