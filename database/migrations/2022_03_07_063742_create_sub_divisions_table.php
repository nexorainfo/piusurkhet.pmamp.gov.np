<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (config('default.subDivision')) {
            Schema::create('sub_divisions', function (Blueprint $table) {
                $table->id();
                if (config('default.dual_language')) {
                    $table->string('title_en');
                    $table->mediumText('introduction_en')->nullable();
                }
                $table->string('title');
                $table->string('email');
                $table->string('phone');
                $table->string('slug');
                $table->mediumText('introduction')->nullable();
                $table->text('map')->nullable();
                $table->text('facebook')->nullable();
                $table->softDeletes();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (config('default.subDivision')) {
            Schema::dropIfExists('sub_divisions');
        }
    }
};
