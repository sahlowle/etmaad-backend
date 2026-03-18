<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tenders', function (Blueprint $table) {
            $table->id()->comment('المعرف الفريد');
            $table->string('name')->comment('Tab 1, Input 1: اسم المنافسة');
            $table->string('tender_number')->comment('Tab 1, Input 2: رقم المنافسة');
            $table->string('reference_number')->nullable()->comment('Tab 1, Input 3: الرقم المرجعي');
            $table->text('purpose')->comment('Tab 1, Input 4: الغرض من المنافسة');
            $table->decimal('booklet_price', 10, 2)->nullable()->comment('Tab 1, Input 5: قيمة الكراسة بالجنيه');
            $table->string('status')->comment('Tab 1, Input 6: حالة المنافسة');
            $table->string('execution_duration')->nullable()->comment('Tab 1, Input 7: مدة التنفيذ');
            $table->boolean('requires_insurance')->comment('Tab 1, Input 8: هل التأمين من متطلبات المنافسة');
            $table->string('type')->comment('Tab 1, Input 9: نوع المنافسة');
            $table->string('tendering_status')->comment('Tab 1, Input 10: حالة الطرح');
            $table->string('government_entity')->nullable()->comment('Tab 1, Input 11: الجهة الحكومية');
            $table->string('submission_method')->comment('Tab 1, Input 13: طريقة تقديم العروض');
            $table->boolean('requires_initial_guarantee')->comment('Tab 1, Input 14: مطلوب ضمان ابتدائي');
            $table->string('initial_guarantee_address')->nullable()->comment('Tab 1, Input 15: عنوان الضمان الابتدائي');
            $table->string('final_guarantee_percentage')->nullable()->comment('Tab 1, Input 16: الضمان النهائي');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tenders');
    }
};
