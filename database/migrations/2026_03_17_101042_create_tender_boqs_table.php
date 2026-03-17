<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tender_boqs', function (Blueprint $table) {
            $table->id()->comment('المعرف الفريد');
            $table->foreignId('tender_id')->constrained('tenders')->onDelete('cascade')->comment('معرف المنافسة');

            $table->string('table_name')->nullable()->comment('Tab 4, Input 1: اسم الجدول');
            $table->integer('serial_number')->comment('Tab 4, Input 2: الرقم التسلسلي');
            $table->string('category')->comment('Tab 4, Input 3: الفئة');
            $table->string('item_name')->comment('Tab 4, Input 4: البند');
            $table->string('unit')->comment('Tab 4, Input 5: وحدة القياس');
            $table->decimal('quantity', 10, 2)->comment('Tab 4, Input 6: الكمية');
            $table->text('description')->nullable()->comment('Tab 4, Input 7: وصف البند');
            $table->text('specifications')->nullable()->comment('Tab 4, Input 8: المواصفات');
            $table->boolean('is_mandatory_list_product')->default(false)->comment('Tab 4, Input 9: منتج من القائمة الإلزامية');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tender_boqs');
    }
};
