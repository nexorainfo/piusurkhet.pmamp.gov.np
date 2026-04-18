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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('main_document_category_id')->nullable()->constrained('document_categories')->nullOnDelete()->onUpdate('no action');
            $table->foreignId('document_category_id')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');
            $table->string('title');
            $table->string('slug');
            if (config('default.dual_language')) {
                $table->string('title_en');
                $table->longText('description_en')->nullable();
                $table->string('publisher_en')->nullable();
            }
            $table->string('published_date')->nullable();
            $table->boolean('status')->default(1);
            $table->boolean('popUp')->default(0);
            $table->longText('description')->nullable();
            $table->string('publisher')->nullable();
            $table->boolean('mark_as_new')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
};
