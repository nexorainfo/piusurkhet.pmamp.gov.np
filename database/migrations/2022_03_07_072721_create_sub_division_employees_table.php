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
            Schema::create('sub_division_employees', function (Blueprint $table) {
                $table->id();
                $table->foreignId('sub_division_id')->constrained()->cascadeOnDelete();
                if (config('default.dual_language')) {
                    $table->string('name_en');
                    $table->string('department_en')->nullable();
                    $table->string('designation_en')->nullable();
                    $table->string('level_en')->nullable();
                    $table->string('address_en')->nullable();
                }
                $table->string('name');
                $table->string('photo')->nullable();
                $table->string('department')->nullable();
                $table->string('designation')->nullable();
                $table->string('level')->nullable();
                $table->string('phone')->nullable();
                $table->string('email')->nullable();
                $table->string('address')->nullable();
                $table->integer('position');
                $table->boolean('status')->default(1);
                $table->boolean('is_chief')->default(0);
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
            Schema::dropIfExists('sub_division_employees');
        }
    }
};
