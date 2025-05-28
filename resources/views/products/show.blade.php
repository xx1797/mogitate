<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>{{ $product->name }} - 詳細</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <main class="container">
    <h2>{{ $product->name }}</h2>
    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="max-width: 100%; height: auto;">
    <p>価格: ¥{{ number_format($product->price) }}</p>
    <p>{{ $product->description }}</p>
    <p>季節: 
      @foreach($product->seasons as $season)
        <span style="background:#eee;padding:2px 6px;margin:2px;border-radius:4px;">{{ $season->name }}</span>
      @endforeach
    </p>
    <div>
      <a href="{{ route('products.index') }}" role="button">一覧に戻る</a>
    </div>
  </main>
</body>
</html>
