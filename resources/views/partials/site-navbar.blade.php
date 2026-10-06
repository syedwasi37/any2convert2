<!-- ═══════════════════════════════ NAVBAR ═══════════════════════════════ -->
<nav class="navbar sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-15 py-3">

            <!-- Logo -->
            <a href="{{ route('home') }}" style="text-decoration:none" class="flex items-center gap-2" aria-label="Any2Convert home">
                <div style="width:30px;height:30px;background:white;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                       <img src="{{ asset('any2trans.webp') }}" alt="Any2Convert logo" width="30" height="30">
                </div>
                <span style="font-weight:700;color:var(--text-primary);font-size:0.95rem;">Any2Convert</span>
            </a>

            <!-- Right side -->
            <div class="flex items-center gap-2">
                @if (!request()->is('admin', 'admin/*'))
                    <a href="/blog" class="nav-pill {{ request()->is('blog') || request()->is('blog/*') ? 'active' : '' }}" @if(request()->is('blog') || request()->is('blog/*')) aria-current="page" @endif>Blog</a>
                @endif

                <!-- Dark / Light mode toggle -->
                <button id="themeToggle" type="button" onclick="toggleDarkMode()" title="Toggle dark mode" aria-label="Toggle dark mode" style="width:34px;height:34px;display:flex;align-items:center;justify-content:center;border-radius:8px;background:transparent;border:1px solid var(--border);color:var(--text-secondary);cursor:pointer;transition:all 0.2s ease;flex-shrink:0;">
                    <!-- Moon (visible in light mode) -->
                    <svg id="iconMoon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
                    </svg>
                    <!-- Sun (visible in dark mode) -->
                    <svg id="iconSun" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none">
                        <circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
                    </svg>
                </button>

                <?php if (auth()->check()): ?>
                    <div class="relative dropdown-trigger" style="position:relative">
                        <button class="nav-pill">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            <?php echo htmlspecialchars(explode(' ', (string) auth()->user()->name)[0], ENT_QUOTES, 'UTF-8'); ?>
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
                        </button>
                        <div class="dropdown-menu">
                            <a href="{{ route('home') }}" class="dropdown-item">
                                <span style="display:flex;align-items:center;gap:8px;">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
                                    My tools
                                </span>
                            </a>
                            <a href="{{ route('account.profile') }}" class="dropdown-item">
                                <span style="display:flex;align-items:center;gap:8px;">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M5 21v-2a7 7 0 0 1 14 0v2"/></svg>
                                    Profile & security
                                    <?php if (auth()->user()->hasPremiumAccess()): ?><span style="color:#9a6b1d">✦ Premium</span><?php endif; ?>
                                </span>
                            </a>
                            <?php if (auth()->user()->isAdmin()): ?>
                                <a href="{{ route('admin.dashboard') }}" class="dropdown-item">
                                    <span style="display:flex;align-items:center;gap:8px;">
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="8" height="8" rx="1"/><rect x="13" y="3" width="8" height="5" rx="1"/><rect x="13" y="10" width="8" height="11" rx="1"/><rect x="3" y="13" width="8" height="8" rx="1"/></svg>
                                        Admin panel
                                    </span>
                                </a>
                            <?php endif; ?>
                            <hr class="sep" style="margin:4px 0">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item danger" style="width:100%;border:0;background:transparent;text-align:left;cursor:pointer;">
                                <span style="display:flex;align-items:center;gap:8px;">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                                    Logout
                                </span>
                                </button>
                            </form>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="/login" class="nav-pill" data-site-sign-in>Sign in</a>
                    <a href="/register" class="btn-primary" data-site-get-started style="text-decoration:none;font-size:0.84rem;padding:8px 18px;">
                        Get started free
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </a>
                <?php endif; ?>
            </div>

        </div>
        @if (auth()->check() && auth()->user()->isAdmin() && request()->is('admin', 'admin/*'))
            <nav class="admin-navbar-links" aria-label="Admin sections">
                <a href="{{ route('admin.dashboard') }}" class="nav-pill {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" @if(request()->routeIs('admin.dashboard')) aria-current="page" @endif>Overview</a>
                <a href="{{ route('admin.analytics') }}" class="nav-pill {{ request()->routeIs('admin.analytics') ? 'active' : '' }}" @if(request()->routeIs('admin.analytics')) aria-current="page" @endif>Analytics</a>
                <a href="{{ route('admin.status') }}" class="nav-pill {{ request()->routeIs('admin.status') ? 'active' : '' }}" @if(request()->routeIs('admin.status')) aria-current="page" @endif>Site status</a>
                <a href="{{ route('admin.users.index') }}" class="nav-pill {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" @if(request()->routeIs('admin.users.*')) aria-current="page" @endif>Users</a>
                <a href="{{ route('admin.contact.index') }}" class="nav-pill {{ request()->routeIs('admin.contact.*') ? 'active' : '' }}" @if(request()->routeIs('admin.contact.*')) aria-current="page" @endif>Contact messages</a>
            </nav>
        @endif
    </div>
</nav>
