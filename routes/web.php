<?php

use App\Http\Controllers\CategoryController;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\FamilyController;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome.index');

Route::get('families/{family}', [FamilyController::class, 'show'])->name('families.show');
Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Route::get('prueba', function () {
//     $product = Product::find(150);
//     $features =  $product->options->pluck('pivot.features');

//     $combinaciones = generarCombinaciones($features);

//     $product->variants()->delete();

//     foreach($combinaciones as $combinacion){
//         $variant = Variant::create([
//             'product_id' => $product->id,
//         ]);

//         $variant->features()->attach($combinacion);

        
//     }

//     return "Variantes creadas";
// });

