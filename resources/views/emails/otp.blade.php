@extends('emails.layout')

@section('preheader', $preheader ?? 'Your secure Any2Convert confirmation code')

@section('content')
    <p style="margin:0 0 8px;color:#58735b;font-size:12px;font-weight:700;letter-spacing:1.2px;text-transform:uppercase">SECURITY CHECK</p>
    <h1 style="margin:0;color:#222821;font-size:25px;line-height:1.25;letter-spacing:-.5px">{{ $heading }}</h1>
    <p style="margin:14px 0 22px;color:#626a60;font-size:15px;line-height:1.65">{{ $message }}</p>
    <div style="padding:18px 16px;border:1px solid #e2e8df;border-radius:12px;background:#f7f9f5;text-align:center">
        <div style="margin-bottom:8px;color:#7b8278;font-size:11px;font-weight:700;letter-spacing:1.5px">YOUR ONE-TIME CODE</div>
        <div style="color:#263629;font-size:34px;font-weight:700;letter-spacing:8px;font-variant-numeric:tabular-nums">{{ $code }}</div>
    </div>
    <p style="margin:18px 0 0;color:#626a60;font-size:13px;line-height:1.65">This code expires in <strong>{{ $expiresIn ?? '10 minutes' }}</strong> and can only be used once.</p>
    <p style="margin:12px 0 0;color:#858b82;font-size:12px;line-height:1.6">If you didn’t request this, ignore this email. Never share this code with anyone, including our support team.</p>
@endsection
