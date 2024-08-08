# VideoGallery

## Overview
VideoGallery is a PHP-based web application that provides a secure, password-protected gallery for displaying video content. It features Basic Authentication for access control, lazy loading of videos for improved performance, and support for both YouTube embeds and local video files. The entire application is contained in a single PHP script, making it easy to deploy and maintain.

## Installation

1. Clone the repository:
   ```
   git clone https://github.com/daishir0/VideoGallery.git
   ```
2. Navigate to the project directory:
   ```
   cd VideoGallery
   ```
3. Ensure you have PHP installed on your server (version 7.0 or higher recommended).
4. Configure your web server (e.g., Apache, Nginx) to serve the project directory.
5. Open the `index.php` file and modify the following lines to set your desired username and password:
   ```php
   $username = 'YOUR_USERNAME';
   $password = 'YOUR_PASSWORD';
   ```
6. Add your video content to the `$videos` array in `index.php`. See the Usage section for details on how to add videos.

## Usage

### Adding Videos
To add videos to your gallery, edit the `$videos` array in `index.php`. You can add both YouTube videos and local video files:

For YouTube videos:
```php
$videos[] = [
    'url' => 'https://www.youtube.com/embed/YOUR_VIDEO_ID',
    'description' => 'Your video description',
    'sort' => 1
];
```

For local video files:
```php
$videos[] = [
    'url' => 'path/to/your/video.mp4',
    'description' => 'Your local video description',
    'sort' => 2
];
```

The 'sort' value determines the display order of videos (higher numbers appear first).

### Video Placement
- For YouTube videos, you only need to provide the video ID in the URL.
- For local videos, place your video files in a directory within your project (e.g., 'videos/') and use the relative path in the 'url' field.

### Accessing the Gallery
1. Access the application through your web browser.
2. When prompted, enter the username and password you set in the installation step.
3. Browse through the video gallery. Videos will load as you scroll down the page.
4. Click on a video thumbnail to play the video.

## Notes

- The entire application is contained in a single PHP script (`index.php`), making it extremely portable and easy to deploy. You can simply copy this file to any PHP-enabled web server to run the application.
- Ensure that your server is configured to handle PHP files.
- For security reasons, keep your username and password confidential and use strong credentials.
- The application uses lazy loading to improve performance with many videos. Ensure JavaScript is enabled in the browser for the best experience.
- Make sure your web server is configured to serve video files if you're using local videos.
- The 'sort' value in the `$videos` array determines the display order of videos (higher numbers appear first).

## License

This project is licensed under the MIT License - see the LICENSE file for details.

---

# VideoGallery

## 概要
VideoGalleryは、動画コンテンツを表示するためのセキュアなパスワード保護ギャラリーを提供するPHPベースのウェブアプリケーションです。アクセス制御のための基本認証、パフォーマンス向上のための動画の遅延読み込み、YouTubeの埋め込みとローカル動画ファイルの両方のサポートを特徴としています。アプリケーション全体が1つのPHPスクリプトに含まれており、デプロイと保守が容易です。

## インストール方法

1. リポジトリをクローンします：
   ```
   git clone https://github.com/daishir0/VideoGallery.git
   ```
2. プロジェクトディレクトリに移動します：
   ```
   cd VideoGallery
   ```
3. サーバーにPHPがインストールされていることを確認します（バージョン7.0以上推奨）。
4. ウェブサーバー（Apache、Nginxなど）を設定して、プロジェクトディレクトリを提供するようにします。
5. `index.php`ファイルを開き、以下の行を変更して希望のユーザー名とパスワードを設定します：
   ```php
   $username = 'YOUR_USERNAME';
   $password = 'YOUR_PASSWORD';
   ```
6. `index.php`の`$videos`配列に動画コンテンツを追加します。動画の追加方法の詳細については、使い方セクションを参照してください。

## 使い方

### 動画の追加
ギャラリーに動画を追加するには、`index.php`の`$videos`配列を編集します。YouTubeの動画とローカルの動画ファイルの両方を追加できます：

YouTubeの動画の場合：
```php
$videos[] = [
    'url' => 'https://www.youtube.com/embed/YOUR_VIDEO_ID',
    'description' => 'あなたの動画の説明',
    'sort' => 1
];
```

ローカルの動画ファイルの場合：
```php
$videos[] = [
    'url' => 'path/to/your/video.mp4',
    'description' => 'あなたのローカル動画の説明',
    'sort' => 2
];
```

'sort'値は動画の表示順序を決定します（大きい数字が先に表示されます）。

### 動画の配置
- YouTubeの動画の場合、URLに動画IDのみを提供する必要があります。
- ローカルの動画の場合、プロジェクト内のディレクトリ（例：'videos/'）に動画ファイルを配置し、'url'フィールドに相対パスを使用します。

### ギャラリーへのアクセス
1. ウェブブラウザからアプリケーションにアクセスします。
2. プロンプトが表示されたら、インストール手順で設定したユーザー名とパスワードを入力します。
3. 動画ギャラリーを閲覧します。ページをスクロールすると動画が読み込まれます。
4. 動画のサムネイルをクリックして再生します。

## 注意点

- アプリケーション全体が1つのPHPスクリプト（`index.php`）に含まれているため、非常に移植性が高く、デプロイが容易です。このファイルをPHPが有効なWebサーバーにコピーするだけでアプリケーションを実行できます。
- サーバーがPHPファイルを処理するように設定されていることを確認してください。
- セキュリティ上の理由から、ユーザー名とパスワードは機密情報として扱い、強力な認証情報を使用してください。
- このアプリケーションは多数の動画でのパフォーマンス向上のために遅延読み込みを使用しています。最良の体験を得るには、ブラウザでJavaScriptを有効にしてください。
- ローカルの動画を使用する場合は、Webサーバーが動画ファイルを提供するように設定されていることを確認してください。
- `$videos`配列の'sort'値は動画の表示順序を決定します（大きい数字が先に表示されます）。

## ライセンス

このプロジェクトはMITライセンスの下でライセンスされています。詳細はLICENSEファイルを参照してください。
