<?php

use App\Enums\TenderBidGuaranteeTypeEnum;
use App\Enums\TenderBidStatusesEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tender_bids', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tender_id');
            $table->bigInteger('company_id');

            $table->string('reference_number')->unique();

            $table->string('technical_envelope_file_path')->nullable();

            // ── الضمان الابتدائي ─────────────────────────────────────
            $table->string('guarantee_type')->default(TenderBidGuaranteeTypeEnum::BANK_LETTER->value)->nullable();   // bank_letter | cheque | cash
            $table->string('guarantee_number')->nullable();
            $table->string('guarantee_bank')->nullable();
            $table->decimal('guarantee_amount', 14, 2)->nullable();
            $table->date('guarantee_expiry')->nullable();
            $table->string('guarantee_file_path')->nullable();   // مسار الملف المرفوع

            $table->timestamp('submitted_at')->nullable();
            $table->text('rejection_reason')->nullable();

            $table->string('status')->default(TenderBidStatusesEnum::UNDER_REVIEW->value);

            $table->boolean('is_technical_evaluation_added')->default(false);
            $table->boolean('is_financial_evaluation_added')->default(false);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tender_bids');
    }
};
