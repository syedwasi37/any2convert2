<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <title>Two-step verification · Any2Convert</title>
    <style>
        *{box-sizing:border-box}body{margin:0;min-height:100vh;display:grid;place-items:center;padding:24px;background:#f6f7f5;color:#20231f;font:15px/1.55 Inter,ui-sans-serif,system-ui,-apple-system,"Segoe UI",sans-serif}.card{width:min(100%,440px);padding:34px;background:#fff;border:1px solid #e8eae5;border-radius:20px;box-shadow:0 20px 60px #1f29370c}.brand{color:#6d756d;font-size:13px;font-weight:700;letter-spacing:.04em}.mark{display:grid;place-items:center;width:48px;height:48px;margin:24px 0 18px;border-radius:14px;background:#eef4eb;color:#3f6848;font-size:22px}h1{margin:0 0 8px;font-size:25px;letter-spacing:-.04em}.muted{color:#70766f;margin:0 0 22px}.field{width:100%;height:50px;padding:0 14px;border:1px solid #dfe3db;border-radius:10px;font:inherit;letter-spacing:.12em}.button{width:100%;height:48px;margin-top:14px;border:0;border-radius:10px;background:#263f32;color:#fff;font:inherit;font-weight:700;font-size:14px;cursor:pointer}.error{margin:0 0 14px;padding:11px 13px;border-radius:9px;background:#fff0ee;color:#a23d32;font-size:13px}.hint{margin:16px 0 0;color:#80877e;font-size:12px}.back{display:inline-block;margin-top:18px;color:#42684a;text-decoration:none;font-size:13px}
    </style>
</head>
<body>
    <main class="card">
        <div class="brand">ANY2CONVERT</div>
        <div class="mark" aria-hidden="true">⌑</div>
        <h1>One last security check</h1>
        <p class="muted">Enter the six-digit code from your authenticator app. You can use a recovery code instead.</p>
        @if ($errors->any())
            <div class="error" role="alert">{{ $errors->first() }}</div>
        @endif
        <form method="POST" action="{{ route('auth.two-factor.verify') }}">
            @csrf
            <label for="code" class="muted" style="display:block;margin-bottom:7px">Authenticator or recovery code</label>
            <input class="field" id="code" name="code" inputmode="text" autocomplete="one-time-code" autofocus required>
            <button class="button" type="submit">Verify and continue</button>
        </form>
        <p class="hint">Signing in as {{ $email }}</p>
        <a class="back" href="{{ route('login') }}">Cancel and return to sign in</a>
    </main>
</body>
</html>
