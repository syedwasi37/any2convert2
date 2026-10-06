<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('users')) {
            foreach ([
                'is_blocked' => fn (Blueprint $table) => $table->boolean('is_blocked')->default(false),
                'is_restricted' => fn (Blueprint $table) => $table->boolean('is_restricted')->default(false),
                'restriction_note' => fn (Blueprint $table) => $table->string('restriction_note', 500)->nullable(),
                'blocked_at' => fn (Blueprint $table) => $table->timestamp('blocked_at')->nullable(),
                'restricted_at' => fn (Blueprint $table) => $table->timestamp('restricted_at')->nullable(),
            ] as $column => $addColumn) {
                if (! Schema::hasColumn('users', $column)) {
                    Schema::table('users', function (Blueprint $table) use ($addColumn): void {
                        $addColumn($table);
                    });
                }
            }
        }

        if (! Schema::hasTable('site_analytics_events')) {
            Schema::create('site_analytics_events', function (Blueprint $table): void {
                $table->bigIncrements('id');
                $table->string('event_type', 24)->index();
                $table->string('event_value', 160)->nullable();
                $table->timestamp('created_at')->useCurrent()->index();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('site_analytics_events');
        // Keep user moderation fields on rollback to avoid unexpectedly
        // restoring access to accounts an administrator has blocked.
    }
};
