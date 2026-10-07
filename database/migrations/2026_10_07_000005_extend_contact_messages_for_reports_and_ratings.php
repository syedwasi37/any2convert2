<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('contact_messages')) {
            return;
        }

        Schema::table('contact_messages', function (Blueprint $table): void {
            if (! Schema::hasColumn('contact_messages', 'tool_slug')) {
                $table->string('tool_slug', 120)->nullable()->index();
            }
            if (! Schema::hasColumn('contact_messages', 'user_resolved')) {
                $table->boolean('user_resolved')->nullable();
            }
            if (! Schema::hasColumn('contact_messages', 'resolution_rating')) {
                $table->unsignedTinyInteger('resolution_rating')->nullable();
            }
            if (! Schema::hasColumn('contact_messages', 'support_rating')) {
                $table->unsignedTinyInteger('support_rating')->nullable();
            }
            if (! Schema::hasColumn('contact_messages', 'support_feedback')) {
                $table->text('support_feedback')->nullable();
            }
            if (! Schema::hasColumn('contact_messages', 'email_updates')) {
                $table->boolean('email_updates')->default(false);
            }
        });
    }

    public function down(): void
    {
        // Keep collected support history and ratings when rolling back application code.
    }
};
