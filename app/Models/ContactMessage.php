<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ContactMessage extends Model
{
    protected $fillable = [
        'user_id', 'name', 'email', 'subject', 'category', 'tool_slug', 'message', 'status', 'internal_note', 'last_replied_at', 'user_resolved', 'resolution_rating', 'support_rating', 'support_feedback', 'email_updates',
    ];

    protected function casts(): array
    {
        return [
            'last_replied_at' => 'datetime',
            'user_resolved' => 'boolean',
            'resolution_rating' => 'integer',
            'support_rating' => 'integer',
            'email_updates' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function replies(): HasMany
    {
        return $this->hasMany(ContactMessageReply::class)->orderBy('created_at');
    }
}
