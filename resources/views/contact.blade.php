<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    @include('partials.site-theme')
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index, follow">
    <title>Contact Any2Convert</title>
    <meta name="description" content="Contact Any2Convert support, report a tool issue, or share feedback.">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16.png') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    @include('partials.tailwind-assets')
    <style>
        * { box-sizing: border-box; }
        [hidden] { display: none !important; }
        body { margin: 0; background: #f6f8fb; color: #172033; font: 15px/1.5 ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; }
        a { color: inherit; }
        .contact-wrap { width: min(100% - 32px, 1060px); margin: 0 auto; padding: 24px 0 56px; }
        .brand { display: inline-flex; align-items: center; gap: 10px; text-decoration: none; font-size: 17px; font-weight: 700; }
        .brand img { width: 34px; height: 34px; object-fit: contain; }
        .contact-intro { max-width: 660px; margin: 0 auto 32px; text-align: center; }
        .eyebrow { margin: 0 0 8px; color: #2563eb; font-size: 12px; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; }
        h1 { margin: 0; color: #101828; font-size: clamp(30px, 5vw, 42px); line-height: 1.15; letter-spacing: -.035em; }
        .intro-copy { margin: 12px 0 0; color: #64748b; font-size: 16px; }
        .contact-grid { display: grid; grid-template-columns: minmax(230px, .75fr) minmax(0, 1.35fr); gap: 20px; align-items: start; }
        .panel { min-width: 0; padding: 25px; border: 1px solid #e2e8f0; border-radius: 14px; background: #fff; box-shadow: 0 8px 28px rgba(15,23,42,.04); }
        .panel h2 { margin: 0; color: #172033; font-size: 18px; letter-spacing: -.02em; }
        .panel-copy { margin: 7px 0 20px; color: #64748b; font-size: 14px; }
        .info-list { display: grid; gap: 12px; }
        .info-item { padding: 14px; border: 1px solid #e8edf4; border-radius: 10px; background: #fafbfd; }
        .info-label { display: block; margin-bottom: 3px; color: #64748b; font-size: 12px; font-weight: 600; }
        .info-value { color: #172033; font-weight: 600; overflow-wrap: anywhere; }
        .info-value a { color: #2563eb; text-decoration: none; }
        .privacy-note { margin: 16px 0 0; color: #64748b; font-size: 12px; }
        .form-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 14px; }
        .field { display: block; min-width: 0; color: #334155; font-size: 13px; font-weight: 600; }
        .field-full { grid-column: 1 / -1; }
        .field input, .field select, .field textarea { display: block; width: 100%; min-width: 0; margin-top: 6px; padding: 11px 12px; border: 1px solid #cbd5e1; border-radius: 8px; outline: none; background: #fff; color: #172033; font: inherit; font-size: 14px; }
        .field input, .field select { min-height: 44px; }
        .field textarea { min-height: 160px; resize: vertical; }
        .field input:focus, .field select:focus, .field textarea:focus { border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59,130,246,.14); }
        .field-error { display: block; margin-top: 4px; color: #b42318; font-size: 12px; font-weight: 400; }
        .form-footer { display: flex; align-items: center; justify-content: space-between; gap: 12px; margin-top: 15px; }
        .form-help { margin: 0; color: #64748b; font-size: 12px; }
        .submit-button { min-height: 44px; padding: 0 18px; border: 0; border-radius: 8px; background: #2563eb; color: #fff; font: inherit; font-weight: 600; cursor: pointer; }
        .submit-button:hover { background: #1d4ed8; }
        .notice { margin-bottom: 18px; padding: 12px 14px; border: 1px solid #a7f3d0; border-radius: 9px; background: #ecfdf5; color: #047857; font-size: 14px; }
        .honeypot { position: absolute; left: -10000px; width: 1px; height: 1px; overflow: hidden; }
        html.dark { color-scheme: dark; }
        html.dark body.contact-page { background: #111511; color: #edf0e9; }
        html.dark .panel { background: #1b201b; border-color: #343b33; box-shadow: 0 8px 28px rgba(0,0,0,.16); }
        html.dark .panel h2, html.dark h1, html.dark .info-value, html.dark .field { color: #edf0e9; }
        html.dark .intro-copy, html.dark .panel-copy, html.dark .privacy-note, html.dark .form-help, html.dark .info-label { color: #a3ab9e; }
        html.dark .info-item { background: #171c17; border-color: #343b33; }
        html.dark .field input, html.dark .field select, html.dark .field textarea { background: #171c17; color: #edf0e9; border-color: #40483f; color-scheme: dark; }
        html.dark .notice { background: #1b3024; border-color: #315b3d; color: #c7e6c8; }
        @media (max-width: 720px) { .contact-grid { grid-template-columns: 1fr; } .contact-info { order: 2; } }
        @media (max-width: 480px) { .contact-wrap { width: min(100% - 24px, 1060px); padding-top: 14px; } .panel { padding: 18px; } .form-grid { grid-template-columns: 1fr; } .field-full { grid-column: auto; } .form-footer { align-items: stretch; flex-direction: column; } .submit-button { width: 100%; } }
    </style>
</head>
<body class="contact-page">
@include('partials.site-navbar')
<main class="contact-wrap">

    <section class="contact-intro">
        <p class="eyebrow">We’re here to help</p>
        <h1>Contact our team</h1>
        <p class="intro-copy">Tell us what’s going on. Send a question, report a problem, or share an idea for a tool.</p>
    </section>

    @if (session('contact_submitted'))
        <div class="notice" role="status">Thanks for reaching out. Your message has been received. @auth You can follow the conversation in <a href="{{ route('account.messages') }}">your support messages</a>. @if(session('email_updates_enabled')) We’ll also email you when we reply. @else Email updates are off; check your support messages for replies. @endif @else We’ll email you when our team replies. @endauth</div>
    @endif

    <div class="contact-grid">
        <aside class="panel contact-info" aria-labelledby="contactInfoTitle">
            <h2 id="contactInfoTitle">Contact details</h2>
            <p class="panel-copy">Choose the way that works for you.</p>
            <div class="info-list">
                @if ($contactEmail)
                    <div class="info-item"><span class="info-label">Email</span><span class="info-value"><a href="mailto:{{ $contactEmail }}">{{ $contactEmail }}</a></span></div>
                @else
                    <div class="info-item"><span class="info-label">Email</span><span class="info-value">Use the contact form</span></div>
                @endif
                @if ($contactPhone)
                    <div class="info-item"><span class="info-label">Phone</span><span class="info-value"><a href="tel:{{ preg_replace('/[^0-9+]/', '', $contactPhone) }}">{{ $contactPhone }}</a></span></div>
                @endif
                @if ($contactHours)
                    <div class="info-item"><span class="info-label">Support hours</span><span class="info-value">{{ $contactHours }}</span></div>
                @endif
                <div class="info-item"><span class="info-label">Website</span><span class="info-value">Any2Convert online tools</span></div>
            </div>
            <p class="privacy-note">We use your details only to respond to your message. Please don’t include passwords or sensitive documents.</p>
        </aside>

        <section class="panel" aria-labelledby="contactFormTitle">
            <h2 id="contactFormTitle">Send us a message</h2>
            <p class="panel-copy">Fields marked with * are required.</p>
            <form method="post" action="{{ route('contact.store') }}">
                @csrf
                <div class="honeypot" aria-hidden="true"><label>Leave this empty<input name="website" tabindex="-1" autocomplete="off"></label></div>
                <div class="form-grid">
                    <label class="field">Your name *
                        <input name="name" value="{{ $name }}" autocomplete="name" maxlength="120" required>
                        @error('name')<span class="field-error">{{ $message }}</span>@enderror
                    </label>
                    <label class="field">Email address *
                        <input name="email" type="email" value="{{ $email }}" autocomplete="email" maxlength="255" required>
                        @error('email')<span class="field-error">{{ $message }}</span>@enderror
                    </label>
                    <label class="field">What is this about? *
                        <select name="category" id="contactCategory" required>
                            @foreach (['general' => 'General question', 'tool' => 'A tool is not working', 'account' => 'My account', 'privacy' => 'Privacy', 'feedback' => 'Feedback or idea', 'other' => 'Something else'] as $value => $label)
                                <option value="{{ $value }}" @selected($selectedCategory === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('category')<span class="field-error">{{ $message }}</span>@enderror
                    </label>
                    @guest
                        <p id="toolReportLoginNote" class="field-full privacy-note" @if($selectedCategory !== 'tool') hidden @endif>Tool reports are private tracked conversations. <a href="{{ route('login') }}">Sign in</a> before sending a tool report.</p>
                    @endguest
                    <label class="field" id="toolSelectField" @if($selectedCategory !== 'tool') hidden @endif>Which tool is affected? *
                        <select name="tool_slug" id="contactTool" @if($selectedCategory === 'tool') required @endif>
                            <option value="">Choose a tool</option>
                            @foreach ($tools as $slug)
                                <option value="{{ $slug }}" @selected($selectedTool === $slug)>{{ \Illuminate\Support\Str::headline($slug) }}</option>
                            @endforeach
                        </select>
                        @error('tool_slug')<span class="field-error">{{ $message }}</span>@enderror
                    </label>
                    <label class="field">Subject *
                        <input name="subject" value="{{ $subject }}" maxlength="180" required>
                        @error('subject')<span class="field-error">{{ $message }}</span>@enderror
                    </label>
                    <label class="field field-full">Message *
                        <textarea name="message" minlength="10" maxlength="12000" required>{{ old('message') }}</textarea>
                        @error('message')<span class="field-error">{{ $message }}</span>@enderror
                    </label>
                    <label class="field field-full" style="display:flex;align-items:flex-start;gap:9px;font-weight:500">
                        <input type="checkbox" name="email_updates" value="1" @checked(old('email_updates')) @guest required @endguest style="width:17px;height:17px;min-height:17px;margin:2px 0 0;flex:0 0 auto">
                        <span>I agree to receive email updates about this support conversation. @auth This is optional; replies are always available in your account. @else Required so our team can send its reply to you. @endauth
                            @error('email_updates')<span class="field-error">{{ $message }}</span>@enderror
                        </span>
                    </label>
                </div>
                <div class="form-footer"><p class="form-help">@auth You can change email updates for each conversation in your account. @else You can contact us without an account by opting into email replies. @endauth</p><button class="submit-button" type="submit">Send message</button></div>
            </form>
        </section>
    </div>
</main>
<script>
    (() => {
        const category = document.getElementById('contactCategory');
        const toolField = document.getElementById('toolSelectField');
        const tool = document.getElementById('contactTool');
        const toolReportLoginNote = document.getElementById('toolReportLoginNote');
        const syncToolField = () => {
            const required = category.value === 'tool';
            toolField.hidden = !required;
            tool.required = required;
            if (!required) tool.value = '';
            if (toolReportLoginNote) toolReportLoginNote.hidden = !required;
        };
        category.addEventListener('change', syncToolField);
        syncToolField();
    })();
</script>
@include('partials.site-footer')
</body>
</html>
