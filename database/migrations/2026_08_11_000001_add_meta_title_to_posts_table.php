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
            // The <title> a post wants in search results is not always the
            // headline it wants on the page. A headline can be short and
            // provocative while the title tag still has to say what the page
            // is about and carry the term people search for.
            //
            // Nullable, and blog-show falls back to the headline, so every
            // existing post keeps exactly the title it has today.
            $table->string('meta_title')->nullable()->after('title');
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('meta_title');
        });
    }
};
