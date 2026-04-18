<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('ex_employees', function (Blueprint $table) {
            $table->id();
            if (config('default.dual_language')) {
                $table->string('name_en');
                $table->string('level_en')->nullable();
                $table->string('address_en')->nullable();
            }
            $table->string('name');
            $table->string('photo')->nullable();
            $table->string('department')->nullable();
            $table->string('department_en')->nullable();
            $table->string('designation')->nullable();
            $table->string('designation_en')->nullable();
            $table->string('level')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('joining_date')->nullable();
            $table->string('leaving_date')->nullable();
            $table->boolean('is_chief')->default(0);
            $table->boolean('status')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ex_employees');
    }
};
