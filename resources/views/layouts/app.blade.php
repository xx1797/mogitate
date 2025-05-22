<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>商品管理</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
</head>
<body>

  <nav class="container-fluid">
    <ul><li><strong>商品管理</strong></li></ul>
    <ul>
      <li><strong><a href="{{ route('products.index') }}">商品一覧</a></strong></li>
    </ul>
    <ul>
      <li><a href="{{ route('products.create') }}">＋商品を追加</a></li>
    </ul>
  </nav>

  <main class="container" style="padding-top: 2rem;">
    @yield('content')
  </main>

</body>
</html>
