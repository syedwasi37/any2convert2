<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $missing = collect([
            'phone' => ! Schema::hasColumn('users', 'phone'),
            'google_avatar_url' => ! Schema::hasColumn('users', 'google_avatar_url'),
            'two_factor_secret' => ! Schema::hasColumn('users', 'two_factor_secret'),
            'two_factor_recovery_codes' => ! Schema::hasColumn('users', 'two_factor_recovery_codes'),
            'two_factor_confirmed_at' => ! Schema::hasColumn('users', 'two_factor_confirmed_at'),
            'isPremium' => ! Schema::hasColumn('users', 'isPremium'),
            'premium_plan' => ! Schema::hasColumn('users', 'premium_plan'),
            'premium_expires_at' => ! Schema::hasColumn('users', 'premium_expires_at'),
            'premium_features' => ! Schema::hasColumn('users', 'premium_features'),
        ])->filter()->keys()->all();

        if ($missing === []) {
            return;
        }

        Schema::table('users', function (Blueprint $table) use ($missing): void {
            foreach ($missing as $column) {
                match ($column) {
                    'phone' => $table->string('phone', 32)->nullable(),
                    'google_avatar_url', 'two_factor_secret', 'two_factor_recovery_codes' => $table->text($column)->nullable(),
                    'two_factor_confirmed_at', 'premium_expires_at' => $table->timestamp($column)->nullable(),
                    'isPremium' => $table->boolean('isPremium')->default(false),
                    'premium_plan' => $table->string('premium_plan', 32)->nullable(),
                    'premium_features' => $table->json('premium_features')->nullable(),
                };
            }
        });
    }

    public function down(): void
    {
        // These account and entitlement fields may contain customer data; keep them on rollback.
    }
};
