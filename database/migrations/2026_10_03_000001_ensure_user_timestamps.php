<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $addCreatedAt = ! Schema::hasColumn('users', 'created_at');
        $addUpdatedAt = ! Schema::hasColumn('users', 'updated_at');

        if (! $addCreatedAt && ! $addUpdatedAt) {
            return;
        }

        Schema::table('users', function (Blueprint $table) use ($addCreatedAt, $addUpdatedAt): void {
            if ($addCreatedAt) {
                $table->timestamp('created_at')->nullable();
            }

            if ($addUpdatedAt) {
                $table->timestamp('updated_at')->nullable();
            }
        });
    }

    public function down(): void
    {
        // Keep these compatibility columns to avoid breaking existing user rows.
    }
};
