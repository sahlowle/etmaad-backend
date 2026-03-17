<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tender_attachments', function (Blueprint $table) {
            $table->id()->comment('المعرف الفريد');
            $table->foreignId('tender_id')->constrained('tenders')->onDelete('cascade')->comment('معرف المنافسة');

            $table->string('file_path')->comment('Tab 5, Input 1: مسار الملف');
            $table->string('file_name')->comment('Tab 5, Input 1: اسم الملف الأصلي');
            $table->string('file_type')->nullable()->comment('Tab 5, Input 1: نوع الملف');
            $table->integer('file_size')->nullable()->comment('Tab 5, Input 1: حجم الملف');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tender_attachments');
    }
};
