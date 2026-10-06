<?php
$canonicalUrl = 'https://any2convert.com' . rtrim(request()->getPathInfo(), '/');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    @include('partials.site-theme')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if (request()->is('highlights/*') || request()->has('noindex')): ?>
    <meta name="robots" content="noindex, follow">
    <?php else: ?>
    <meta name="robots" content="index, follow">
    <?php endif; ?>
    <link rel="canonical" href="<?= $canonicalUrl ?>">
    <link rel="alternate" href="<?= $canonicalUrl ?>" hreflang="en">
    <link rel="alternate" href="<?= $canonicalUrl ?>" hreflang="x-default">
    <title>{{ $title }}</title>
    <meta name="description" content="{{ $description ?? '' }}">
    <meta name="keywords" content="{{ $keywords ?? '' }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16.png') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    @include('partials.tailwind-assets')
    <style>
        html { font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; background:#f8f8fc; color:#111118; }
        body { margin:0; padding:0; }
        a { color:#6C63FF; text-decoration:none; }
        .page-shell { max-width:900px; margin:0 auto; padding:36px 20px; }
        .page-card { background:#fff; border:1px solid rgba(15,23,42,0.08); border-radius:24px; padding:32px; box-shadow:0 24px 60px rgba(15,23,42,0.08); }
        .page-title { margin:0 0 16px; font-size:2rem; line-height:1.1; }
        .page-subtitle { margin:0 0 20px; font-size:1.1rem; line-height:1.5; font-weight:600; color:#334155; }
        .page-content p { margin:0 0 18px; line-height:1.8; color:#475569; }
    </style>
    <!-- Microsoft Clarity -->
    <script type="text/javascript">
        (function(c,l,a,r,i,t,y){
            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
        })(window, document, "clarity", "script", "xymcprs44h");
    </script>
</head>
<body class="info-page">
    @include('partials.site-navbar')
    <div class="page-shell">

        <article class="page-card">
            <h1 class="page-title">{{ $headline ?? $title }}</h1>
            <h2 class="page-subtitle">{{ $subtitle ?? $description ?? 'Free online tools from Any2Convert.' }}</h2>
            <div class="page-content">{!! $content ?? '<p>Welcome to Any2Convert.</p>' !!}</div>
        </article>
    </div>
    @include('partials.site-footer')
</body>
</html>
