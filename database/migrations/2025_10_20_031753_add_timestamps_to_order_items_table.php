<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('order_items', function (Blueprint $table) {
            // Tambahkan kolom timestamps jika belum ada
            if (!Schema::hasColumn('order_items', 'created_at')) {
                $table->timestamp('created_at')->nullable();
            }
            if (!Schema::hasColumn('order_items', 'updated_at')) {
                $table->timestamp('updated_at')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('order_items', function (Blueprint $table) {
            // Hapus kolom jika ada
            if (Schema::hasColumn('order_items', 'updated_at')) {
                $table->dropColumn('updated_at');
            }
            if (Schema::hasColumn('order_items', 'created_at')) {
                $table->dropColumn('created_at');
            }
        });
    }
};