<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// 一括で7つのルート（index, create, store, show, edit, update, destroy）を生成
Route::resource('products', ProductController::class);

// トップページ
Route::get('/', function () {
    return redirect()->route('products.index');
});

