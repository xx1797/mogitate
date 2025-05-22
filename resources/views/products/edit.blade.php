<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>商品編集</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
@extends('layouts.app')

@section('content')
<main class="container" style="max-width: 700px; margin: 2rem auto;">
  <hgroup>
    <h2>商品編集</h2>
    <h3>商品の情報を修正してください</h3>
  </hgroup>

  <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div style="margin-bottom: 1.5rem;">
      <label for="name">商品名</label>
      <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required style="width: 100%;">
      @error('name') <small style="color:red;">{{ $message }}</small> @enderror
    </div>

    <div style="margin-bottom: 1.5rem;">
      <label for="price">価格</label>
      <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" required style="width: 100%;">
      @error('price') <small style="color:red;">{{ $message }}</small> @enderror
    </div>

    <div style="margin-bottom: 1.5rem;">
      <label for="description">説明</label>
      <textarea id="description" name="description" rows="4" required style="width: 100%;">{{ old('description', $product->description) }}</textarea>
      @error('description') <small style="color:red;">{{ $message }}</small> @enderror
    </div>

    <div style="margin-bottom: 1.5rem;">
      <label for="seasons">季節（複数選択可）</label>
      <select name="seasons[]" id="seasons" multiple required style="width: 100%;">
        @foreach($seasons as $season)
          <option value="{{ $season->id }}" {{ in_array($season->id, old('seasons', $product->seasons->pluck('id')->toArray())) ? 'selected' : '' }}>
            {{ $season->name }}
          </option>
        @endforeach
      </select>
      @error('seasons') <small style="color:red;">{{ $message }}</small> @enderror
    </div>

    <div style="margin-bottom: 1.5rem;">
      <label for="image">商品画像（再登録も可能）</label>
      <input type="file" id="image" name="image" accept="image/png, image/jpeg">
      @error('image') <small style="color:red;">{{ $message }}</small> @enderror

      @if ($product->image)
        <div style="margin-top: 1rem;">
          <p>現在の画像：</p>
          <img src="{{ asset('storage/' . $product->image) }}" alt="商品画像" style="max-width: 200px;">
        </div>
      @endif
    </div>

    <div style="display: flex; justify-content: space-between; align-items: center; gap: 1rem;">
      <a href="{{ route('products.index') }}" class="secondary">戻る</a>
      <div style="display: flex; gap: 1rem;">
        <form method="POST" action="{{ route('products.destroy', $product->id) }}">
          @csrf
          @method('DELETE')
          <button type="submit" style="background: crimson;" onclick="return confirm('本当に削除しますか？')">削除</button>
        </form>
        <button type="submit">変更を保存</button>
      </div>
    </div>
  </form>
</main>
@endsection
</body>
</html>
