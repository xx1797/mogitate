mogitate
このアプリケーションは、商品の管理を行うためのシンプルなWebアプリケーションです。商品の一覧表示、詳細表示、および関連する季節情報の管理が可能です。

環境構築
前提条件
Dockerがインストールされていること

Docker Composeがインストールされていること

Gitがインストールされていること

構築手順
リポジトリのクローン:

git clone https://https://github.com/xx1797/mogitate.git
cd mogitate

.envファイルの作成:
.env.exampleをコピーして.envファイルを作成し、必要に応じてデータベース接続情報などを設定します。

cp .env.example .env

（Laravel Sailを使用している場合、通常はデフォルト設定で動作します。別途データベースを設定する場合は、DB_CONNECTION, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORDを設定してください。）

Dockerコンテナのビルドと起動:

docker-compose up -d --build

（Laravel Sailを使用している場合は ./vendor/bin/sail up -d）

Composer依存関係のインストール:

docker-compose exec app composer install

（Laravel Sailを使用している場合は ./vendor/bin/sail composer install）

マイグレーションの実行:
データベーステーブルを作成します。

docker-compose exec app php artisan migrate:fresh --seed

（--seedオプションは、DatabaseSeeder.phpに記述されたシーダーを同時に実行し、ダミーデータを投入します。Laravel Sailを使用している場合は ./vendor/bin/sail artisan migrate:fresh --seed）

ストレージリンクの作成:
公開可能なストレージシンボリックリンクを作成します。（画像アップロード機能などがある場合）

docker-compose exec app php artisan storage:link

（Laravel Sailを使用している場合は ./vendor/bin/sail artisan storage:link）

トラブルシューティング（任意）
キャッシュクリア: docker-compose exec app php artisan optimize:clear

フロントエンドのビルド (もし必要であれば):

docker-compose exec app npm install
docker-compose exec app npm run dev

（Laravel Sailを使用している場合は ./vendor/bin/sail npm install と ./vendor/bin/sail npm run dev）

使用技術 (実行環境)
Laravel 10.x (PHP 8.2)

Docker

Docker Compose

MySQL 8.0

ER図
URL
開発環境: http://localhost/
