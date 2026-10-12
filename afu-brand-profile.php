<?php
/** Plugin Name: afu Brand Profile Downloads; Version: 1.0.0 */
if (!defined('ABSPATH')) { exit; }
add_action('init', function () {
    $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
    $routes = ['/brand-profile'=>['brand-profile.html','text/html; charset=utf-8',false], '/brand-profile/'=>['brand-profile.html','text/html; charset=utf-8',false], '/brand-profile.pdf'=>['afu-brand-profile.pdf','application/pdf',true], '/brand-profile.md'=>['afu-brand-profile.md','text/markdown; charset=utf-8',true], '/brand-profile.json'=>['afu-brand-profile.json','application/json; charset=utf-8',false]];
    if (!isset($routes[$path])) { return; }
    if (!in_array($_SERVER['REQUEST_METHOD'] ?? 'GET', ['GET','HEAD'], true)) { status_header(405); header('Allow: GET, HEAD'); exit; }
    [$name,$mime,$download] = $routes[$path];
    $file = WP_CONTENT_DIR . '/uploads/afu-brand-profile/20261012-v1/' . $name;
    if (!is_file($file)) { status_header(503); exit; }
    status_header(200); header('Content-Type: ' . $mime); header('X-Content-Type-Options: nosniff'); header('Cache-Control: public, max-age=300');
    if ($download) { header('Content-Disposition: attachment; filename="' . $name . '"'); }
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
