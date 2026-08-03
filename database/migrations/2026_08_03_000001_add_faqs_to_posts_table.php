<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::defaultStringLength(191);

        Schema::table('posts', function (Blueprint $table) {
            // [{ "question": "...", "answer": "..." }, ...] rendered on the post
            // and emitted as FAQPage schema. text, not json, to match how
            // leads.services_interested stores its array on this MySQL server.
            $table->text('faqs')->nullable()->after('body');
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('faqs');
        });
    }
};
