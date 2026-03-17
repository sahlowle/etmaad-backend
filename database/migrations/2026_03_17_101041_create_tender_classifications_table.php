<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tender_classifications', function (Blueprint $table) {
            $table->id()->comment('المعرف الفريد');
            $table->foreignId('tender_id')->constrained('tenders')->onDelete('cascade')->comment('معرف المنافسة');
            
            $table->string('classification_area')->nullable()->comment('Tab 3, Input 1: مجال التصنيف');
            $table->string('execution_location')->nullable()->comment('Tab 3, Input 2: مكان التنفيذ');
            $table->text('details')->nullable()->comment('Tab 3, Input 3: التفاصيل');
            $table->string('scope')->nullable()->comment('Tab 3, Input 4: نطاق المنافسة');
            $table->boolean('includes_supply')->nullable()->comment('Tab 3, Input 5: يشمل المنافسة على بنود توريد');
            $table->boolean('includes_maintenance')->nullable()->comment('Tab 3, Input 6: أعمال الصيانة والتشغيل');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tender_classifications');
    }
};