<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $missing = collect([
            'country_code' => ! Schema::hasColumn('users', 'country_code'),
            'country_name' => ! Schema::hasColumn('users', 'country_name'),
            'phone_country_code' => ! Schema::hasColumn('users', 'phone_country_code'),
            'google_avatar_url' => ! Schema::hasColumn('users', 'google_avatar_url'),
        ])->filter()->keys()->all();

        if ($missing === []) {
            return;
        }

        Schema::table('users', function (Blueprint $table) use ($missing): void {
            foreach ($missing as $column) {
                match ($column) {
                    'country_code' => $table->char('country_code', 2)->nullable(),
                    'country_name' => $table->string('country_name', 100)->nullable(),
                    'phone_country_code' => $table->string('phone_country_code', 8)->nullable(),
                    'google_avatar_url' => $table->text('google_avatar_url')->nullable(),
                };
            }
        });
    }

    public function down(): void
    {
        // Preserve user profile details during rollback.
    }
};
