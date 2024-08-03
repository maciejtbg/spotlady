<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use App\Models\User;
use App\Models\Image;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/users/{name}', function ($name) {
    // Znajdź użytkownika po nazwie
    $user = User::where('name', $name)->first();

    // Sprawdź, czy użytkownik został znaleziony
    if (!$user) {
        abort(404, 'User not found'); // Opcjonalnie obsłuż błąd 404
    }

    // Zwróć widok z użytkownikiem
    return view('users.show', ['user' => $user]);
});

Route::get('/products', function () {
    // $products = Product::latest()->simplePaginate(8);
    $products = Product::orderBy('updated_at', 'desc')->simplePaginate(8);
    return view('products.index' , ['products'=> $products]);
});

Route::get('/products/create', function () {
    $categories = Category::all();
    $tags = Tag::all();
    return view('products.create', compact('categories','tags'));
});

Route::get('/products/upload', function () {
    return view('products.upload');
});


Route::post('/products', function () {

    $validatedData = request()->validate([
        'name' => 'required|max:200|min:3',
        'price' => 'required|numeric',
        'category_id' => 'required|filled|present',
        'tags' => 'array',
        'tags.*' => 'exists:tags,id',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:10240'
    ]);

    // return request();

    $product = Product::create([
        'name'=> request('name'),
        'category_id' => request('category_id'),
        'description' => request('description'),
        'price'=> request('price')
    ]);

        // Przetwarzanie obrazów
        if (request()->hasFile('images')) {
            foreach (request()->file('images') as $image) {
                $path = $image->store('images', 'public');
                Image::create([
                    'product_id' => $product->id,
                    // 'product_id' => 1,

                    'url' => $path,
                ]);
            }
        }

    if (isset($validatedData['tags'])) {
        $product->tags()->attach($validatedData['tags']);
    }
    echo (request());

    return redirect('products');
});

Route::get('/products/{id}', function ($id) {
    $product = Product::with('images')->findOrFail($id);

    return view('products.show', compact('product'));

});

Route::get('/products/{id}/images', function ($id) {
    $product = Product::findOrFail($id);
    $images = $product->images()->get(['id', 'url']); // Pobierz id i url obrazów
    return response()->json($images);

});

Route::get('/products/{id}/edit', function ($id) {
    $product = Product::with('images')->findOrFail($id);
    $categories = Category::all();
    $tags = Tag::all();
    return view('products.edit', compact('product','categories','tags'));
});


Route::put('/products/{id}', function ($id) {
    $product = Product::findOrFail($id);

    $validatedData = request()->validate([
        'name' => 'required|max:200|min:3',
        'description' => 'max:1000',
        'price' => 'required|numeric',
        'category_id' => 'required|exists:categories,id',
        'tags' => 'array',
        'tags.*' => 'exists:tags,id',
        'images-after.*' => 'image|mimes:jpeg,png,jpg,gif|max:10240'
    ]);

    // Update product details
    $product->update([
        'name' => $validatedData['name'],
        'description' => $validatedData['description'],
        'price' => $validatedData['price'],
        'category_id' => $validatedData['category_id'],
    ]);

    // Remove unwanted images
    if (isset($validatedData['tags'])) {
        $product->tags()->sync($validatedData['tags']);
    }
    $images_before = request()->input('images-before', []);
    if (!empty($images_before)){
        foreach ($images_before as $image) {
            $image = Image::findOrFail($image);
            $image->delete();
        }

    }



    // Add new images
    if (request()->hasFile('images-after')) {
        foreach (request()->file('images-after') as $image) {
            // Store the image
            $url = $image->store('images', 'public');

            // Create a new Image record
            $product->images()->create([
                'url' => $url
            ]);
        }
    }
    return redirect('products');
});


Route::delete('/products/{id}', function ($id) {
    $product = Product::findOrFail($id);

    $product->delete();

    return redirect('/products');
});

Route::get('/payments', function () {
    return view('payments');
});
