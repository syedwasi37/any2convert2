<?php
$canonicalUrl = 'https://any2convert.com' . rtrim(request()->getPathInfo(), '/');
$blogSchema = [
    '@context' => 'https://schema.org',
    '@type' => 'BlogPosting',
    'headline' => $article['title'],
    'description' => $article['excerpt'],
    'url' => $canonicalUrl,
    'datePublished' => date('Y-m-d', strtotime($article['date'] ?? 'now')),
    'author' => [
        '@type' => 'Organization',
        'name' => $article['author'] ?? 'Any2Convert Team'
    ],
    'publisher' => [
        '@type' => 'Organization',
        'name' => 'Any2Convert',
        'logo' => [
            '@type' => 'ImageObject',
            'url' => 'https://any2convert.com/mylogo.png'
        ]
    ]
];
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
    <link rel="icon" type="image/png" href="{{ asset('mylogo.png') }}">
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

    <!-- Tailwind CSS v4 -->
    <script>
        tailwind.config = {
            darkMode: 'class'
        };
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">

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

        * { font-family: 'DM Sans', sans-serif; box-sizing: border-box; }
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

        .navbar {
            background: rgba(248,248,252,0.9);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
        }
        html.dark .navbar {
            background: rgba(10,10,15,0.85);
        }

        .nav-pill {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 7px 16px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--text-secondary);
            border: 1px solid transparent;
            transition: all 0.2s ease;
            cursor: pointer; text-decoration: none;
        }
        .nav-pill:hover { color: var(--text-primary); background: rgba(255,255,255,0.05); border-color: var(--border); }

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
    <!-- Microsoft Clarity -->
    <script type="text/javascript">
        (function(c,l,a,r,i,t,y){
            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
        })(window, document, "clarity", "script", "xymcprs44h");
    </script>
