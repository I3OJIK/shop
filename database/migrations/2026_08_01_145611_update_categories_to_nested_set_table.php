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
        Schema::table('nested_set', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropColumn('parent_id');

            $table->nestedSet();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nested_set', function (Blueprint $table) {
            $table->dropNestedSet();

            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('categories')
                ->restrictOnDelete();
        });
    }
};
