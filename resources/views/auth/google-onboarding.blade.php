<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <meta name="theme-color" content="#f6f5f1">
    <title>Finish your profile · Any2Convert</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16.png') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <style>
        *{box-sizing:border-box}body{margin:0;min-height:100vh;background:#f6f5f1;color:#202321;font-family:ui-sans-serif,system-ui,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;display:grid;place-items:center;padding:24px}.card{width:min(100%,510px);padding:36px;background:white;border:1px solid #e8e9e4;border-radius:20px;box-shadow:0 24px 70px #1f2d2010}.brand{display:flex;align-items:center;gap:10px;color:#2f694e;text-decoration:none;font:800 16px ui-sans-serif,system-ui,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif}.brand img{width:33px;height:33px;object-fit:contain}.step{display:inline-block;margin-top:29px;color:#2f694e;font-size:11px;font-weight:700;letter-spacing:.14em;text-transform:uppercase}.card h1{margin:8px 0;font:700 30px/1.2 ui-sans-serif,system-ui,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;letter-spacing:-1px}.intro{margin:0 0 23px;color:#777d78;font-size:14px;line-height:1.6}.google-id{display:flex;align-items:center;gap:11px;padding:11px 13px;margin-bottom:20px;border-radius:10px;background:#f7f8f6}.google-id img,.avatar-fallback{width:35px;height:35px;border-radius:50%;object-fit:cover}.avatar-fallback{display:grid;place-items:center;background:#e7f0e8;color:#2f694e;font-weight:700}.google-id strong{display:block;font-size:13px}.google-id span{display:block;color:#777d78;font-size:12px}.field{margin-bottom:14px}.field label{display:block;margin:0 0 7px;color:#4e554f;font-size:12px;font-weight:700}.field input,.field select{display:block;width:100%;height:47px;padding:0 12px;border:1px solid #dedfdb;border-radius:9px;background:#fff;color:#202321;font:14px ui-sans-serif,system-ui,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif}.phone-wrap{display:flex;align-items:center;height:47px;border:1px solid #dedfdb;border-radius:9px;overflow:hidden}.phone-wrap>span{height:100%;display:flex;align-items:center;padding:0 11px;border-right:1px solid #e8e9e4;color:#2f694e;font-size:13px;font-weight:700;white-space:nowrap}.phone-wrap input{height:45px;border:0;border-radius:0;min-width:0}.help{color:#898e89;font-size:11px}.error{padding:10px 12px;margin:0 0 15px;border:1px solid #f0d2ce;border-radius:9px;background:#fff6f4;color:#a83d38;font-size:12px}.submit{width:100%;height:48px;margin-top:6px;border:0;border-radius:9px;background:#2f694e;color:#fff;font:700 14px ui-sans-serif,system-ui,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;cursor:pointer}.foot{margin:15px 0 0;color:#989d98;text-align:center;font-size:11px}.foot a{color:#607268;text-underline-offset:2px}@media(max-width:520px){body{padding:12px}.card{padding:25px 20px}.card h1{font-size:27px}}
    </style>
</head>
<body>
<main class="card">
    <a class="brand" href="{{ route('home') }}"><img src="{{ asset('any2trans.webp') }}" alt=""><span>Any2Convert</span></a>
    <span class="step">One quick step · Profile setup</span>
    <h1>Finish setting up your account</h1>
    <p class="intro">Your Google email is connected. Add the name and phone details you’d like us to keep with your account.</p>
    @if ($errors->any())<div class="error" role="alert">{{ $errors->first() }}</div>@endif
    <div class="google-id">
        @if (!empty($googleProfile['google_avatar_url']))<img src="{{ $googleProfile['google_avatar_url'] }}" alt="" referrerpolicy="no-referrer">@else<div class="avatar-fallback">{{ mb_strtoupper(mb_substr($googleProfile['google_name'] ?: $googleProfile['email'], 0, 1)) }}</div>@endif
        <div><strong>{{ $googleProfile['email'] }}</strong><span>Verified with Google</span></div>
    </div>
    <form method="POST" action="{{ route('auth.google.onboarding.finish') }}">
        @csrf
        <div class="field"><label for="name">Name</label><input id="name" name="name" value="{{ old('name', $googleProfile['google_name']) }}" maxlength="120" autocomplete="name" required></div>
        <div class="field"><label>Email address</label><input value="{{ $googleProfile['email'] }}" readonly></div>
        @include('partials.country-phone-fields', ['fieldPrefix' => 'google-signup', 'countries' => $countries, 'selectedCountry' => old('country_code'), 'phoneValue' => old('phone'), 'required' => true])
        <p class="help" style="margin:2px 0 12px">Choose your country first; its calling code will be added to your number. We don’t verify phone numbers by SMS.</p>
        <button class="submit" type="submit">Save details and continue</button>
    </form>
    <p class="foot">Not you? <a href="{{ route('login') }}">Cancel and return to sign in</a></p>
</main>
</body>
</html>
