@extends('admin.contact.layout')
@section('title', $message->subject)
@section('content')
<div class="admin-heading">
    <div><a href="{{ route('admin.contact.index') }}" class="admin-muted" style="display:inline-block;margin-bottom:9px;text-decoration:none">← Inbox</a><h1>{{ $message->subject }}</h1><p>From {{ $message->name }} · <a href="mailto:{{ $message->email }}">{{ $message->email }}</a> · {{ $message->created_at?->format('M j, Y · g:i a') ?? 'Date unavailable' }}</p></div>
    <span class="admin-status {{ $message->status }}">{{ str_replace('_', ' ', ucfirst($message->status)) }}</span>
</div>
<div style="display:grid;grid-template-columns:minmax(0,1.5fr) minmax(260px,.8fr);gap:16px;align-items:start">
    <div style="display:grid;gap:16px;min-width:0">
        <section class="admin-panel"><div class="admin-muted" style="margin-bottom:8px;font-size:12px">{{ ucfirst($message->category) }}@if($message->tool_slug) · Tool: {{ \Illuminate\Support\Str::headline($message->tool_slug) }}@endif · Original message</div><div style="white-space:pre-wrap;overflow-wrap:anywhere">{{ $message->message }}</div>
            @if (!is_null($message->user_resolved))<div class="admin-muted" style="margin-top:12px"><strong>Customer says:</strong> {{ $message->user_resolved ? 'Issue resolved' : 'Issue still needs help' }}</div>@endif
            @if ($message->resolution_rating || $message->support_rating || $message->support_feedback)
                <div style="margin-top:14px;padding-top:12px;border-top:1px solid #e2e8f0"><strong>Customer rating</strong><div class="admin-muted" style="margin-top:5px">Resolution: {{ $message->resolution_rating ? $message->resolution_rating.' / 5 stars' : 'Not rated' }} · Support: {{ $message->support_rating ? $message->support_rating.' / 5 stars' : 'Not rated' }}</div>@if($message->support_feedback)<div style="white-space:pre-wrap;margin-top:7px">{{ $message->support_feedback }}</div>@endif</div>
            @endif
        </section>
        <section class="admin-panel">
            <h2 style="margin:0 0 14px;font-size:17px">Conversation</h2>
            @forelse ($message->replies as $reply)
                <article style="padding:13px 0;border-top:1px solid #e2e8f0">
                    <div style="display:flex;justify-content:space-between;gap:12px;align-items:center;flex-wrap:wrap"><strong>{{ $reply->author?->isAdmin() ? ($reply->author->name ?? 'Admin') : ($reply->author?->name ?? 'Customer') }}</strong><span class="admin-status {{ in_array($reply->delivery_status, ['sent', 'received', 'not_requested'], true) ? 'replied' : 'in_progress' }}">{{ $reply->delivery_status === 'received' ? 'Customer reply' : ($reply->delivery_status === 'not_requested' ? 'Email not requested' : ($reply->delivery_status === 'sent' ? 'Sent' : ucfirst($reply->delivery_status))) }}</span></div>
                    <time class="admin-muted" style="display:block;margin:3px 0 8px;font-size:12px">{{ $reply->sent_at?->format('M j, Y · g:i a') ?? $reply->created_at?->format('M j, Y · g:i a') ?? 'Date unavailable' }}</time>
                    <div style="white-space:pre-wrap;overflow-wrap:anywhere">{{ $reply->body }}</div>
                    <details style="margin-top:10px"><summary class="admin-muted" style="cursor:pointer;font-size:12px">Edit this message</summary><form method="post" action="{{ route('admin.contact.reply.update', [$message, $reply]) }}" style="margin-top:8px">@csrf @method('PATCH')<textarea class="admin-control" name="body" rows="4" maxlength="12000" required>{{ $reply->body }}</textarea><button class="admin-button" type="submit" style="margin-top:7px">Save edit</button></form></details>
                    <form method="post" action="{{ route('admin.contact.reply.delete', [$message, $reply]) }}" style="margin-top:7px" onsubmit="return confirm('Delete this conversation message?')">@csrf @method('DELETE')<button class="admin-button danger" type="submit">Delete message</button></form>
                    @if ($message->email_updates && $reply->author?->isAdmin() && $reply->delivery_status !== 'sent')
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
                <div class="admin-muted" style="margin:6px 0 12px;font-size:12px">This reply will appear in the customer’s conversation. Email updates are {{ $message->email_updates ? 'enabled' : 'off' }} for this message.</div>
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
                <label class="admin-label" for="messageTool" style="margin-top:12px">Related tool (for tool reports)</label><select class="admin-control" id="messageTool" name="tool_slug"><option value="">No tool selected</option>@foreach($tools as $slug)<option value="{{ $slug }}" @selected(old('tool_slug', $message->tool_slug) === $slug)>{{ \Illuminate\Support\Str::headline($slug) }}</option>@endforeach</select>
                <label class="admin-label" for="originalMessage" style="margin-top:12px">Original message</label><textarea class="admin-control" id="originalMessage" name="message" rows="7" maxlength="12000" required>{{ old('message', $message->message) }}</textarea>
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