</head>
<body class="relative min-h-screen pb-20">

    <!-- ═══════════════════════════════ NAVBAR ═══════════════════════════════ -->
    <nav class="navbar sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 py-3">

                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2" style="text-decoration:none" aria-label="Any2Convert home">
                    <div class="w-[30px] h-[30px] bg-white rounded-lg flex items-center justify-center flex-shrink-0 shadow-sm border border-black/5">
                        <img src="{{ asset('any2trans.webp') }}" alt="Any2Convert logo" width="30" height="30">
                    </div>
                    <span class="font-bold text-sm tracking-tight text-[var(--text-primary)]">Any2Convert</span>
                </a>

                <!-- Right Menu -->
                <div class="flex items-center gap-2">
                    <a href="{{ route('home') }}" class="nav-pill">Home</a>
                    <a href="/blog" class="nav-pill active">Blog</a>
                    
                    <!-- Dark/Light Mode toggle -->
                    <button id="themeToggle" onclick="toggleDarkMode()" title="Toggle dark mode" style="width:34px;height:34px;display:flex;align-items:center;justify-content:center;border-radius:8px;background:transparent;border:1px solid var(--border);color:var(--text-secondary);cursor:pointer;transition:all 0.2s ease;flex-shrink:0;">
                        <!-- Moon Icon -->
                        <svg id="iconMoon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
                        </svg>
                        <!-- Sun Icon -->
                        <svg id="iconSun" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none">
                            <circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
                        </svg>
                    </button>
                    
                    <a href="/register" class="btn-primary hidden sm:inline-flex" style="font-size:0.84rem;padding:7px 16px;">
                        Get started free
                    </a>
                </div>

            </div>
        </div>
    </nav>

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
                            <span>{{ $article['date'] }}</span>
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
                    <img src="{{ asset($article['image']) }}" alt="{{ $article['title'] }}" class="w-full h-full object-cover">
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
                        <p class="text-xs text-[var(--text-secondary)] m-0">No registration, no limits, and absolute privacy on your device.</p>
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
                
                <!-- Table of Contents / Quick links -->
                <div class="sidebar-card p-6 shadow-sm">
                    <h3 class="text-sm font-bold text-[var(--text-primary)] tracking-wide uppercase mb-4 border-b border-[var(--border)] pb-2">Guide Outline</h3>
                    <ul class="space-y-3 text-xs text-[var(--text-secondary)] list-none p-0 m-0">
                        <li>
                            <a href="#" class="hover:text-[var(--accent)] no-underline flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-[var(--accent)]"></span>
                                Introduction & Purpose
                            </a>
                        </li>
                        <li>
                            <a href="#" class="hover:text-[var(--accent)] no-underline flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-[var(--accent)]"></span>
                                Why Choose Any2Convert
                            </a>
                        </li>
                        <li>
                            <a href="#" class="hover:text-[var(--accent)] no-underline flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-[var(--accent)]"></span>
                                Step-by-Step Walkthrough
                            </a>
                        </li>
                        <li>
                            <a href="#" class="hover:text-[var(--accent)] no-underline flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-[var(--accent)]"></span>
                                Privacy & Local Security
                            </a>
                        </li>
                        <li>
                            <a href="#" class="hover:text-[var(--accent)] no-underline flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-[var(--accent)]"></span>
                                Frequently Asked Questions
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Recent Guides Widget -->
                <div class="sidebar-card p-6 shadow-sm">
                    <h3 class="text-sm font-bold text-[var(--text-primary)] tracking-wide uppercase mb-4 border-b border-[var(--border)] pb-2">Related Tutorials</h3>
                    <div class="space-y-5">
                        @foreach($recentPosts as $post)
                        <div class="flex gap-3">
                            <a href="/blog/{{ $post['slug'] }}" class="w-20 h-14 rounded-lg overflow-hidden shrink-0 bg-zinc-800 border border-[var(--border)] block">
                                <img src="{{ asset($post['image']) }}" alt="{{ $post['title'] }}" class="w-full h-full object-cover">
                            </a>
                            <div>
                                <h4 class="text-xs font-bold text-[var(--text-primary)] leading-snug m-0 mb-1 hover:text-[var(--accent)] transition-colors">
                                    <a href="/blog/{{ $post['slug'] }}" class="no-underline text-inherit">{{ \Illuminate\Support\Str::limit($post['title'], 45) }}</a>
                                </h4>
                                <span class="text-[10px] text-[var(--text-muted)]">{{ $post['date'] }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Mini Banner widget -->
                <div class="p-6 rounded-2xl bg-gradient-to-tr from-[#6C63FF]/90 to-[#A78BFA]/90 text-white shadow-sm relative overflow-hidden">
                    <div class="absolute inset-0 bg-black/10 z-0"></div>
                    <div class="relative z-10">
                        <h3 class="text-base font-extrabold m-0 mb-2">Over 80+ Free Utilities</h3>
                        <p class="text-xs text-white/80 leading-relaxed mb-4">Discover the full scope of our local-first document processors, converter suites, currency checkers, and writing assistants.</p>
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
    <footer class="max-w-7xl mx-auto px-4 text-center mt-24 pt-8 border-t border-[var(--border)] text-xs text-[var(--text-muted)]">
        <p>&copy; {{ date('Y') }} Any2Convert. All rights reserved. Locally processed files never leave your device.</p>
        <p class="mt-2">
            <a href="/" class="hover:text-[var(--text-secondary)]">Home</a> &middot;
            <a href="/privacy" class="hover:text-[var(--text-secondary)] ml-2">Privacy</a> &middot;
            <a href="/terms" class="hover:text-[var(--text-secondary)] ml-2">Terms</a>
        </p>
    </footer>

    <!-- ═══════════════════════════════ JS LOGIC ═══════════════════════════════ -->
    <script>
        // Theme toggler
        function toggleDarkMode() {
            const isDark = document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            document.getElementById('iconMoon').style.display = isDark ? 'none'  : '';
            document.getElementById('iconSun').style.display  = isDark ? ''      : 'none';
        }
        // Init theme
        (function(){
            const saved = localStorage.getItem('theme');
            if (saved === 'dark') {
                document.documentElement.classList.add('dark');
                document.getElementById('iconMoon').style.display = 'none';
                document.getElementById('iconSun').style.display  = '';
            }
        })();
    </script>
</body>
</html>
