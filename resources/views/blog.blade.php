<?php
$canonicalUrl = 'https://any2convert.com/blog';
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
    <meta name="theme-color" content="#3B82F6">

    @include('partials.tailwind-assets')

    <!-- CSS custom properties mapping home style -->
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
            animation: none;
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

        /* Hero ambient glow */
        .hero-glow {
            position: absolute;
            width: 800px; height: 400px;
            background: radial-gradient(ellipse, rgba(108,99,255,0.15) 0%, transparent 70%);
            top: -120px; left: 50%; transform: translateX(-50%);
            pointer-events: none;
            filter: blur(40px);
        }

        /* Keep article cards steady so the listing stays easy to scan. */
        .card-wp {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
            transition: border-color 0.16s ease, box-shadow 0.16s ease;
            position: relative;
        }
        .card-wp:hover {
            transform: translateY(-2px);
            border-color: var(--border-hover);
            box-shadow: 0 5px 14px rgba(15,23,42,0.08);
        }
        .card-wp::after { display:none; }
        body::before { display:none; }
        .hero-glow { filter:none; opacity:.3; }
        @media (prefers-reduced-motion: reduce) { *, *::before, *::after { scroll-behavior:auto !important; transition-duration:.01ms !important; animation-duration:.01ms !important; animation-iteration-count:1 !important; } }

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

        .search-wrap {
            transition: transform 0.28s cubic-bezier(.22,1,.36,1), border-color 0.24s ease, box-shadow 0.28s ease;
            background: var(--bg-card);
            border: 1px solid var(--border);
        }
        .search-wrap:focus-within {
            transform: translateY(-2px);
            border-color: var(--border-hover);
            box-shadow: 0 16px 34px rgba(15,23,42,0.08);
        }

        .filter-chip {
            border: 1px solid var(--border);
            background: var(--bg-surface);
            color: var(--text-secondary);
            border-radius: 999px;
            padding: 6px 14px;
            font-size: 0.8rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.24s ease;
        }
        .filter-chip:hover {
            transform: translateY(-2px);
            border-color: rgba(108,99,255,0.25);
            box-shadow: 0 8px 18px rgba(15,23,42,0.05);
            color: var(--text-primary);
        }
        .filter-chip.active {
            color: #fff;
            border-color: transparent;
            background: var(--accent);
            box-shadow: 0 8px 20px rgba(108,99,255,0.25);
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

    <!-- ═══════════════════════════════ HERO ═══════════════════════════════ -->
    <header class="relative overflow-hidden py-16 px-4 text-center">
        <div class="hero-glow"></div>
        <div class="relative z-10 max-w-4xl mx-auto">
            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full border border-[var(--border)] bg-[var(--bg-card)] text-xs font-semibold text-[var(--text-secondary)] shadow-sm mb-6">
                <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse shadow-[0_0_8px_#10B981]"></span>
                Any2Convert Knowledge Hub
            </span>
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-[var(--text-primary)] leading-tight mb-4">
                Any2Convert Blog & <br>
                <span class="text-[var(--accent)]">Productivity Guides</span>
            </h1>
            <p class="text-sm md:text-base text-[var(--text-secondary)] max-w-xl mx-auto leading-relaxed mb-8">
                Practical guides for PDFs, images, conversions, and the other tools on the site.
            </p>
        </div>
    </header>

    <!-- ═══════════════════════════════ MAIN CONTENT ═══════════════════════════════ -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- Search & Filter Controls -->
        <div class="mb-10 max-w-4xl mx-auto">
            <div class="search-wrap rounded-2xl p-4 mb-6 shadow-sm">
                <div class="relative flex items-center">
                    <svg class="absolute left-4 text-[var(--text-muted)]" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/>
                    </svg>
                    <input id="blogSearch" type="search" placeholder="Search guides like PDF convert, image compressor, password generator..." class="w-full bg-[var(--bg-surface)] text-[var(--text-primary)] rounded-xl py-3 pl-12 pr-4 border border-[var(--border)] text-sm focus:outline-none focus:border-[var(--border-hover)] focus:ring-4 focus:ring-[var(--accent-light)] transition-all" autocomplete="off">
                </div>
                <div class="flex justify-between items-center text-xs text-[var(--text-secondary)] mt-3">
                    <span id="searchResultCount">Showing all guides.</span>
                    <span>Tip: Use filter chips below to filter by category.</span>
                </div>
            </div>

            <!-- Categories filters -->
            <div class="flex flex-wrap gap-2 justify-center">
                <button class="filter-chip active" data-filter="all">All Categories</button>
                <button class="filter-chip" data-filter="pdf">PDF Tools</button>
                <button class="filter-chip" data-filter="convert">Converters</button>
                <button class="filter-chip" data-filter="utility">Utilities</button>
                <button class="filter-chip" data-filter="conversion">Data Converters</button>
                <button class="filter-chip" data-filter="calculator">Calculators</button>
                <button class="filter-chip" data-filter="business">Business</button>
                <button class="filter-chip" data-filter="writing">Writing</button>
                <button class="filter-chip" data-filter="gaming">Gaming</button>
                <button class="filter-chip" data-filter="fun">Fun Tools</button>
            </div>
        </div>

        <!-- No Results Warning -->
        <div id="noResults" class="hidden text-center py-16 border border-dashed border-[var(--border)] rounded-2xl max-w-4xl mx-auto bg-[var(--bg-card)]">
            <svg class="mx-auto text-[var(--text-muted)] mb-3" width="36" height="36" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10"/><path d="M16 16s-1.5-2-4-2-4 2-4 2M9 9h.01M15 9h.01"/>
            </svg>
            <h3 class="text-base font-bold text-[var(--text-primary)] mb-1">No articles found</h3>
            <p class="text-xs text-[var(--text-muted)]">Try adjusting your search keywords or checking another category.</p>
        </div>

        <!-- Articles Grid -->
        <div id="articlesGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($posts as $post)
            <article class="card-wp flex flex-col h-full" data-title="{{ strtolower($post['title']) }}" data-excerpt="{{ strtolower($post['excerpt']) }}" data-category="{{ $post['category_slug'] }}">

                <!-- Card Cover Image -->
                <a href="/blog/{{ $post['slug'] }}" class="block relative aspect-video overflow-hidden border-b border-[var(--border)] group">
                    <img src="{{ asset($post['image']) }}" alt="{{ $post['title'] }}" width="1024" height="1024" decoding="async" class="w-full h-full object-cover transition-transform duration-500 ease-out group-hover:scale-105" loading="lazy">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                </a>

                <!-- Card Content -->
                <div class="p-6 flex flex-col flex-grow">

                    <!-- Metadata Header -->
                    <div class="flex items-center justify-between mb-4">
                        <span class="cat-badge cat-{{ $post['category_slug'] }}">{{ $post['category'] }}</span>
                        <div class="flex items-center gap-1.5 text-xs text-[var(--text-muted)]">
                            <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>
                            </svg>
                            <span>{{ $post['read_time'] }}</span>
                        </div>
                    </div>

                    <!-- Article Title -->
                    <h3 class="text-lg font-bold text-[var(--text-primary)] leading-snug mb-3 hover:text-[var(--accent)] transition-colors">
                        <a href="/blog/{{ $post['slug'] }}" class="no-underline text-inherit">
                            {{ $post['title'] }}
                        </a>
                    </h3>

                    <!-- Article Excerpt -->
                    <p class="text-xs text-[var(--text-secondary)] leading-relaxed mb-6 flex-grow">
                        {{ \Illuminate\Support\Str::limit($post['excerpt'], 130) }}
                    </p>

                    <!-- Card Footer / Author -->
                    <div class="flex items-center justify-between pt-4 border-t border-[var(--border)] mt-auto">
                        <div class="flex items-center gap-2.5">
                            <!-- Dynamic Avatar placeholder -->
                            <div class="w-7 h-7 rounded-full bg-gradient-to-tr from-[#6C63FF] to-[#A78BFA] flex items-center justify-center text-[10px] font-bold text-white shadow-sm">
                                {{ strtoupper(substr($post['author'], 0, 1)) }}
                            </div>
                            <div class="text-[10px]">
                                <p class="font-bold text-[var(--text-primary)] m-0 leading-none mb-1">{{ $post['author'] }}</p>
                                <p class="text-[var(--text-muted)] m-0 leading-none">{{ $post['date'] }}</p>
                            </div>
                        </div>

                        <a href="/blog/{{ $post['slug'] }}" class="inline-flex items-center gap-1 text-xs font-semibold text-[var(--accent)] hover:underline">
                            Read Guide
                            <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path d="M5 12h14M12 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>

                </div>
            </article>
            @endforeach
        </div>

    </main>

    <!-- ═══════════════════════════════ FOOTER ═══════════════════════════════ -->
    @include('partials.site-footer')

    <!-- ═══════════════════════════════ JS LOGIC ═══════════════════════════════ -->
    <script>


        // Live Search & Category Filtering
        (function() {
            const searchInput = document.getElementById('blogSearch');
            const statusText = document.getElementById('searchResultCount');
            const filterChips = Array.from(document.querySelectorAll('.filter-chip'));
            const articles = Array.from(document.querySelectorAll('#articlesGrid article'));
            const noResults = document.getElementById('noResults');

            let activeFilter = 'all';

            function applyFilters() {
                const query = searchInput.value.trim().toLowerCase();
                let visibleCount = 0;

                articles.forEach(article => {
                    const title = article.dataset.title || '';
                    const excerpt = article.dataset.excerpt || '';
                    const category = article.dataset.category || '';

                    const categoryMatch = activeFilter === 'all' || category === activeFilter;
                    const searchMatch = !query || title.includes(query) || excerpt.includes(query);

                    const show = categoryMatch && searchMatch;
                    article.style.display = show ? 'flex' : 'none';

                    if (show) visibleCount++;
                });

                // Update results status bar
                if (visibleCount === 0) {
                    noResults.classList.remove('hidden');
                    statusText.textContent = `Showing 0 guides.`;
                } else {
                    noResults.classList.add('hidden');
                    const categoryLabel = activeFilter === 'all' ? 'all categories' : `${activeFilter} category`;
                    if (query) {
                        statusText.textContent = `Showing ${visibleCount} results matching "${query}" in ${categoryLabel}.`;
                    } else {
                        statusText.textContent = `Showing ${visibleCount} guides in ${categoryLabel}.`;
                    }
                }
            }

            // Bind events
            searchInput.addEventListener('input', applyFilters);

            filterChips.forEach(chip => {
                chip.addEventListener('click', () => {
                    filterChips.forEach(c => c.classList.remove('active'));
                    chip.classList.add('active');
                    activeFilter = chip.dataset.filter || 'all';
                    applyFilters();
                });
            });
        })();
    </script>
</body>
</html>
