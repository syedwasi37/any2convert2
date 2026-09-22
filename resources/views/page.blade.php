<?php
$canonicalUrl = 'https://any2convert.com' . rtrim(request()->getPathInfo(), '/');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if (request()->has('topic') || request()->has('noindex')): ?>
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
    <link rel="icon" type="image/png" href="/mylogo.png">
    <style>
        html { font-family: 'DM Sans', sans-serif; background:#f8f8fc; color:#111118; }
        body { margin:0; padding:0; }
        a { color:#6C63FF; text-decoration:none; }
        .page-shell { max-width:900px; margin:0 auto; padding:36px 20px; }
        .page-card { background:#fff; border:1px solid rgba(15,23,42,0.08); border-radius:24px; padding:32px; box-shadow:0 24px 60px rgba(15,23,42,0.08); }
        .page-title { margin:0 0 16px; font-size:2rem; line-height:1.1; }
        .page-subtitle { margin:0 0 20px; font-size:1.1rem; line-height:1.5; font-weight:600; color:#334155; }
        .page-content p { margin:0 0 18px; line-height:1.8; color:#475569; }
        .page-seo { margin-top:24px; border-top:1px solid rgba(15,23,42,0.08); padding-top:22px; }
        .page-seo h3 { margin:0 0 12px; font-size:1.25rem; line-height:1.25; color:#111118; }
        .page-seo p { margin:0 0 14px; line-height:1.8; color:#475569; }
        .page-footer { margin-top:24px; font-size:0.92rem; color:#64748b; }
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
<body>
    <div class="page-shell">
        <header style="margin-bottom:24px; display:flex; align-items:center; justify-content:space-between; gap:12px;">
            <a href="/" style="font-weight:700; color:#111118; font-size:1rem;">Any2Convert</a>
            <nav style="display:flex; gap:14px; font-size:0.95rem; color:#475569;">
                <a href="/">Home</a>
                <a href="/blog">Blog</a>
                <a href="/privacy">Privacy</a>
                <a href="/terms">Terms</a>
            </nav>
        </header>

        <article class="page-card">
            <h1 class="page-title">{{ $headline ?? $title }}</h1>
            <h2 class="page-subtitle">{{ $subtitle ?? $description ?? 'Free online tools from Any2Convert.' }}</h2>
            <div class="page-content">{!! $content ?? '<p>Welcome to Any2Convert.</p>' !!}</div>
            <section class="page-seo">
                <h3>What this page covers</h3>
                <p>{{ $description ?? 'This Any2Convert page explains the available feature, policy, guide, or account option in plain language.' }}</p>
                <p>Any2Convert is a free online toolkit for PDF, document, image, calculator, converter, writing, business, and utility workflows. The site is designed to be fast to open, easy to use on desktop or mobile, and helpful when you need a practical browser-based tool without installing extra software.</p>
                <p>Where possible, Any2Convert favors local-first processing so common tasks can run in your browser. This keeps many files and inputs on your own device, reduces waiting on uploads, and gives you a simple place to complete everyday file and productivity tasks.</p>
                <p>Use this page as a quick reference for how Any2Convert approaches free access, privacy-aware workflows, browser compatibility, and practical file handling. The goal is to keep each page understandable for visitors while giving search engines enough context to identify the purpose of the page.</p>
                <p>For related work, return to the homepage to browse PDF tools, document converters, image utilities, calculators, writing helpers, developer utilities, and everyday productivity tools. Each tool page includes a focused description, expected use cases, and notes about how the browser-based workflow fits into the wider Any2Convert toolkit.</p>
            </section>
            <div class="page-footer">
                <p>Return to the <a href="/">Any2Convert homepage</a> anytime.</p>
            </div>
        </article>
    </div>
</body>
</html>
