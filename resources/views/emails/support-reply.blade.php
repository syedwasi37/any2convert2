@extends('emails.layout')

@section('preheader', 'A reply from the Any2Convert support team')

@section('content')
    <p style="margin:0 0 8px;color:#58735b;font-size:12px;font-weight:700;letter-spacing:1.2px;text-transform:uppercase">SUPPORT UPDATE</p>
    <h1 style="margin:0;color:#222821;font-size:25px;line-height:1.25;letter-spacing:-.5px">We replied to your message</h1>
    <p style="margin:14px 0 8px;color:#626a60;font-size:14px;line-height:1.6">Regarding: <strong style="color:#30382f">{{ $supportMessage->subject }}</strong></p>
    <div style="margin-top:18px;padding:18px;border-left:3px solid #6a8b68;border-radius:0 10px 10px 0;background:#f7f9f5;color:#333b32;font-size:15px;line-height:1.7;white-space:pre-line">{{ $replyBody }}</div>
    @if($conversationUrl)
        <p style="margin:24px 0 0"><a href="{{ $conversationUrl }}" style="display:inline-block;padding:12px 18px;border-radius:8px;background:#345c40;color:#fff;font-size:14px;font-weight:700;text-decoration:none">Open conversation</a></p>
    @endif
    <p style="margin:18px 0 0;color:#747b72;font-size:13px;line-height:1.6">You opted in to updates for this support conversation. You can change that preference from your account.</p>
@endsection
