@extends('emails.layout')

@section('preheader', $preheader)

@section('content')
    <p style="margin:0 0 8px;color:#58735b;font-size:12px;font-weight:700;letter-spacing:1.2px;text-transform:uppercase">ACCOUNT SECURITY</p>
    <h1 style="margin:0;color:#222821;font-size:25px;line-height:1.25;letter-spacing:-.5px">{{ $heading }}</h1>
    <p style="margin:14px 0 0;color:#626a60;font-size:15px;line-height:1.7">{{ $body }}</p>
    @if(!empty($actionUrl))<p style="margin:22px 0 0"><a href="{{ $actionUrl }}" style="display:inline-block;padding:12px 18px;border-radius:8px;background:#345c40;color:#fff;font-size:14px;font-weight:700;text-decoration:none">{{ $actionLabel ?? 'Review account' }}</a></p>@endif
    <p style="margin:18px 0 0;color:#858b82;font-size:12px;line-height:1.6">If you didn’t make this change, reset your password and contact support.</p>
@endsection
