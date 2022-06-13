<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('zoom_accounts', function(Blueprint $table) {
            $table->foreignId('zoom_app_id')
                ->after('email')
                ->constrained()
                ->onDelete('cascade');

            $table->enum('status', [
                'waiting',
                'connected'
            ])->after('zoom_app_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('zoom_accounts', function(Blueprint $table) {
            $table->dropConstrainedForeignId('zoom_app_id');
            $table->dropColumn('status');
        });
    }
};
