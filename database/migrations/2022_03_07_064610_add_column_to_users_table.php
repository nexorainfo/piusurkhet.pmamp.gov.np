<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        if (config('default.subDivision')) {
            Schema::table('users', function (Blueprint $table) {
                $table->foreignId('sub_division_id')->nullable()->constrained()->cascadeOnDelete();
            });
        }
    }


    public function down()
    {
        if (config('default.subDivision')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropConstrainedForeignId('sub_division_id');
            });
        }
    }
};
