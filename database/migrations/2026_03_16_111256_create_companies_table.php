<?php

use App\Enums\CompanyStatusesEnum;
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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();

            // Step 1: بيانات الشركة الأساسية
            $table->string('commercial_name'); // الاسم التجاري الرسمي للشركة
            $table->string('commercial_registration_number')->unique(); // رقم السجل التجاري
            $table->tinyInteger('commercial_registration_number_verified')->default(0);
            $table->string('tax_number')->unique(); // الرقم الضريبي
            $table->date('establishment_date'); // تاريخ التأسيس
            $table->bigInteger('company_type_id')->nullable(); // نوع الشركة (مثال: شركة ذات مسؤولية محدودة)
            $table->string('company_size'); // حجم الشركة (عدد الموظفين)
            $table->string('legal_representative_name'); // اسم المسؤول القانوني / الممثل الرسمي
            $table->string('representative_national_id'); // الرقم القومي للمسؤول
            $table->string('representative_nationality'); // الجنسية

            // Step 2: بيانات الاتصال والموقع
            $table->string('primary_phone'); // رقم الهاتف الرئيسي
            $table->string('secondary_phone')->nullable(); // رقم الهاتف الثانوي
            $table->string('official_email')->unique(); // البريد الإلكتروني الرسمي
            $table->string('website')->nullable(); // الموقع الإلكتروني
            $table->bigInteger('governorate_id')->nullable(); // المحافظة
            $table->bigInteger('city_id')->nullable(); // المدينة / الحي
            $table->text('address'); // العنوان التفصيلي
            $table->string('postal_code')->nullable(); // الرمز البريدي

            // Step 4: التخصصات والنشاط التجاري
            $table->decimal('paid_capital', 15, 2)->nullable(); // رأس المال المدفوع (ج.م)
            $table->decimal('annual_sales', 15, 2)->nullable(); // متوسط المبيعات السنوية (ج.م)
            $table->text('company_brief')->nullable(); // نبذة مختصرة عن الشركة

            $table->string('status')->default(CompanyStatusesEnum::PENDING->value);

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('company_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->tinyInteger('is_manager')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
        Schema::dropIfExists('company_user');
    }
};
