<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255|unique:products,name',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_popular' => 'nullable|boolean',
            // Simple validation for customizable option lists
            'colors' => 'nullable|array',
            'foam_colors' => 'nullable|array',
            'materials' => 'nullable|array',
            'sizes' => 'nullable|array',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // Structure customizable furniture options
        $customOptions = [
            'colors' => $this->formatColors($request->input('colors', []), $request->file('colors.image')),
            'foam_colors' => $this->formatColors($request->input('foam_colors', []), $request->file('foam_colors.image')),
            'materials' => $this->formatModifiers($request->input('materials', [])),
            'sizes' => $this->formatModifiers($request->input('sizes', []))
        ];

        Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imagePath,
            'is_popular' => $request->has('is_popular'),
            'custom_options' => $customOptions,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255|unique:products,name,' . $product->id,
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_popular' => 'nullable|boolean',
            'colors' => 'nullable|array',
            'foam_colors' => 'nullable|array',
            'materials' => 'nullable|array',
            'sizes' => 'nullable|array',
        ]);

        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $customOptions = [
            'colors' => $this->formatColors($request->input('colors', [])),
            'foam_colors' => $this->formatColors($request->input('foam_colors', [])),
            'materials' => $this->formatModifiers($request->input('materials', [])),
            'sizes' => $this->formatModifiers($request->input('sizes', []))
        ];

        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imagePath,
            'is_popular' => $request->has('is_popular'),
            'custom_options' => $customOptions,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }

    // Helper functions to format custom options
    private function formatColors($colors, $colorImages = null, $existingColors = [])
    {
        $formatted = [];
        if (!empty($colors['name'])) {
            $existingMap = [];
            foreach ($existingColors as $ec) {
                if (isset($ec['name'])) $existingMap[$ec['name']] = $ec;
            }

            foreach ($colors['name'] as $index => $name) {
                if (!empty($name)) {
                    $item = [
                        'name' => $name,
                        'value' => $colors['value'][$index] ?? '#000000'
                    ];

                    $imagePath = $existingMap[$name]['image'] ?? null;
                    
                    if ($colorImages && isset($colorImages[$index])) {
                        $file = $colorImages[$index];
                        if (isset($existingMap[$name]['image']) && !str_starts_with($existingMap[$name]['image'], 'http')) {
                            Storage::disk('public')->delete($existingMap[$name]['image']);
                        }
                        $imagePath = $file->store('products/colors', 'public');
                    }

                    if ($imagePath) {
                        $item['image'] = $imagePath;
                    }

                    $formatted[] = $item;
                }
            }
        }
        return $formatted;
    }

    private function formatModifiers($modifiers)
    {
        $formatted = [];
        if (!empty($modifiers['name'])) {
            foreach ($modifiers['name'] as $index => $name) {
                if (!empty($name)) {
                    $formatted[] = [
                        'name' => $name,
                        'price_modifier' => (float)($modifiers['price_modifier'][$index] ?? 0)
                    ];
                }
            }
        }
        return $formatted;
    }
}
