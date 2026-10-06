<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ContactMessage extends Model
{
    protected $fillable = [
        'user_id', 'name', 'email', 'subject', 'category', 'message', 'status', 'internal_note', 'last_replied_at',
    ];

    protected function casts(): array
    {
        return ['last_replied_at' => 'datetime'];
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
