<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Contact inbox') · Any2Convert Admin</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16.png') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; background: #f5f7fa; color: #172033; font: 14px/1.5 system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif; }
        a { color: inherit; }
        .admin-top { display: flex; align-items: center; justify-content: space-between; gap: 16px; min-height: 60px; padding: 0 24px; border-bottom: 1px solid #e2e8f0; background: #fff; }
        .admin-brand { display: flex; align-items: center; gap: 10px; font-weight: 700; text-decoration: none; }
        .admin-brand img { width: 30px; height: 30px; object-fit: contain; }
        .admin-top-nav { display: flex; align-items: center; gap: 16px; color: #475569; }
        .admin-top-nav a { text-decoration: none; }
        .admin-main { width: min(100% - 32px, 1160px); margin: 30px auto 64px; }
        .admin-heading { display: flex; align-items: flex-end; justify-content: space-between; gap: 16px; margin-bottom: 22px; }
        .admin-heading h1 { margin: 0; color: #111827; font-size: 27px; line-height: 1.2; letter-spacing: -.03em; }
        .admin-heading p { margin: 6px 0 0; color: #64748b; }
        .admin-panel { padding: 20px; border: 1px solid #e2e8f0; border-radius: 12px; background: #fff; box-shadow: 0 4px 18px rgba(15,23,42,.035); }
        .admin-flash { margin-bottom: 16px; padding: 12px 14px; border: 1px solid #a7f3d0; border-radius: 8px; background: #ecfdf5; color: #047857; }
        .admin-flash.warning { border-color: #fcd34d; background: #fffbeb; color: #92400e; }
        .admin-flash.error { border-color: #fca5a5; background: #fef2f2; color: #b91c1c; }
        .admin-button { display: inline-flex; align-items: center; justify-content: center; gap: 6px; min-height: 38px; padding: 0 12px; border: 1px solid #cbd5e1; border-radius: 7px; background: #fff; color: #334155; font: inherit; font-weight: 600; text-decoration: none; cursor: pointer; }
        .admin-button:hover { background: #f8fafc; }
        .admin-button.primary { border-color: #2563eb; background: #2563eb; color: white; }
        .admin-button.danger { border-color: #fecaca; color: #b91c1c; }
        .admin-control { width: 100%; min-width: 0; min-height: 40px; padding: 8px 10px; border: 1px solid #cbd5e1; border-radius: 7px; background: #fff; color: #172033; font: inherit; }
        .admin-label { display: block; margin-bottom: 5px; color: #475569; font-size: 12px; font-weight: 700; }
        .admin-field-error { margin-top: 4px; color: #b91c1c; font-size: 12px; }
        .admin-status { display: inline-flex; align-items: center; padding: 3px 8px; border-radius: 999px; background: #eff6ff; color: #1d4ed8; font-size: 11px; font-weight: 700; white-space: nowrap; }
        .admin-status.new { background: #eff6ff; color: #1d4ed8; }
        .admin-status.in_progress { background: #fff7ed; color: #c2410c; }
        .admin-status.replied { background: #ecfdf5; color: #047857; }
        .admin-status.closed, .admin-status.spam { background: #f1f5f9; color: #475569; }
        .admin-muted { color: #64748b; }
        .admin-pagination { display: flex; justify-content: center; gap: 8px; margin-top: 18px; }
        .admin-pagination a, .admin-pagination span { padding: 7px 10px; border: 1px solid #e2e8f0; border-radius: 6px; background: #fff; text-decoration: none; }
        .admin-pagination [aria-current="page"] span { background: #eff6ff; color: #1d4ed8; }
        @media (max-width: 640px) { .admin-top { padding: 0 14px; } .admin-main { width: min(100% - 20px, 1160px); margin-top: 20px; } .admin-panel { padding: 15px; } .admin-heading { align-items: flex-start; flex-direction: column; } }
    </style>
</head>
<body>
<header class="admin-top">
    <a href="{{ route('admin.contact.index') }}" class="admin-brand"><img src="{{ asset('any2convertlogo.png') }}" alt=""><span>Any2Convert <span class="admin-muted">/ Admin</span></span></a>
    <nav class="admin-top-nav" aria-label="Admin navigation"><a href="{{ route('admin.contact.index') }}">Inbox</a><a href="/" target="_blank" rel="noopener">View site</a></nav>
</header>
<main class="admin-main">
    @if (session('status'))<div class="admin-flash" role="status">{{ session('status') }}</div>@endif
    @if (session('warning'))<div class="admin-flash warning" role="status">{{ session('warning') }}</div>@endif
    @if ($errors->any())<div class="admin-flash error" role="alert">Please check the highlighted details and try again.</div>@endif
    @yield('content')
</main>
</body>
</html>
