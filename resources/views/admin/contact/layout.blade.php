<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    @include('partials.site-theme')
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Contact inbox') · Any2Convert Admin</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16.png') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    @include('partials.tailwind-assets')
    <style>
        * { box-sizing: border-box; }
        body.admin-page { display:flex; min-height:100vh; flex-direction:column; margin: 0; background: #f5f7fa; color: #172033; font: 14px/1.5 system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif; }
        a { color: inherit; }
        .admin-navbar-links { display: flex; align-items: center; gap: 4px; min-height: 44px; padding: 0 0 8px; overflow-x: auto; scrollbar-width: thin; }
        .admin-navbar-links .nav-pill { flex: 0 0 auto; }
        .admin-main { flex:1 0 auto; width: min(100% - 32px, 1160px); margin: 30px auto 64px; }
        .admin-page > .site-footer { flex:0 0 auto; margin-top:auto; }
        .admin-heading { display: flex; align-items: flex-end; justify-content: space-between; gap: 16px; margin-bottom: 22px; }
        .admin-heading h1 { margin: 0; color: #111827; font-size: 27px; line-height: 1.2; letter-spacing: -.03em; }
        .admin-heading p { margin: 6px 0 0; color: #64748b; }
        .admin-panel { padding: 20px; border: 1px solid #e2e8f0; border-radius: 12px; background: #fff; box-shadow: 0 4px 18px rgba(15,23,42,.035); }
        .admin-section-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 14px; margin-bottom: 20px; }
        .admin-section-card { position: relative; display: flex; min-height: 174px; flex-direction: column; align-items: flex-start; padding: 20px; overflow: hidden; border: 1px solid #e2e8f0; border-radius: 14px; background: #fff; color: #172033; text-decoration: none; box-shadow: 0 2px 8px rgba(15,23,42,.025); transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease; }
        .admin-section-card:hover { transform: translateY(-3px); border-color: #cbd5e1; box-shadow: 0 12px 28px rgba(15,23,42,.08); }
        .admin-section-card:focus-visible { outline: 3px solid #9cc8ad; outline-offset: 3px; }
        .admin-section-icon { display: grid; width: 44px; height: 44px; place-items: center; margin-bottom: 18px; border-radius: 12px; }
        .admin-section-icon svg { width: 22px; height: 22px; }
        .admin-section-icon.analytics { background: #e9f4ed; color: #34795a; }
        .admin-section-icon.users { background: #f0edfa; color: #6853a4; }
        .admin-section-icon.messages { background: #fff2e5; color: #b66a25; }
        .admin-section-title { margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -.01em; }
        .admin-section-description { max-width: 34ch; margin: 5px 0 0; color: #64748b; font-size: 13px; line-height: 1.5; }
        .admin-section-arrow { position: absolute; right: 20px; bottom: 20px; display: grid; width: 30px; height: 30px; place-items: center; border: 1px solid #e8edf2; border-radius: 50%; color: #64748b; transition: transform .18s ease, background .18s ease; }
        .admin-section-card:hover .admin-section-arrow { transform: translateX(2px); background: #f8fafc; }
        .admin-section-count { position: absolute; top: 18px; right: 20px; display: inline-flex; min-width: 28px; height: 28px; align-items: center; justify-content: center; padding: 0 8px; border: 1px solid #f4caca; border-radius: 999px; background: #fff1f0; color: #aa3c36; font-size: 12px; font-weight: 750; font-variant-numeric: tabular-nums; }
        .admin-chart-head { display:flex; align-items:center; justify-content:space-between; gap:14px; flex-wrap:wrap; margin-bottom:14px; }
        .admin-chart-ranges { display:inline-flex; gap:3px; padding:3px; border:1px solid #e2e8f0; border-radius:9px; background:#f8fafc; }
        .admin-chart-range { min-height:31px; padding:0 11px; border:0; border-radius:6px; background:transparent; color:#64748b; font:inherit; font-size:12px; font-weight:650; cursor:pointer; }
        .admin-chart-range[aria-pressed="true"] { background:#fff; color:#172033; box-shadow:0 1px 3px rgba(15,23,42,.12); }
        .admin-signup-bars { display:flex; align-items:stretch; gap:clamp(2px,.55vw,7px); height:170px; padding:12px 3px 0; border-bottom:1px solid #e2e8f0; }
        .admin-signup-bar { display:flex; flex:1 1 0; min-width:0; flex-direction:column; justify-content:flex-end; align-items:center; gap:7px; padding:0 1px; border:0; background:transparent; color:#64748b; cursor:help; }
        .admin-signup-bar[hidden], .admin-signup-label[hidden] { display:none; }
        .admin-signup-bar:focus-visible { outline:2px solid #34795a; outline-offset:2px; border-radius:5px; }
        .admin-signup-fill { display:block; width:min(100%,22px); min-height:3px; border-radius:5px 5px 2px 2px; background:linear-gradient(180deg,#5a9c72,#34795a); transition:height .25s ease, opacity .2s ease; }
        .admin-signup-label { min-height:15px; color:#7b8491; font-size:10px; font-variant-numeric:tabular-nums; white-space:nowrap; }
        .admin-chart-empty { display:grid; height:170px; place-items:center; border-bottom:1px solid #e2e8f0; color:#7b8491; font-size:13px; }
        .admin-chart-foot { display:flex; justify-content:space-between; gap:12px; margin-top:9px; color:#7b8491; font-size:11px; }
        .admin-health-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:12px; }
        .admin-health-item { display:flex; align-items:flex-start; gap:12px; padding:16px; border:1px solid #e2e8f0; border-radius:11px; background:#fff; }
        .admin-health-indicator { display:grid; flex:0 0 26px; width:26px; height:26px; place-items:center; border-radius:50%; background:#e9f4ed; color:#34795a; }
        .admin-health-indicator.check { background:#fff2e5; color:#a55f20; }
        .admin-health-item strong { display:block; font-size:13px; }
        .admin-health-item p { margin:3px 0 0; color:#64748b; font-size:12px; }
        html.dark .admin-page .admin-section-card { border-color:rgba(255,255,255,.1); background:#16161f; color:#f0f0f8; box-shadow:0 2px 10px rgba(0,0,0,.12); }
        html.dark .admin-page .admin-section-card:hover { border-color:rgba(255,255,255,.2); background:#1b1b26; box-shadow:0 12px 28px rgba(0,0,0,.25); }
        html.dark .admin-page .admin-section-description { color:#a4a4b3; }
        html.dark .admin-page .admin-section-icon.analytics { background:#20352a; color:#9bd2ad; }
        html.dark .admin-page .admin-section-icon.users { background:#2b2640; color:#c7b7ee; }
        html.dark .admin-page .admin-section-icon.messages { background:#3b2b1e; color:#edc18e; }
        html.dark .admin-page .admin-section-arrow { border-color:rgba(255,255,255,.12); color:#b8b8c7; }
        html.dark .admin-page .admin-section-card:hover .admin-section-arrow { background:#252531; }
        html.dark .admin-page .admin-section-count { border-color:#703a39; background:#382323; color:#ffaaa2; }
        html.dark .admin-page .admin-chart-ranges { border-color:rgba(255,255,255,.12); background:#101018; }
        html.dark .admin-page .admin-chart-range { color:#a4a4b3; }
        html.dark .admin-page .admin-chart-range[aria-pressed="true"] { background:#2a2a36; color:#f0f0f8; box-shadow:none; }
        html.dark .admin-page .admin-signup-bars, html.dark .admin-page .admin-chart-empty { border-color:rgba(255,255,255,.12); }
        html.dark .admin-page .admin-signup-label, html.dark .admin-page .admin-chart-foot, html.dark .admin-page .admin-chart-empty { color:#a4a4b3; }
        html.dark .admin-page .admin-signup-fill { background:linear-gradient(180deg,#83c999,#4d9569); }
        html.dark .admin-page .admin-health-item { border-color:rgba(255,255,255,.1); background:#16161f; color:#f0f0f8; }
        html.dark .admin-page .admin-health-item p { color:#a4a4b3; }
        html.dark .admin-page .admin-health-indicator { background:#20352a; color:#9bd2ad; }
        html.dark .admin-page .admin-health-indicator.check { background:#3b2b1e; color:#edc18e; }
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
        @media (max-width: 800px) { .admin-section-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
        @media (max-width: 520px) { .admin-section-grid { grid-template-columns: 1fr; gap: 10px; } .admin-section-card { min-height: 150px; padding: 17px; } .admin-section-icon { margin-bottom: 12px; } }
        @media (max-width: 640px) { .admin-navbar-links { min-height: 40px; margin-top: -3px; padding-bottom: 7px; } .admin-navbar-links .nav-pill { padding-right: 11px; padding-left: 11px; font-size: 13px; } .admin-main { width: min(100% - 20px, 1160px); margin-top: 20px; } .admin-panel { padding: 15px; } .admin-heading { align-items: flex-start; flex-direction: column; } }
        @media (prefers-reduced-motion: reduce) { .admin-page .admin-section-card, .admin-page .admin-section-arrow, .admin-page .admin-signup-fill { transition:none; } }
    </style>
</head>
<body class="admin-page">
@include('partials.site-navbar')
<main class="admin-main">
    @if (session('status'))<div class="admin-flash" role="status">{{ session('status') }}</div>@endif
    @if (session('warning'))<div class="admin-flash warning" role="status">{{ session('warning') }}</div>@endif
    @if ($errors->any())<div class="admin-flash error" role="alert">Please check the highlighted details and try again.</div>@endif
    @yield('content')
</main>
@include('partials.site-footer')
</body>
</html>
