<?php
$canonicalUrl = 'https://any2convert.com' . rtrim(request()->getPathInfo(), '/');
$blogSchema = [
    '@context' => 'https://schema.org',
    '@type' => 'BlogPosting',
    'headline' => $article['title'],
    'description' => $article['excerpt'],
    'url' => $canonicalUrl,
    'author' => [
        '@type' => 'Organization',
        'name' => $article['author'] ?? 'Any2Convert Team'
    ],
    'publisher' => [
        '@type' => 'Organization',
        'name' => 'Any2Convert',
        'logo' => [
            '@type' => 'ImageObject',
            'url' => 'https://any2convert.com/any2convertlogo.png'
        ]
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    @include('partials.site-theme')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-adsense-account" content="ca-pub-4031884874698168">
    <?php if (request()->has('topic') || request()->has('noindex')): ?>
    <meta name="robots" content="noindex, follow">
    <?php else: ?>
    <meta name="robots" content="index, follow">
    <?php endif; ?>
    <link rel="canonical" href="<?= $canonicalUrl ?>">
    <link rel="alternate" href="<?= $canonicalUrl ?>" hreflang="en">
    <link rel="alternate" href="<?= $canonicalUrl ?>" hreflang="x-default">
    <title>{{ $title }}</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16.png') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <meta name="description" content="{{ $description }}">
    <meta name="keywords" content="{{ $keywords }}">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:url" content="<?= $canonicalUrl ?>">
    <meta property="og:type" content="article">
    <meta name="theme-color" content="#3B82F6">

    <!-- BlogPosting JSON-LD -->
    <script type="application/ld+json">
    <?= json_encode($blogSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>
    </script>

    @include('partials.tailwind-assets')

    <!-- Google Fonts -->

    <!-- Styles matching Any2Convert premium design system -->
    <style>
        :root {
            --bg-base:        #F8F8FC;
            --bg-surface:     #FFFFFF;
            --bg-card:        #FFFFFF;
            --bg-card-hover:  #F3F3FA;
            --border:         rgba(0,0,0,0.08);
            --border-hover:   rgba(108,99,255,0.35);
            --text-primary:   #111118;
            --text-secondary: #464666;
            --text-muted:     #707096;
            --accent:         #6C63FF;
            --accent-light:   rgba(108,99,255,0.08);
            --accent-glow:    rgba(108,99,255,0.3);
            --red:            #EF4444;
            --blue:           #3B82F6;
            --violet:         #8B5CF6;
            --green:          #10B981;
            --amber:          #F59E0B;
        }

        html.dark {
            --bg-base:        #0A0A0F;
            --bg-surface:     #111118;
            --bg-card:        #16161F;
            --bg-card-hover:  #1C1C28;
            --border:         rgba(255,255,255,0.07);
            --border-hover:   rgba(255,255,255,0.15);
            --text-primary:   #F0F0F8;
            --text-secondary: #8B8BA7;
            --text-muted:     #4A4A62;
            --accent-light:   rgba(108,99,255,0.15);
            --accent-glow:    rgba(108,99,255,0.4);
        }

        * { font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; box-sizing: border-box; }
        body {
            background-color: var(--bg-base);
            color: var(--text-primary);
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
            animation: homeFadeIn 0.6s cubic-bezier(.22,1,.36,1);
        }

        @keyframes homeFadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Noise texture overlay */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 0;
            opacity: 0.35;
        }

        .btn-primary {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 9px 20px;
            background: var(--accent);
            color: #fff;
            border-radius: 9px;
            font-size: 0.875rem;
            font-weight: 600;
            border: none; cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
        }
        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 25px var(--accent-glow);
            background: #7B73FF;
        }

        /* Reading content styling */
        .article-content {
            font-size: 1.05rem;
            line-height: 1.85;
            color: var(--text-secondary);
        }
        .article-content p {
            margin-bottom: 1.5rem;
        }
        .article-content p.lead {
            font-size: 1.2rem;
            line-height: 1.75;
            color: var(--text-primary);
            font-weight: 500;
        }
        .article-content h2 {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-top: 2.2rem;
            margin-bottom: 1rem;
            letter-spacing: -0.02em;
        }
        .article-content h3 {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-top: 1.8rem;
            margin-bottom: 0.8rem;
        }
        .article-content h4 {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-top: 1.4rem;
            margin-bottom: 0.6rem;
        }
        .article-content ul, .article-content ol {
            margin-bottom: 1.5rem;
            padding-left: 1.5rem;
        }
        .article-content ul {
            list-style-type: disc;
        }
        .article-content ol {
            list-style-type: decimal;
        }
        .article-content li {
            margin-bottom: 0.5rem;
        }
        .article-content a {
            color: var(--accent);
            text-decoration: underline;
            font-weight: 500;
        }
        .article-content a:hover {
            color: #7B73FF;
        }

        /* Custom components inside blog text */
        .blog-note {
            background: var(--accent-light);
            border-left: 4px solid var(--accent);
            padding: 1.25rem 1.5rem;
            border-radius: 0 12px 12px 0;
            margin: 2rem 0;
            font-size: 0.95rem;
            color: var(--text-primary);
        }
        .blog-steps li {
            position: relative;
            padding-left: 0.5rem;
            margin-bottom: 1rem;
        }
        .blog-steps li strong {
            color: var(--text-primary);
        }

        .faq-item {
            border-bottom: 1px solid var(--border);
            padding: 1.25rem 0;
        }
        .faq-item:last-child {
            border-bottom: none;
        }
        .faq-item h4 {
            margin-top: 0;
            color: var(--text-primary);
            font-size: 1.05rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        .faq-item p {
            margin-bottom: 0;
            font-size: 0.925rem;
            line-height: 1.6;
        }

        .cat-badge {
            display: inline-flex;
            padding: 4px 10px;
            font-size: 0.72rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-radius: 6px;
        }
        .cat-pdf { background: rgba(239,68,68,0.1); color: #EF4444; border: 1px solid rgba(239,68,68,0.15); }
        .cat-convert { background: rgba(59,130,246,0.1); color: #3B82F6; border: 1px solid rgba(59,130,246,0.15); }
        .cat-utility { background: rgba(139,92,246,0.1); color: #8B5CF6; border: 1px solid rgba(139,92,246,0.15); }
        .cat-conversion { background: rgba(16,185,129,0.1); color: #10B981; border: 1px solid rgba(16,185,129,0.15); }
        .cat-calculator { background: rgba(245,158,11,0.1); color: #F59E0B; border: 1px solid rgba(245,158,11,0.15); }
        .cat-business { background: rgba(16,185,129,0.1); color: #10B981; border: 1px solid rgba(16,185,129,0.15); }
        .cat-writing { background: rgba(99,102,241,0.1); color: #6366F1; border: 1px solid rgba(99,102,241,0.15); }
        .cat-developer { background: rgba(6,182,212,0.1); color: #06B6D4; border: 1px solid rgba(6,182,212,0.15); }
        .cat-gaming { background: rgba(236,72,153,0.1); color: #EC4899; border: 1px solid rgba(236,72,153,0.15); }
        .cat-fun { background: rgba(217,70,239,0.1); color: #D946EF; border: 1px solid rgba(217,70,239,0.15); }

        .sidebar-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 16px;
        }

        #themeToggle:hover {
            background: var(--accent-light) !important;
            border-color: rgba(108,99,255,0.3) !important;
            color: var(--accent) !important;
        }
    </style>
    @include('partials.defer-external-scripts', ['sources' => [
        ['src' => 'https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4031884874698168', 'crossorigin' => 'anonymous'],
        ['src' => 'https://www.clarity.ms/tag/xymcprs44h'],
    ]])
</head>
<body class="relative min-h-screen pb-20">

    <!-- ═══════════════════════════════ NAVBAR ═══════════════════════════════ -->
    @include('partials.site-navbar')

    <!-- ═══════════════════════════════ MAIN CONTENT ═══════════════════════════════ -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 relative z-10">

        <!-- Back Button -->
        <div class="mb-6">
            <a href="/blog" class="inline-flex items-center gap-2 text-xs font-bold text-[var(--text-secondary)] hover:text-[var(--accent)] transition-colors no-underline">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
                Back to Blog Directory
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

            <!-- Left Column: Article content (8 cols) -->
            <article class="lg:col-span-8">

                <!-- Article Header -->
                <header class="mb-8">
                    <span class="cat-badge cat-{{ $article['category_slug'] }} mb-4">{{ $article['category'] }}</span>
                    <h1 class="text-3xl md:text-4xl font-extrabold text-[var(--text-primary)] leading-tight mb-4 tracking-tight">
                        {{ $article['title'] }}
                    </h1>

                    <!-- Metadata info -->
                    <div class="flex flex-wrap items-center gap-4 text-xs text-[var(--text-muted)] border-b border-[var(--border)] pb-5">
                        <div class="flex items-center gap-2">
                            <div class="w-6 h-6 rounded-full bg-gradient-to-tr from-[#6C63FF] to-[#A78BFA] flex items-center justify-center text-[9px] font-bold text-white shadow-sm">
                                {{ strtoupper(substr($article['author'], 0, 1)) }}
                            </div>
                            <span class="font-bold text-[var(--text-primary)]">{{ $article['author'] }}</span>
                        </div>
                        <div class="h-3 w-[1px] bg-[var(--border)]"></div>
                        <div class="flex items-center gap-1">
                            <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                            </svg>
                            @if (!empty($article['date']))<span>{{ $article['date'] }}</span>@endif
                        </div>
                        <div class="h-3 w-[1px] bg-[var(--border)]"></div>
                        <div class="flex items-center gap-1">
                            <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>
                            </svg>
                            <span>{{ $article['read_time'] }}</span>
                        </div>
                    </div>
                </header>

                <!-- Featured Image -->
                <div class="aspect-video w-full rounded-2xl overflow-hidden mb-8 shadow-sm border border-[var(--border)] bg-zinc-800">
                    <img src="{{ asset($article['image']) }}" alt="{{ $article['title'] }}" width="1024" height="1024" fetchpriority="high" decoding="async" class="w-full h-full object-cover">
                </div>

                <!-- Reading content -->
                <div class="article-content pr-0 md:pr-4">
                    {!! $article['content'] !!}
                </div>

                <!-- Call to Action Banner -->
                @if($article['tool_id'] !== null)
                <div class="mt-12 p-8 rounded-2xl border border-[var(--border)] bg-[var(--bg-card)] flex flex-col sm:flex-row items-center justify-between gap-6 shadow-sm">
                    <div>
                        <h3 class="text-base font-bold text-[var(--text-primary)] m-0 mb-1">Try the Free Online Tool Now</h3>
                        <p class="text-xs text-[var(--text-secondary)] m-0">Most tools are available without an account. Processing depends on the tool.</p>
                    </div>
                    <a href="/{{ $article['slug'] }}" class="btn-primary shrink-0">
                        Launch {{ explode(':', $article['title'])[0] }}
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>
                        </svg>
                    </a>
                </div>
                @endif

            </article>

            <!-- Right Column: Sidebar (4 cols) -->
            <aside class="lg:col-span-4 space-y-8">

                <!-- Useful links -->
                <div class="sidebar-card p-6 shadow-sm">
                    <h3 class="text-sm font-bold text-[var(--text-primary)] tracking-wide uppercase mb-3 border-b border-[var(--border)] pb-2">Need a hand?</h3>
                    <p class="text-sm text-[var(--text-secondary)] leading-relaxed mb-4">If this guide misses something, send a question or tell us what went wrong.</p>
                    <a href="/contact" class="inline-flex items-center gap-2 text-sm font-semibold text-[var(--accent)] no-underline hover:underline">Contact support <span aria-hidden="true">→</span></a>
                </div>

                <!-- Recent Guides Widget -->
                <div class="sidebar-card p-6 shadow-sm">
                    <h3 class="text-sm font-bold text-[var(--text-primary)] tracking-wide uppercase mb-4 border-b border-[var(--border)] pb-2">Related Tutorials</h3>
                    <div class="space-y-5">
                        @foreach($recentPosts as $post)
                        <div class="flex gap-3">
                            <a href="/blog/{{ $post['slug'] }}" class="w-20 h-14 rounded-lg overflow-hidden shrink-0 bg-zinc-800 border border-[var(--border)] block">
                                <img src="{{ asset($post['image']) }}" alt="{{ $post['title'] }}" width="1024" height="1024" loading="lazy" decoding="async" class="w-full h-full object-cover">
                            </a>
                            <div>
                                <h4 class="text-xs font-bold text-[var(--text-primary)] leading-snug m-0 mb-1 hover:text-[var(--accent)] transition-colors">
                                    <a href="/blog/{{ $post['slug'] }}" class="no-underline text-inherit">{{ \Illuminate\Support\Str::limit($post['title'], 45) }}</a>
                                </h4>
                                @if (!empty($post['date']))<span class="text-[10px] text-[var(--text-muted)]">{{ $post['date'] }}</span>@endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Mini Banner widget -->
                <div class="p-6 rounded-2xl bg-gradient-to-tr from-[#6C63FF]/90 to-[#A78BFA]/90 text-white shadow-sm relative overflow-hidden">
                    <div class="absolute inset-0 bg-black/10 z-0"></div>
                    <div class="relative z-10">
                        <h3 class="text-base font-bold m-0 mb-2">Looking for a tool?</h3>
                        <p class="text-xs text-white/80 leading-relaxed mb-4">Browse file converters, PDF helpers, calculators, and everyday utilities.</p>
                        <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-white text-[var(--accent)] rounded-lg text-xs font-bold shadow-md hover:bg-zinc-50 transition-colors no-underline">
                            Browse All Tools
                            <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path d="M5 12h14M12 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>

            </aside>

        </div>

    </main>

    <!-- ═══════════════════════════════ FOOTER ═══════════════════════════════ -->
    @include('partials.site-footer')

    <!-- ═══════════════════════════════ JS LOGIC ═══════════════════════════════ -->
    <script>

    </script>
</body>
</html>
