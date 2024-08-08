<?php
// Basic認証の設定
$username = 'YOUR_USERNAME';
$password = 'YOUR_PASSWORD';

if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) ||
    $_SERVER['PHP_AUTH_USER'] !== $username || $_SERVER['PHP_AUTH_PW'] !== $password) {
    header('WWW-Authenticate: Basic realm="Restricted Area"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'アクセスが拒否されました。';
    exit;
}

// 動画コンテンツの配列
$videos = [
    [
        'url' => 'https://www.youtube.com/embed/YOUR_VIDEO_ID',
        'description' => '',
        'sort' => 01
    ],
    // 追加の動画をここに記述
    // [
    //     'url' => 'https://www.youtube.com/embed/ANOTHER_VIDEO_ID',
    //     'description' => '別の動画の説明文をここに記入してください。',
    //     'sort' => 0
    // ],
];

// sortキーに基づいて降順にソート
usort($videos, function($a, $b) {
    return $b['sort'] - $a['sort'];
});

// HTMLの出力
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Noto Sans JP', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            font-size: 2.5rem;
            color: #2c3e50;
            text-align: center;
            margin-bottom: 30px;
        }
        p {
            font-size: 1.1rem;
            margin-bottom: 20px;
        }
        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            max-width: 100%;
            background: #000;
            margin-bottom: 20px;
        }
        .video-container.lazy {
            background-image: url('data:image/svg+xml;charset=utf-8,<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14.5v-9l6 4.5-6 4.5z" fill="%23999"/></svg>');
            background-repeat: no-repeat;
            background-position: center;
            background-size: 64px 64px;
            cursor: pointer;
        }
        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        .video-container video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        @media (max-width: 600px) {
            h1 {
                font-size: 2rem;
            }
            p {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Movie</h1>
        <p>過去の動画の列挙です</p>
        
        <?php foreach ($videos as $index => $video): ?>
        <div class="video-container lazy" data-src="<?php echo htmlspecialchars($video['url']); ?>">
            <?php if (strpos($video['url'], 'youtube.com') !== false): ?>
                <img src="data:image/svg+xml;charset=utf-8,<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'><path d='M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14.5v-9l6 4.5-6 4.5z' fill='%23999'/></svg>" alt="Play video" class="play-button">
            <?php else: ?>
                <video width="100%" height="auto" controls>
                    <source src="<?php echo htmlspecialchars($video['url']); ?>" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            <?php endif; ?>
        </div>
        <p><?php echo htmlspecialchars($video['description']); ?></p>
        <?php endforeach; ?>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var lazyVideos = [].slice.call(document.querySelectorAll('.video-container.lazy'));

        if ('IntersectionObserver' in window) {
            var lazyVideoObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(video) {
                    if (video.isIntersecting) {
                        var src = video.target.dataset.src;
                        if (src.indexOf('youtube.com') !== -1) {
                            video.target.innerHTML = '<iframe src="' + src + '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                        } else {
                            // ローカルビデオの場合は何もしない（既にvideoタグが挿入されているため）
                        }
                        video.target.classList.remove('lazy');
                        lazyVideoObserver.unobserve(video.target);
                    }
                });
            });

            lazyVideos.forEach(function(lazyVideo) {
                lazyVideoObserver.observe(lazyVideo);
            });
        } else {
            // Fallback for browsers that don't support IntersectionObserver
            lazyVideos.forEach(function(lazyVideo) {
                var src = lazyVideo.dataset.src;
                if (src.indexOf('youtube.com') !== -1) {
                    lazyVideo.innerHTML = '<iframe src="' + src + '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                } else {
                    // ローカルビデオの場合は何もしない（既にvideoタグが挿入されているため）
                }
                lazyVideo.classList.remove('lazy');
            });
        }
    });
    </script>
</body>
</html>