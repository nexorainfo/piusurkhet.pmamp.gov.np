<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('office_setting_headers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('office_setting_id')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');
            $table->string('english');
            $table->string('nepali');
            $table->string('font_color')->nullable();
            $table->string('font_size');
            $table->string('font_family');
            $table->integer('position');
            $table->string('font');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('office_setting_headers');
    }
};
