<?php
/** Plugin Name: afu Brand Profile Downloads; Version: 1.0.0 */
if (!defined('ABSPATH')) { exit; }
add_action('init', function () {
    $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
    $routes = ['/brand-profile'=>['brand-profile.html','text/html; charset=utf-8',false], '/brand-profile/'=>['brand-profile.html','text/html; charset=utf-8',false], '/brand-profile.pdf'=>['afu-brand-profile.pdf','application/pdf',true], '/brand-profile.md'=>['afu-brand-profile.md','text/markdown; charset=utf-8',true], '/brand-profile.json'=>['afu-brand-profile.json','application/json; charset=utf-8',false]];

    $routes['/brand-media-kit.zip'] = ['media/afu-media-kit.zip','application/zip',true];
    $routes['/brand-media/photos/media-01.jpg'] = ['media/photos/media-01.jpg','image/jpeg',true];
    $routes['/brand-media/previews/media-01.jpg'] = ['media/previews/media-01.jpg','image/jpeg',false];
    $routes['/brand-media/photos/media-02.jpg'] = ['media/photos/media-02.jpg','image/jpeg',true];
    $routes['/brand-media/previews/media-02.jpg'] = ['media/previews/media-02.jpg','image/jpeg',false];
    $routes['/brand-media/photos/media-03.jpg'] = ['media/photos/media-03.jpg','image/jpeg',true];
    $routes['/brand-media/previews/media-03.jpg'] = ['media/previews/media-03.jpg','image/jpeg',false];
    $routes['/brand-media/photos/media-04.jpg'] = ['media/photos/media-04.jpg','image/jpeg',true];
    $routes['/brand-media/previews/media-04.jpg'] = ['media/previews/media-04.jpg','image/jpeg',false];
    $routes['/brand-media/photos/media-05.jpg'] = ['media/photos/media-05.jpg','image/jpeg',true];
    $routes['/brand-media/previews/media-05.jpg'] = ['media/previews/media-05.jpg','image/jpeg',false];
    $routes['/brand-media/photos/media-06.jpg'] = ['media/photos/media-06.jpg','image/jpeg',true];
    $routes['/brand-media/previews/media-06.jpg'] = ['media/previews/media-06.jpg','image/jpeg',false];
    $routes['/brand-media/photos/media-07.jpg'] = ['media/photos/media-07.jpg','image/jpeg',true];
    $routes['/brand-media/previews/media-07.jpg'] = ['media/previews/media-07.jpg','image/jpeg',false];
    $routes['/brand-media/photos/media-08.jpg'] = ['media/photos/media-08.jpg','image/jpeg',true];
    $routes['/brand-media/previews/media-08.jpg'] = ['media/previews/media-08.jpg','image/jpeg',false];
    $routes['/brand-media/photos/P04-001.jpg'] = ['media/photos/P04-001.jpg','image/jpeg',true];
    $routes['/brand-media/previews/P04-001.jpg'] = ['media/previews/P04-001.jpg','image/jpeg',false];
    $routes['/brand-media/photos/P05-011.jpg'] = ['media/photos/P05-011.jpg','image/jpeg',true];
    $routes['/brand-media/previews/P05-011.jpg'] = ['media/previews/P05-011.jpg','image/jpeg',false];
    $routes['/brand-media/photos/P07-126.jpg'] = ['media/photos/P07-126.jpg','image/jpeg',true];
    $routes['/brand-media/previews/P07-126.jpg'] = ['media/previews/P07-126.jpg','image/jpeg',false];
    $routes['/brand-media/photos/P08-010.jpg'] = ['media/photos/P08-010.jpg','image/jpeg',true];
    $routes['/brand-media/previews/P08-010.jpg'] = ['media/previews/P08-010.jpg','image/jpeg',false];
    $routes['/brand-media/photos/P11-029.jpg'] = ['media/photos/P11-029.jpg','image/jpeg',true];
    $routes['/brand-media/previews/P11-029.jpg'] = ['media/previews/P11-029.jpg','image/jpeg',false];
    if (!isset($routes[$path])) { return; }
    if (!in_array($_SERVER['REQUEST_METHOD'] ?? 'GET', ['GET','HEAD'], true)) { status_header(405); header('Allow: GET, HEAD'); exit; }
    [$name,$mime,$download] = $routes[$path];
    $file = WP_CONTENT_DIR . '/uploads/afu-brand-profile/20261012-v1/' . $name;
    if (!is_file($file)) { status_header(503); exit; }
    status_header(200); header('Content-Type: ' . $mime); header('X-Content-Type-Options: nosniff'); header('Cache-Control: public, max-age=300');
    if ($download) { header('Content-Disposition: attachment; filename="' . basename($name) . '"'); }
    header('Content-Length: ' . filesize($file));
    if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'HEAD') { readfile($file); }
    exit;
}, 0);
add_action('template_redirect', function () {
    if (!is_single(5347) || is_feed() || is_preview()) { return; }
    ob_start(function ($html) {
        $cta = '<section aria-label="福哥品牌介紹下載" style="padding:18px 22px;margin:22px 0;background:#edf4ef;border:1px solid #d7e1d9;border-radius:4px"><strong>合作、邀課或採訪？先下載福哥品牌介紹。</strong><p style="margin:10px 0"><a href="/brand-profile.pdf" download>下載兩頁 PDF ↓</a>　<a href="/brand-profile.md" download>下載 Markdown ↓</a>　<a href="/brand-profile">看自介與合作資料 →</a></p></section>';
        return preg_replace('/(<h1\b[^>]*>.*?<\/h1>)/s', '$1' . $cta, $html, 1);
    });
}, 20);

add_action('init', function () {
    if (parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) !== '/llms.txt') { return; }
    ob_start(function ($text) {
        return "# 王永福｜福哥：官方品牌資料與下載入口\n\n- 品牌介紹：https://afu.tw/brand-profile\n- 結構化品牌卡：https://afu.tw/brand-profile.json\n- PDF：https://afu.tw/brand-profile.pdf\n- Markdown：https://afu.tw/brand-profile.md\n\n讓專業被看見：百大企業推薦講師－簡報、教學與 AI 實務的教練。\n簡報與教學教練・資訊管理博士・《簡報的技術》《教學的技術》《遊戲化教學的技術》等系列書作者。\n\n品牌資料版本20261012-v2；編輯自介非逐字引文。變動數字與合作細節請向Ariel確認。文章查詢改由afu.tw/ai-library讀取目前官網公開內容，品牌卡版本與公開目錄版本分開管理。\n\n" . $text;
    });
}, -1);
