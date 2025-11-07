<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Tambahkan kolom timestamps
            // Karena created_at mungkin juga hilang, tambahkan dulu jika perlu
            if (!Schema::hasColumn('orders', 'created_at')) {
                $table->timestamp('created_at')->nullable(); // Atau gunakan useCurrent() jika ingin nilai default sekarang
            }
            if (!Schema::hasColumn('orders', 'updated_at')) {
                $table->timestamp('updated_at')->nullable(); // Atau gunakan useCurrent() jika ingin nilai default sekarang
            }
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Hanya hapus jika kolom benar-benar ada untuk mencegah error
            if (Schema::hasColumn('orders', 'updated_at')) {
                $table->dropColumn('updated_at');
            }
            if (Schema::hasColumn('orders', 'created_at')) {
                $table->dropColumn('created_at');
            }
        });
    }
};