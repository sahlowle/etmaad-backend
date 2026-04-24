<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('bid_evaluations');
        Schema::create('bid_evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tender_bid_id')->constrained('tender_bids');
            $table->foreignId('tender_id')->constrained('tenders');
            $table->foreignId('company_id')->constrained('companies');
            $table->foreignId('evaluated_by')->constrained('users');

            // Technical scores (mapped to tender_evaluations tech levels)
            $table->integer('tech_level_1_score')->nullable();
            $table->integer('tech_level_2_score')->nullable();
            $table->integer('tech_level_3_score')->nullable();
            $table->integer('technical_percentage_success')->nullable();
            $table->decimal('technical_total_score', 5, 2)->nullable();

            // Financial scores (mapped to tender_evaluations fin levels)
            $table->integer('fin_level_1_score')->nullable();
            $table->integer('fin_level_2_score')->nullable();
            $table->integer('fin_level_3_score')->nullable();
            $table->integer('financial_percentage_success')->nullable();
            $table->decimal('financial_total_score', 5, 2)->nullable();

            // Final weighted score
            $table->decimal('final_score', 5, 2)->nullable();

            $table->text('notes')->nullable();
            $table->timestamp('evaluated_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bid_evaluations');
    }
};
