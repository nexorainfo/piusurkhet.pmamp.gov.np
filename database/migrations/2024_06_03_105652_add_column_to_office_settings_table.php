<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('office_settings', function (Blueprint $table) {
            $table->foreignId('grivance_officer_id')->nullable()->constrained('employees')->nullOnDelete()->onUpdate('no action');
        });
    }

    public function down()
    {
        Schema::table('office_settings', function (Blueprint $table) {
            $table->dropColumn('grivance_officer_id');
        });
    }
};
