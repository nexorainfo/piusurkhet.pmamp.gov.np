<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('office_settings', function (Blueprint $table) {
            $table->enum('document_list_type', ['card', 'list'])->default('card')->after('twitter_iframe');
        });
    }

    public function down()
    {
        Schema::table('office_settings', function (Blueprint $table) {
            $table->dropColumn('document_list_type');
        });
    }
};
