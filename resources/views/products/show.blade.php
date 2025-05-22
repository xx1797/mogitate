<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>商品詳細</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    @extends('layouts.app')

@section('content')
<main class="container" style="max-width: 700px; margin: 2rem auto;">
  <h2>{{ $product->name }}</h2>
  <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="max-width: 100%;">
  <p>価格: ¥{{ number_format($product->price) }}</p>
  <p>{{ $product->description }}</p>
  <p>
    季節:
    @foreach($product->seasons as $season)
      <span style="background:#eee;padding:2px 6px;margin:2px;border-radius:4px;">{{ $season->name }}</span>
    @endforeach
  </p>
  <a href="{{ route('products.edit', $product->id) }}" role="button">編集</a>
  <a href="{{ route('products.index') }}" class="secondary">戻る</a>
</main>
@endsection

</body>
</html>
