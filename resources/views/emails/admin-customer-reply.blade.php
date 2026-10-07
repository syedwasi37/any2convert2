@extends('emails.layout')

@section('preheader', 'A customer replied to a support conversation')

@section('content')
    <p style="margin:0 0 8px;color:#58735b;font-size:12px;font-weight:700;letter-spacing:1.2px;text-transform:uppercase">SUPPORT INBOX</p>
    <h1 style="margin:0;color:#222821;font-size:25px;line-height:1.25;letter-spacing:-.5px">A customer replied</h1>
    <p style="margin:15px 0 5px;color:#626a60;font-size:14px">{{ $contactMessage->name }} · {{ $contactMessage->email }}</p>
    <p style="margin:0;color:#30382f;font-size:16px;font-weight:700">{{ $contactMessage->subject }}</p>
    <div style="margin-top:16px;padding:16px;border:1px solid #e7ebe4;border-radius:10px;color:#424a40;font-size:14px;line-height:1.65;white-space:pre-line">{{ $replyBody }}</div>
    <p style="margin:22px 0 0"><a href="{{ $inboxUrl }}" style="display:inline-block;padding:12px 18px;border-radius:8px;background:#345c40;color:#fff;font-size:14px;font-weight:700;text-decoration:none">Open conversation</a></p>
@endsection
