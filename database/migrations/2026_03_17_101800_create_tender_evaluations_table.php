<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tender_evaluations', function (Blueprint $table) {
            $table->id()->comment('المعرف الفريد');
            $table->foreignId('tender_id')->constrained('tenders')->onDelete('cascade')->comment('معرف المنافسة');

            $table->string('tech_level_1')->nullable()->comment('Tab 7, Input 1: المستوى الأول الفني');
            $table->string('tech_level_2')->nullable()->comment('Tab 7, Input 2: المستوى الثاني الفني');
            $table->string('tech_level_3')->nullable()->comment('Tab 7, Input 3: المستوى الثالث الفني');
            $table->integer('technical_weight')->default(70)->comment('Tab 7, Input 4: الوزن النوعي الفني (%)');

            $table->string('fin_level_1')->nullable()->comment('Tab 7, Input 5: المستوى الأول المالي');
            $table->string('fin_level_2')->nullable()->comment('Tab 7, Input 6: المستوى الثاني المالي');
            $table->string('fin_level_3')->nullable()->comment('Tab 7, Input 7: المستوى الثالث المالي');
            $table->integer('financial_weight')->default(30)->comment('Tab 7, Input 8: الوزن النوعي المالي (%)');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tender_evaluations');
    }
};
