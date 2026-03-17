<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tender_addresses_dates', function (Blueprint $table) {
            $table->id()->comment('المعرف الفريد');
            $table->foreignId('tender_id')->constrained('tenders')->onDelete('cascade')->comment('معرف المنافسة');

            $table->dateTime('inquiries_deadline')->comment('Tab 2, Input 1: آخر موعد لاستلام الاستفسارات');
            $table->dateTime('offers_deadline')->comment('Tab 2, Input 2: آخر موعد لتقديم العروض');
            $table->dateTime('offers_opening_date')->comment('Tab 2, Input 3: تاريخ فتح العروض');
            $table->dateTime('offers_examination_date')->nullable()->comment('Tab 2, Input 4: تاريخ فحص العروض');
            $table->integer('evaluation_duration_days')->nullable()->comment('Tab 2, Input 5: مدة التقييم بالأيام');
            $table->date('expected_award_date')->nullable()->comment('Tab 2, Input 6: التاريخ المتوقع للترسية');
            $table->date('execution_start_date')->nullable()->comment('Tab 2, Input 7: تاريخ بدء الأعمال / الخدمات');
            $table->dateTime('qa_start_date')->nullable()->comment('Tab 2, Input 8: بداية إرسال الأسئلة والاستفسارات');
            $table->dateTime('qa_response_deadline')->nullable()->comment('Tab 2, Input 9: الحد الأقصى للرد على الاستفسارات');
            $table->string('offers_opening_location')->nullable()->comment('Tab 2, Input 10: مكان فتح العروض');
            $table->text('opening_committee_members')->nullable()->comment('Tab 2, Input 11: لجنة الفتح');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tender_addresses_dates');
    }
};
