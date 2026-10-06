<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('contact_messages') && ! Schema::hasColumn('contact_messages', 'updated_at')) {
            Schema::table('contact_messages', function (Blueprint $table): void {
                $table->timestamp('updated_at')->nullable();
            });
        }
    }

    public function down(): void
    {
        // Keep the timestamp on rollback because the existing admin inbox updates messages.
    }
};
