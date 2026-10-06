@extends('admin.contact.layout')
@section('title', $message->subject)
@section('content')
<div class="admin-heading">
    <div><a href="{{ route('admin.contact.index') }}" class="admin-muted" style="display:inline-block;margin-bottom:9px;text-decoration:none">← Inbox</a><h1>{{ $message->subject }}</h1><p>From {{ $message->name }} · <a href="mailto:{{ $message->email }}">{{ $message->email }}</a> · {{ $message->created_at?->format('M j, Y · g:i a') ?? 'Date unavailable' }}</p></div>
    <span class="admin-status {{ $message->status }}">{{ str_replace('_', ' ', ucfirst($message->status)) }}</span>
</div>
<div style="display:grid;grid-template-columns:minmax(0,1.5fr) minmax(260px,.8fr);gap:16px;align-items:start">
    <div style="display:grid;gap:16px;min-width:0">
        <section class="admin-panel"><div class="admin-muted" style="margin-bottom:8px;font-size:12px">{{ ucfirst($message->category) }} · Original message</div><div style="white-space:pre-wrap;overflow-wrap:anywhere">{{ $message->message }}</div></section>
        <section class="admin-panel">
            <h2 style="margin:0 0 14px;font-size:17px">Conversation</h2>
            @forelse ($message->replies as $reply)
                <article style="padding:13px 0;border-top:1px solid #e2e8f0">
                    <div style="display:flex;justify-content:space-between;gap:12px;align-items:center;flex-wrap:wrap"><strong>{{ $reply->author?->name ?? 'Admin' }}</strong><span class="admin-status {{ $reply->delivery_status === 'sent' ? 'replied' : 'in_progress' }}">{{ $reply->delivery_status === 'sent' ? 'Sent' : ucfirst($reply->delivery_status) }}</span></div>
                    <time class="admin-muted" style="display:block;margin:3px 0 8px;font-size:12px">{{ $reply->sent_at?->format('M j, Y · g:i a') ?? $reply->created_at?->format('M j, Y · g:i a') ?? 'Date unavailable' }}</time>
                    <div style="white-space:pre-wrap;overflow-wrap:anywhere">{{ $reply->body }}</div>
                    @if ($reply->delivery_status !== 'sent')
                        <form method="post" action="{{ route('admin.contact.resend', [$message, $reply]) }}" style="margin-top:10px">@csrf<button class="admin-button" type="submit">Resend reply</button></form>
                    @endif
                </article>
            @empty
                <p class="admin-muted">No replies yet.</p>
            @endforelse
            <form method="post" action="{{ route('admin.contact.reply', $message) }}" style="margin-top:14px;padding-top:15px;border-top:1px solid #e2e8f0">
                @csrf<label class="admin-label" for="replyBody">Write a reply</label>
                <textarea class="admin-control" id="replyBody" name="body" rows="7" maxlength="12000" required>{{ old('body') }}</textarea>
                @error('body')<div class="admin-field-error">{{ $message }}</div>@enderror
                <div class="admin-muted" style="margin:6px 0 12px;font-size:12px">This is saved to the conversation and emailed to {{ $message->email }} when mail delivery is configured.</div>
                <button class="admin-button primary" type="submit">Save and send reply</button>
            </form>
        </section>
    </div>
    <aside style="display:grid;gap:16px">
        <section class="admin-panel">
            <h2 style="margin:0 0 14px;font-size:16px">Message details</h2>
            <form method="post" action="{{ route('admin.contact.update', $message) }}">@csrf @method('PATCH')
                <label class="admin-label" for="senderName">Name</label><input class="admin-control" id="senderName" name="name" value="{{ old('name', $message->name) }}" maxlength="120" required>
                <label class="admin-label" for="senderEmail" style="margin-top:12px">Reply email</label><input class="admin-control" id="senderEmail" name="email" type="email" value="{{ old('email', $message->email) }}" maxlength="255" required>
                <label class="admin-label" for="messageSubject" style="margin-top:12px">Subject</label><input class="admin-control" id="messageSubject" name="subject" value="{{ old('subject', $message->subject) }}" maxlength="180" required>
                <label class="admin-label" for="messageCategory" style="margin-top:12px">Topic</label><select class="admin-control" id="messageCategory" name="category">@foreach (['general', 'tool', 'account', 'privacy', 'feedback', 'other'] as $category)<option value="{{ $category }}" @selected(old('category', $message->category) === $category)>{{ ucfirst($category) }}</option>@endforeach</select>
                <label class="admin-label" for="status">Status</label>
                <select class="admin-control" id="status" name="status">@foreach ($statuses as $status)<option value="{{ $status }}" @selected(old('status', $message->status) === $status)>{{ str_replace('_', ' ', ucfirst($status)) }}</option>@endforeach</select>
                <label class="admin-label" for="internalNote" style="margin-top:14px">Private note</label>
                <textarea class="admin-control" id="internalNote" name="internal_note" rows="6" maxlength="12000" placeholder="Only admins can see this note">{{ old('internal_note', $message->internal_note) }}</textarea>
                <button class="admin-button" type="submit" style="margin-top:12px">Save details</button>
            </form>
        </section>
        <section class="admin-panel">
            <h2 style="margin:0 0 7px;font-size:16px">Delete message</h2><p class="admin-muted" style="margin:0 0 12px;font-size:13px">This permanently deletes the message and its replies.</p>
            <form method="post" action="{{ route('admin.contact.destroy', $message) }}" onsubmit="return confirm('Permanently delete this message and all replies?')">@csrf @method('DELETE')<button class="admin-button danger" type="submit">Delete message</button></form>
        </section>
    </aside>
</div>
<style>@media(max-width:760px){main>div[style*="grid-template-columns:minmax(0,1.5fr"]{grid-template-columns:1fr!important}}</style>
@endsection
