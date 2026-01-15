<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('pendaftarans', function (Blueprint $table) {

            if (!Schema::hasColumn('pendaftarans', 'pangkat_ibu')) {
                $table->string('pangkat_ibu')->nullable();
            }

            if (!Schema::hasColumn('pendaftarans', 'golongan_darah_ibu')) {
                $table->string('golongan_darah_ibu', 5)
                    ->nullable()
                    ->after('pangkat_ibu');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->dropColumn([
                'golongan_darah_ibu',
                'pangkat_ibu'
            ]);
        });
    }
};
