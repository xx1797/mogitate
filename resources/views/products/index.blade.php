<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品一覧</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    article {
      width: 100%;
      max-width: 300px;
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
      padding: 1rem;
      border: 1px solid #ccc;
      border-radius: 8px;
      overflow: hidden;
      background-color: #fff;
    }

    article img {
     object-fit: cover;
      width: 100%;
      height: 180px;
      border-radius: 6px;
    }

    article h3 {
      margin: 0.5rem 0 0.25rem;
    }

    article p {
      margin: 0.25rem 0;
      font-size: 0.9rem;
    }

    .grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 2rem;
    }

    @media (max-width: 900px) {
      .grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 600px) {
      .grid {
        grid-template-columns: 1fr;
      }
    }

  </style>

</head>
<body>

<nav class="container-fluid">
  <form method="GET" action="{{ route('products.index') }}" style="margin-bottom: 2rem; text-align: left; display: flex; flex-direction: column; gap: 1rem; max-width: 400px;">
    <input type="text" name="keyword" placeholder="商品名で検索" value="{{ request('keyword') }}">
    <button type="submit">検索</button>
    @if(request('keyword'))
      <p>「{{ request('keyword') }}」の検索結果</p>
    @endif
  </form>
  <form method="GET" action="{{ route('products.index') }}" text-align: left>
    <input type="hidden" name="keyword" value="{{ request('keyword') }}">
    <div style="display: flex; gap: 0.5rem;">
      <select name="sort" style="flex: 1;">
        <option value="">並び替えを選択</option>
        <option value="high" {{ request('sort') == 'high' ? 'selected' : '' }}>高い順</option>
        <option value="low" {{ request('sort') == 'low' ? 'selected' : '' }}>低い順</option>
      </select>
    </div>
    @if(request('sort'))
      <div style="margin-top: 1rem;">
        <span style="background: #ddd; padding: 4px 8px; border-radius: 4px;">
          並び順: {{ request('sort') === 'high' ? '価格が高い順' : '価格が低い順' }}
          <a href="{{ route('products.index', ['keyword' => request('keyword')]) }}" style="margin-left:8px; color:red; text-decoration:none;">×</a>
        </span>
      </div>
    @endif
  </form>
  <ul>
    <li><strong>商品一覧</strong></li>
  </ul>
  <ul>
    <li><a href="{{ route('products.create') }}">＋商品を追加</a></li>
  </ul>
</nav>

<main class="container">
  <div class="grid">
    @foreach($products as $product)
      <article>
        <a href="{{ route('products.show', $product->id) }}">
          <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
          <h3>{{ $product->name }}</h3>
        </a>
        <p>¥{{ number_format($product->price) }}</p>
        <p>{{ $product->description }}</p>
        <p>
          @foreach($product->seasons->unique('id') as $season)
            <span style="background:#eee;padding:2px 6px;margin:2px;border-radius:4px;">{{ $season->name }}</span>
          @endforeach
        </p>
        <a href="{{ route('products.edit', $product->id) }}" role="button">編集</a>
        <form method="POST" action="{{ route('products.destroy', $product->id) }}" style="display:inline;">
          @csrf
          @method('DELETE')
          <button type="submit" title="削除" style="color: red; background: none; border: none;">削除</button>
        </form>
      </article>
    @endforeach
  </div>

  <div>
    {{ $products->links() }}
  </div>
</main>

  <div>
    {{ $products->links() }}
  </div>
</main>

</body>
</html>
