<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('galleries', function (Blueprint $table) {
            $table->string('category')->default('alam')->after('image_url');
            $table->text('description')->nullable()->after('category');
            $table->string('location')->nullable()->after('description');
            $table->boolean('homepage')->default(false)->after('location');
            $table->string('tags')->nullable()->after('homepage');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('galleries', function (Blueprint $table) {
            $table->dropColumn(['category', 'description', 'location', 'homepage', 'tags']);
        });
    }
};
