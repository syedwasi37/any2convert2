<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'google_id', 'google_avatar_url', 'phone'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'phone' => 'string',
            'google_avatar_url' => 'string',
            'two_factor_secret' => 'encrypted',
            'two_factor_recovery_codes' => 'encrypted:array',
            'two_factor_confirmed_at' => 'datetime',
            'isPremium' => 'boolean',
            'premium_expires_at' => 'datetime',
            'premium_features' => 'array',
        ];
    }

    public function hasTwoFactorEnabled(): bool
    {
        return filled($this->two_factor_secret) && $this->two_factor_confirmed_at !== null;
    }

    public function hasPremiumAccess(): bool
    {
        return (bool) $this->isPremium
            && ($this->premium_expires_at === null || $this->premium_expires_at->isFuture());
    }

    public function hasPremiumFeature(string $feature): bool
    {
        if (! $this->hasPremiumAccess()) {
            return false;
        }

        $features = $this->premium_features ?? ['ad_free'];

        return in_array($feature, $features, true);
    }
}
