<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tender_evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tender_id')->constrained('tenders');

            $table->string('tech_level_1_name')->nullable();
            $table->integer('tech_level_1_percentage')->nullable();
            $table->string('tech_level_2_name')->nullable();
            $table->integer('tech_level_2_percentage')->nullable();
            $table->string('tech_level_3_name')->nullable();
            $table->integer('tech_level_3_percentage')->nullable();
            $table->integer('technical_weight')->default(70);
            $table->integer('technical_percentage_success');

            $table->string('fin_level_1_name')->nullable();
            $table->integer('fin_level_1_percentage')->nullable();
            $table->string('fin_level_2_name')->nullable();
            $table->integer('fin_level_2_percentage')->nullable();
            $table->string('fin_level_3_name')->nullable();
            $table->integer('fin_level_3_percentage')->nullable();
            $table->integer('financial_weight')->default(30);
            $table->integer('financial_percentage_success');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tender_evaluations');
    }
};
