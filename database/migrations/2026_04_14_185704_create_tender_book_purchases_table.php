<?php

use App\Enums\PaymentMethodEnum;
use App\Enums\PaymentStatusEnum;
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
        Schema::create('tender_book_purchases', function (Blueprint $table) {
            $table->id();
            $table->string('serial_number')->unique();
            $table->foreignId('tender_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('company_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('tender_title');
            $table->string('company_name');
            $table->string('company_commercial_registration_number');
            $table->decimal('amount', 10, 2);
            $table->string('payment_status')->default(PaymentStatusEnum::PENDING->value)->comment(implode(',', PaymentStatusEnum::values()));
            $table->string('payment_method')->comment(implode(',', PaymentMethodEnum::values()));
            $table->string('payment_id')->nullable()->unique();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tender_book_purchases');
    }
};
