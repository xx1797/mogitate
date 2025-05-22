<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>商品登録</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
@extends('layouts.app')

@section('content')
<main class="container" style="max-width: 700px; margin: 2rem auto;">
  <hgroup>
    <h2>商品登録</h2>
    <h3>新しい商品を登録してください</h3>
  </hgroup>

  <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
    @csrf

    <div style="margin-bottom: 1.5rem;">
      <label for="name">商品名</label>
      <input type="text" id="name" name="name" placeholder="商品名を入力" value="{{ old('name') }}" required style="width: 100%;">
      @error('name') <small style="color:red;">{{ $message }}</small> @enderror
    </div>

    <div style="margin-bottom: 1.5rem;">
      <label for="price">価格</label>
      <input type="number" id="price" name="price" placeholder="価格を入力" value="{{ old('price') }}" required style="width: 100%;">
      @error('price') <small style="color:red;">{{ $message }}</small> @enderror
    </div>

    <div style="margin-bottom: 1.5rem;">
      <label for="description">説明</label>
      <textarea id="description" name="description" placeholder="商品の説明を入力" rows="4" required style="width: 100%;">{{ old('description') }}</textarea>
      @error('description') <small style="color:red;">{{ $message }}</small> @enderror
    </div>

    <div style="margin-bottom: 1.5rem;">
      <label for="seasons">季節（複数選択可）</label>
      <select name="seasons[]" id="seasons" multiple required style="width: 100%;">
        @foreach($seasons as $season)
          <option value="{{ $season->id }}" {{ in_array($season->id, old('seasons', [])) ? 'selected' : '' }}>
            {{ $season->name }}
          </option>
        @endforeach
      </select>
      @error('seasons') <small style="color:red;">{{ $message }}</small> @enderror
    </div>

    <div style="margin-bottom: 1.5rem;">
      <label for="image">商品画像</label>
      <input type="file" id="image" name="image" accept="image/png, image/jpeg" required>
      @error('image') <small style="color:red;">{{ $message }}</small> @enderror
    </div>

    <div style="display: flex; justify-content: flex-end; gap: 1rem;">
      <a href="{{ route('products.index') }}" class="secondary">戻る</a>
      <button type="submit">登録</button>
    </div>
  </form>
</main>
@endsection
</body>
</html>
