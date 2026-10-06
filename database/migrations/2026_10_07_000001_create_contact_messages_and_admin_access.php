<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('users', 'is_admin')) {
            Schema::table('users', function (Blueprint $table): void {
                $table->boolean('is_admin')->default(false)->index();
            });
        }

        if (! Schema::hasTable('contact_messages')) {
            Schema::create('contact_messages', function (Blueprint $table): void {
                $table->id();
                $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
                $table->string('name', 120);
                $table->string('email', 255)->index();
                $table->string('subject', 180);
                $table->string('category', 40)->default('general');
                $table->text('message');
                $table->string('status', 24)->default('new')->index();
                $table->text('internal_note')->nullable();
                $table->timestamp('last_replied_at')->nullable();
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('contact_message_replies')) {
            Schema::create('contact_message_replies', function (Blueprint $table): void {
                $table->id();
                $table->foreignId('contact_message_id')->constrained()->cascadeOnDelete();
                $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
                $table->text('body');
                $table->string('delivery_status', 24)->default('pending')->index();
                $table->timestamp('sent_at')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_message_replies');
        Schema::dropIfExists('contact_messages');
        if (Schema::hasColumn('users', 'is_admin')) {
            Schema::table('users', function (Blueprint $table): void {
                $table->dropColumn('is_admin');
            });
        }
    }
};
