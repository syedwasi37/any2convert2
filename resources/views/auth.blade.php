<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <meta name="theme-color" content="#f6f5f1">
    <title>{{ $mode === 'register' ? 'Create your account' : 'Welcome back' }} · Any2Convert</title>
    <link rel="icon" type="image/png" href="{{ asset('any2convertlogo.png') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root{color-scheme:light;--ink:#202321;--muted:#777d78;--line:#e8e9e4;--paper:#fff;--canvas:#f6f5f1;--green:#2f694e;--green-dark:#24553e;--soft:#edf4ef;--red:#a83d38}
        *{box-sizing:border-box}
        body{margin:0;min-height:100vh;background:var(--canvas);color:var(--ink);font-family:'DM Sans',sans-serif;-webkit-font-smoothing:antialiased}
        a{color:inherit}
        .shell{min-height:100vh;display:grid;grid-template-columns:minmax(0,1.04fr) minmax(430px,.96fr);max-width:1440px;margin:auto}
        .story{position:relative;display:flex;flex-direction:column;justify-content:space-between;min-height:100vh;padding:38px clamp(32px,6vw,88px);overflow:hidden;background:#eef1eb}
        .story:before{content:"";position:absolute;width:520px;height:520px;border:1px solid rgba(47,105,78,.12);border-radius:50%;left:-170px;bottom:-220px;box-shadow:0 0 0 44px rgba(47,105,78,.025),0 0 0 94px rgba(47,105,78,.02)}
        .brand{position:relative;z-index:1;display:inline-flex;align-items:center;gap:11px;width:max-content;text-decoration:none;font:800 17px Manrope,sans-serif;letter-spacing:-.5px}
        .brand img{width:36px;height:36px;object-fit:contain;border-radius:11px}
        .brand span{color:var(--green)}
        .story-copy{position:relative;z-index:1;max-width:500px;margin:90px 0 110px}
        .eyebrow{display:inline-flex;align-items:center;gap:8px;padding:8px 12px;border:1px solid rgba(47,105,78,.14);border-radius:999px;color:var(--green);background:rgba(255,255,255,.46);font-size:12px;font-weight:700;letter-spacing:.025em}
        .eyebrow i{width:7px;height:7px;border-radius:50%;background:#64a37b;box-shadow:0 0 0 4px rgba(100,163,123,.13)}
        h1{max-width:480px;margin:24px 0 16px;font:600 clamp(38px,5vw,64px)/1.08 Manrope,sans-serif;letter-spacing:-2.8px}
        .story-copy>p{max-width:430px;margin:0;color:#6d756e;font-size:16px;line-height:1.75}
        .proof{display:flex;align-items:center;gap:13px;margin-top:36px;color:#747c75;font-size:13px}
        .proof-mark{display:flex;align-items:center;justify-content:center;width:35px;height:35px;border-radius:50%;background:#fff;color:var(--green);box-shadow:0 2px 8px #1c382210}
        .story-foot{position:relative;z-index:1;color:#8a908a;font-size:12px}
        .panel{display:flex;align-items:center;justify-content:center;padding:48px clamp(24px,5vw,72px);background:var(--paper)}
        .auth{width:100%;max-width:430px}
        .mobile-brand{display:none}
        .auth h2{margin:0;font:700 29px/1.2 Manrope,sans-serif;letter-spacing:-1.1px}
        .intro{margin:9px 0 27px;color:var(--muted);font-size:14px;line-height:1.6}
        .tabs{display:grid;grid-template-columns:1fr 1fr;gap:4px;margin-bottom:22px;padding:4px;border-radius:11px;background:#f3f4f1}
        .tabs a{padding:10px 12px;border-radius:8px;text-align:center;text-decoration:none;color:#777d78;font-size:13px;font-weight:700;transition:background .16s,color .16s,box-shadow .16s}
        .tabs a.active{color:var(--ink);background:#fff;box-shadow:0 1px 4px #18211812}
        .google{display:flex;align-items:center;justify-content:center;gap:11px;width:100%;min-height:48px;border:1px solid #dedfdb;border-radius:10px;background:#fff;text-decoration:none;font-size:14px;font-weight:700;transition:border-color .18s,background .18s,transform .18s}
        .google:hover{border-color:#bfc5bd;background:#fcfcfa;transform:translateY(-1px)}
        .google.disabled{color:#8b918c;background:#fafbf9;border-color:#e8e9e4;cursor:not-allowed;transform:none}
        .google-note{margin:9px 0 0;color:#898e89;text-align:center;font-size:11px;line-height:1.5}
        .divider{display:flex;align-items:center;gap:13px;margin:20px 0;color:#a1a6a1;font-size:11px;font-weight:600;letter-spacing:.04em;text-transform:uppercase}
        .divider:before,.divider:after{content:"";height:1px;flex:1;background:var(--line)}
        .field{margin:0 0 15px}
        .field label{display:block;margin-bottom:7px;color:#4e554f;font-size:12px;font-weight:700}
        .field input{display:block;width:100%;height:47px;padding:0 13px;border:1px solid #dedfdb;border-radius:9px;background:#fff;color:var(--ink);font:14px 'DM Sans',sans-serif;outline:none;transition:border .16s,box-shadow .16s}
        .field input::placeholder{color:#a9ada8}
        .field input:focus{border-color:#5f9675;box-shadow:0 0 0 3px rgba(47,105,78,.11)}
        .field input[autocomplete=one-time-code]{letter-spacing:.24em;font-size:18px;font-weight:700}
        .field select{display:block;width:100%;height:47px;padding:0 12px;border:1px solid #dedfdb;border-radius:9px;background:#fff;color:var(--ink);font:14px 'DM Sans',sans-serif;outline:none}.phone-wrap{display:flex;align-items:center;height:47px;border:1px solid #dedfdb;border-radius:9px;background:#fff;overflow:hidden}.phone-wrap>span{height:100%;display:flex;align-items:center;padding:0 11px;border-right:1px solid var(--line);color:var(--green);font-size:13px;font-weight:700;white-space:nowrap}.phone-wrap input{height:45px;border:0;border-radius:0;box-shadow:none!important;min-width:0}
        .row{display:flex;align-items:center;justify-content:space-between;gap:12px;margin:1px 0 17px}
        .check{display:flex;align-items:center;gap:8px;color:#6f766f;font-size:12px}
        .check input{accent-color:var(--green)}
        .submit{width:100%;min-height:48px;border:0;border-radius:9px;background:var(--green);color:#fff;font:700 14px 'DM Sans',sans-serif;cursor:pointer;transition:background .16s,transform .16s,box-shadow .16s}
        .submit:hover{background:var(--green-dark);transform:translateY(-1px);box-shadow:0 6px 14px #24553e24}
        .switch-method{display:block;margin:16px auto 0;padding:5px;border:0;background:none;color:var(--green);font:700 12px 'DM Sans',sans-serif;cursor:pointer}
        .switch-method:hover{text-decoration:underline}
        .notice{margin:0 0 16px;padding:11px 13px;border:1px solid #cfe2d3;border-radius:9px;background:#f1f8f2;color:#2e6748;font-size:12px;line-height:1.55}
        .notice.error{border-color:#f0d2ce;background:#fff6f4;color:var(--red)}
        .error-text{margin:6px 0 0;color:var(--red);font-size:11px}
        .terms{margin:17px 0 0;color:#959a95;text-align:center;font-size:11px;line-height:1.6}
        .terms a,.back-link{color:#607268;text-decoration:underline;text-underline-offset:2px}
        .back-link{display:block;width:max-content;margin:18px auto 0;font-size:12px;font-weight:600}
        [hidden]{display:none!important}
        @media(max-width:900px){.shell{grid-template-columns:minmax(0,1fr) minmax(390px,.95fr)}.story{padding:34px 34px}.story-copy{margin:70px 0 90px}.panel{padding:38px 30px}h1{font-size:48px}}
        @media(max-width:700px){.shell{display:flex;min-height:100vh;flex-direction:column}.story{display:none}.panel{min-height:100vh;align-items:flex-start;padding:28px 22px 38px}.auth{max-width:440px;margin:auto}.mobile-brand{display:inline-flex;margin-bottom:43px}.auth h2{font-size:27px}.intro{margin-bottom:23px}}
        @media(max-width:390px){.panel{padding-right:18px;padding-left:18px}.mobile-brand{margin-bottom:34px}}
        @media(prefers-reduced-motion:reduce){*,*:before,*:after{scroll-behavior:auto!important;transition:none!important}}
    </style>
</head>
<body>
@php
    $otpSentTo = session('otp_sent_to');
    $otpMode = session('otp_mode', $mode);
    $needsName = $otpMode === 'register' || $errors->has('name');
@endphp
<div class="shell">
    <aside class="story" aria-label="About Any2Convert">
        <a class="brand" href="{{ route('home') }}"><img src="{{ asset('any2trans.webp') }}" alt=""><span>Any2Convert</span></a>
        <div class="story-copy">
            <span class="eyebrow"><i></i> A little less busywork</span>
            <h1>Your useful tools, all in one place.</h1>
            <p>Pick up where you left off. Keep your everyday conversions and quick fixes close at hand, with the privacy of browser-first tools.</p>
            <div class="proof"><span class="proof-mark" aria-hidden="true">✓</span><span>Simple tools. No clutter. Ready when you are.</span></div>
        </div>
        <div class="story-foot">© {{ date('Y') }} Any2Convert</div>
    </aside>

    <main class="panel">
        <section class="auth" aria-labelledby="auth-title">
            <a class="brand mobile-brand" href="{{ route('home') }}"><img src="{{ asset('any2trans.webp') }}" alt=""><span>Any2Convert</span></a>
            @if ($otpSentTo)
                <h2 id="auth-title">Check your inbox</h2>
                <p class="intro">Enter the six-digit code we sent to <strong>{{ $otpSentTo }}</strong>.</p>
            @else
                <h2 id="auth-title">{{ $mode === 'register' ? 'Create your account' : 'Welcome back' }}</h2>
                <p class="intro">{{ $mode === 'register' ? 'A few details and you’re ready to go.' : 'Sign in to get back to your workspace.' }}</p>
                <nav class="tabs" aria-label="Account access">
                    <a href="{{ route('login') }}" @class(['active' => $mode === 'login']) @if($mode === 'login') aria-current="page" @endif>Sign in</a>
                    <a href="{{ route('register') }}" @class(['active' => $mode === 'register']) @if($mode === 'register') aria-current="page" @endif>Create account</a>
                </nav>
            @endif

            @if (session('status'))
                <div class="notice" role="status">{{ session('status') }}</div>
            @endif
            @if ($errors->has('google'))
                <div class="notice error" role="alert">{{ $errors->first('google') }}</div>
            @endif
            @if ($errors->has('email') && $otpSentTo)
                <div class="notice error" role="alert">{{ $errors->first('email') }}</div>
            @endif

            @if ($otpSentTo)
                <form method="POST" action="{{ route('auth.otp.verify') }}">
                    @csrf
                    <input type="hidden" name="email" value="{{ $otpSentTo }}">
                    <input type="hidden" name="mode" value="{{ $otpMode }}">
                    @if ($needsName)
                        <div class="field">
                            <label for="name">Your name</label>
                            <input id="name" name="name" type="text" autocomplete="name" maxlength="120" value="{{ old('name', session('otp_name')) }}" placeholder="Sam Taylor" required>
                            @error('name')<p class="error-text">{{ $message }}</p>@enderror
                        </div>
                    @else
                        <input type="hidden" name="name" value="{{ session('otp_name') }}">
                    @endif
                    @if ($otpMode === 'register')
                        <input type="hidden" name="country_code" value="{{ old('country_code', session('otp_country_code')) }}">
                        <input type="hidden" name="phone" value="{{ old('phone', session('otp_phone_local')) }}">
                    @endif
                    <div class="field">
                        <label for="code">Sign-in code</label>
                        <input id="code" name="code" type="text" inputmode="numeric" autocomplete="one-time-code" pattern="[0-9]{6}" minlength="6" maxlength="6" placeholder="000000" required autofocus>
                        @error('code')<p class="error-text">{{ $message }}</p>@enderror
                    </div>
                    <button class="submit" type="submit">Continue securely</button>
                </form>
                <form method="POST" action="{{ route('auth.otp.send') }}" style="margin-top:10px">
                    @csrf
                    <input type="hidden" name="email" value="{{ $otpSentTo }}">
                    <input type="hidden" name="name" value="{{ session('otp_name') }}">
                    <input type="hidden" name="mode" value="{{ $otpMode }}">
                    @if ($otpMode === 'register')
                        <input type="hidden" name="country_code" value="{{ session('otp_country_code') }}">
                        <input type="hidden" name="phone" value="{{ session('otp_phone_local') }}">
                    @endif
                    <button class="switch-method" type="submit">Send a new code</button>
                </form>
                <a class="back-link" href="{{ route($otpMode === 'register' ? 'register' : 'login') }}">Use another sign-in method</a>
            @else
                @if ($googleEnabled)
                    <a class="google" href="{{ route('auth.google.redirect') }}">
                        <svg width="18" height="18" viewBox="0 0 48 48" aria-hidden="true"><path fill="#4285F4" d="M43.6 24.5c0-1.4-.1-2.8-.4-4.1H24v7.8h11a9.5 9.5 0 0 1-4.1 6.2v5h6.6c3.9-3.6 6.1-8.8 6.1-14.9z"/><path fill="#34A853" d="M24 44c5.5 0 10.2-1.8 13.6-4.9l-6.6-5c-1.8 1.2-4.1 2-7 2-5.4 0-10-3.7-11.7-8.6H5.5v5.2A20.5 20.5 0 0 0 24 44z"/><path fill="#FBBC05" d="M12.3 27.5a12.4 12.4 0 0 1 0-7V15.3H5.5a20.5 20.5 0 0 0 0 17.4l6.8-5.2z"/><path fill="#EA4335" d="M24 11.9c3 0 5.7 1 7.8 3.1l5.9-5.9C34.2 5.7 29.5 4 24 4A20.5 20.5 0 0 0 5.5 15.3l6.8 5.2c1.7-4.9 6.3-8.6 11.7-8.6z"/></svg>
                        Continue with Google
                    </a>
                @else
                    <span class="google disabled" aria-disabled="true" title="Google OAuth credentials are not set in this environment">
                        <svg width="18" height="18" viewBox="0 0 48 48" aria-hidden="true"><path fill="#4285F4" d="M43.6 24.5c0-1.4-.1-2.8-.4-4.1H24v7.8h11a9.5 9.5 0 0 1-4.1 6.2v5h6.6c3.9-3.6 6.1-8.8 6.1-14.9z"/><path fill="#34A853" d="M24 44c5.5 0 10.2-1.8 13.6-4.9l-6.6-5c-1.8 1.2-4.1 2-7 2-5.4 0-10-3.7-11.7-8.6H5.5v5.2A20.5 20.5 0 0 0 24 44z"/><path fill="#FBBC05" d="M12.3 27.5a12.4 12.4 0 0 1 0-7V15.3H5.5a20.5 20.5 0 0 0 0 17.4l6.8-5.2z"/><path fill="#EA4335" d="M24 11.9c3 0 5.7 1 7.8 3.1l5.9-5.9C34.2 5.7 29.5 4 24 4A20.5 20.5 0 0 0 5.5 15.3l6.8 5.2c1.7-4.9 6.3-8.6 11.7-8.6z"/></svg>
                        Continue with Google
                    </span>
                    <p class="google-note">Google sign-in will appear here when OAuth credentials are set for this environment.</p>
                @endif

                <div class="divider">or use your email</div>

                @if ($mode === 'login')
                    <form id="password-form" method="POST" action="{{ route('auth.login') }}" @if(request('method') === 'otp' || old('mode') === 'login') hidden @endif>
                        @csrf
                        <div class="field">
                            <label for="login-email">Email address</label>
                            <input id="login-email" name="email" type="email" autocomplete="email" value="{{ old('email') }}" placeholder="you@example.com" required>
                            @error('email')<p class="error-text">{{ $message }}</p>@enderror
                        </div>
                        <div class="field">
                            <label for="login-password">Password</label>
                            <input id="login-password" name="password" type="password" autocomplete="current-password" placeholder="Your password" required>
                            @error('password')<p class="error-text">{{ $message }}</p>@enderror
                        </div>
                        <div class="row"><label class="check"><input type="checkbox" name="remember" value="1"> Keep me signed in</label></div>
                        <button class="submit" type="submit">Sign in</button>
                        <button class="switch-method" type="button" data-show="otp-form">Use a one-time email code</button>
                    </form>
                    <form id="otp-form" method="POST" action="{{ route('auth.otp.send') }}" @if(request('method') !== 'otp' && old('mode') !== 'login') hidden @endif>
                        @csrf
                        <input type="hidden" name="mode" value="login">
                        <div class="field">
                            <label for="otp-email">Email address</label>
                            <input id="otp-email" name="email" type="email" autocomplete="email" value="{{ old('email') }}" placeholder="you@example.com" required>
                            @error('email')<p class="error-text">{{ $message }}</p>@enderror
                        </div>
                        <button class="submit" type="submit">Email me a sign-in code</button>
                        <button class="switch-method" type="button" data-show="password-form">Use my password instead</button>
                    </form>
                @else
                    <form id="password-form" method="POST" action="{{ route('auth.register') }}" @if(old('mode') === 'register') hidden @endif>
                        @csrf
                        <div class="field">
                            <label for="register-name">Your name</label>
                            <input id="register-name" name="name" type="text" autocomplete="name" maxlength="120" value="{{ old('name') }}" placeholder="Sam Taylor" required>
                            @error('name')<p class="error-text">{{ $message }}</p>@enderror
                        </div>
                        <div class="field">
                            <label for="register-email">Email address</label>
                            <input id="register-email" name="email" type="email" autocomplete="email" value="{{ old('email') }}" placeholder="you@example.com" required>
                            @error('email')<p class="error-text">{{ $message }}</p>@enderror
                        </div>
                        @include('partials.country-phone-fields', ['fieldPrefix' => 'register-password', 'countries' => $countries, 'selectedCountry' => old('country_code'), 'phoneValue' => old('phone'), 'required' => true])
                        <div class="field">
                            <label for="register-password">Create a password</label>
                            <input id="register-password" name="password" type="password" autocomplete="new-password" minlength="8" placeholder="At least 8 characters" required>
                            @error('password')<p class="error-text">{{ $message }}</p>@enderror
                        </div>
                        <div class="field">
                            <label for="register-password-confirmation">Confirm password</label>
                            <input id="register-password-confirmation" name="password_confirmation" type="password" autocomplete="new-password" minlength="8" placeholder="Type it once more" required>
                        </div>
                        <button class="submit" type="submit">Create my account</button>
                        <button class="switch-method" type="button" data-show="otp-form">Create an account with an email code</button>
                    </form>
                    <form id="otp-form" method="POST" action="{{ route('auth.otp.send') }}" @if(old('mode') !== 'register') hidden @endif>
                        @csrf
                        <input type="hidden" name="mode" value="register">
                        <div class="field">
                            <label for="otp-name">Your name</label>
                            <input id="otp-name" name="name" type="text" autocomplete="name" maxlength="120" value="{{ old('name') }}" placeholder="Sam Taylor" required>
                            @error('name')<p class="error-text">{{ $message }}</p>@enderror
                        </div>
                        <div class="field">
                            <label for="otp-email">Email address</label>
                            <input id="otp-email" name="email" type="email" autocomplete="email" value="{{ old('email') }}" placeholder="you@example.com" required>
                            @error('email')<p class="error-text">{{ $message }}</p>@enderror
                        </div>
                        @include('partials.country-phone-fields', ['fieldPrefix' => 'register-otp', 'countries' => $countries, 'selectedCountry' => old('country_code'), 'phoneValue' => old('phone'), 'required' => true])
                        <button class="submit" type="submit">Email me a sign-up code</button>
                        <button class="switch-method" type="button" data-show="password-form">Use a password instead</button>
                    </form>
                @endif

                <p class="terms">By continuing, you agree to our <a href="{{ url('/terms') }}">Terms</a> and <a href="{{ url('/privacy') }}">Privacy Policy</a>.</p>
            @endif
        </section>
    </main>
</div>
<script>
    document.querySelectorAll('[data-country-select]').forEach((select) => {
        const wrapper = select.closest('.field')?.parentElement;
        const prefix = wrapper?.querySelector('[data-phone-prefix]');
        const updatePrefix = () => { if (prefix) prefix.textContent = select.selectedOptions[0]?.dataset.dial || 'Code'; };
        select.addEventListener('change', updatePrefix);
        updatePrefix();
    });
    document.querySelectorAll('[data-show]').forEach((button) => {
        button.addEventListener('click', () => {
            document.querySelectorAll('#password-form, #otp-form').forEach((form) => { form.hidden = form.id !== button.dataset.show; });
            const firstInput = document.querySelector(`#${button.dataset.show} input:not([type=hidden])`);
            firstInput?.focus();
        });
    });
</script>
</body>
</html>
