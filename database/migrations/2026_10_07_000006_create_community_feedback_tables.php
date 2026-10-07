<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('community_posts')) {
            Schema::create('community_posts', function (Blueprint $table): void {
                $table->bigIncrements('id');
                // No foreign key: production user id types vary across existing installs.
                $table->integer('user_id')->index();
                $table->string('title', 180);
                $table->text('body');
                $table->string('status', 20)->default('published')->index();
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('community_comments')) {
            Schema::create('community_comments', function (Blueprint $table): void {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('post_id')->index();
                $table->integer('user_id')->index();
                $table->text('body');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('community_comments');
        Schema::dropIfExists('community_posts');
    }
};
