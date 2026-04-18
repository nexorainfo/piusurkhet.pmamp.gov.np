<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->string('budget_no');
            $table->string('expense_head')->nullable();
            $table->string('buying_process')->nullable();
            $table->string('pan_no')->nullable();
            $table->string('bill_photo')->nullable();
            $table->string('bill_date');
            $table->double('amount',10,2);
            $table->string('receipt_date');
            if(config('default.dual_language'))
            {
                $table->string('expense_head_en')->nullable();
                $table->string('buying_process_en')->nullable();
                $table->text('description_en')->nullable();
                $table->string('remarks_en')->nullable();
            }
            $table->text('description')->nullable();
            $table->string('remarks')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bills');
    }
};
