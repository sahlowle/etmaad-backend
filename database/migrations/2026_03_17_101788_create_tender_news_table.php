<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tender_news', function (Blueprint $table) {
            $table->id()->comment('المعرف الفريد');
            $table->foreignId('tender_id')->constrained('tenders')->onDelete('cascade')->comment('معرف المنافسة');
            
            $table->date('creation_date')->nullable()->comment('Tab 6, Input 1: تاريخ الإنشاء');
            $table->dateTime('updated_offers_opening_date')->nullable()->comment('Tab 6, Input 2: تاريخ فتح العروض (محدث)');
            $table->text('extension_notes')->nullable()->comment('Tab 6, Input 3: تمديد تواريخ المنافسة (إن وجد)');
            $table->date('actual_award_date')->nullable()->comment('Tab 6, Input 4: تاريخ الترسية (الفعلي)');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tender_news');
    }
};