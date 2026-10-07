<!doctype html>
<html lang="en">
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"></head>
<body style="margin:0;background:#f4f5f2;color:#222821;font-family:Arial,Helvetica,sans-serif;-webkit-font-smoothing:antialiased">
    <div style="display:none;max-height:0;overflow:hidden;opacity:0">@yield('preheader')</div>
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#f4f5f2;padding:32px 14px">
        <tr><td align="center">
            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width:560px;background:#fff;border:1px solid #e5e8e1;border-radius:16px;overflow:hidden">
                <tr><td style="padding:24px 30px;border-bottom:1px solid #edf0ea">
                    <div style="font-size:18px;font-weight:700;letter-spacing:-.4px;color:#20271f">Any2Convert</div>
                    <div style="margin-top:4px;font-size:12px;color:#72796f">Simple tools for everyday files</div>
                </td></tr>
                <tr><td style="padding:32px 30px">@yield('content')</td></tr>
                <tr><td style="padding:18px 30px;background:#fafbf9;border-top:1px solid #edf0ea;color:#7a8077;font-size:12px;line-height:1.6">
                    This message was sent by Any2Convert. If you need help, visit <a href="{{ url('/contact') }}" style="color:#365d42;text-decoration:underline">our contact page</a>.
                </td></tr>
            </table>
        </td></tr>
    </table>
</body>
</html>
