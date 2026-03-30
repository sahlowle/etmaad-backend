<?php

use App\Models\Activity;
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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->timestamps();
        });

        Schema::create('activity_company', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activity_id')->constrained()->cascadeOnDelete();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });

        $this->insertData();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_company');
        Schema::dropIfExists('activities');
    }

    private function insertData()
    {
        $activities = [
            ['ar' => 'تقنية المعلومات والبرمجيات', 'en' => 'Information Technology & Software'],
            ['ar' => 'البنية التحتية والشبكات', 'en' => 'Infrastructure & Networks'],
            ['ar' => 'الأمن السيبراني', 'en' => 'Cybersecurity'],
            ['ar' => 'الحوسبة السحابية', 'en' => 'Cloud Computing'],
            ['ar' => 'البناء والمقاولات', 'en' => 'Construction & Contracting'],
            ['ar' => 'الرعاية الصحية والطبية', 'en' => 'Healthcare & Medical'],
            ['ar' => 'توريد المعدات والأجهزة', 'en' => 'Equipment & Devices Supply'],
            ['ar' => 'الخدمات الاستشارية', 'en' => 'Consulting Services'],
            ['ar' => 'التعليم والتدريب', 'en' => 'Education & Training'],
            ['ar' => 'النقل والخدمات اللوجستية', 'en' => 'Transport & Logistics'],
            ['ar' => 'الطاقة والبيئة', 'en' => 'Energy & Environment'],
            ['ar' => 'المواد الغذائية والزراعة', 'en' => 'Food & Agriculture'],
        ];

        foreach ($activities as $activity) {
            Activity::create([
                'name' => [
                    'ar' => $activity['ar'],
                    'en' => $activity['en'],
                ],
            ]);
        }
    }
};
