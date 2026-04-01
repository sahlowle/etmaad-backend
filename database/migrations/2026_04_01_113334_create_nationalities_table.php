<?php

use App\Models\Nationality;
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
        Schema::create('nationalities', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->timestamps();
        });

        $this->insertData();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nationalities');
    }

    public function insertData()
    {
        $data = [
            ['name' => ['ar' => 'مصري', 'en' => 'Egyptian']],
            ['name' => ['ar' => 'سعودي', 'en' => 'Saudi']],
            ['name' => ['ar' => 'إماراتي', 'en' => 'Emirati']],
            ['name' => ['ar' => 'قطري', 'en' => 'Qatari']],
            ['name' => ['ar' => 'كويتي', 'en' => 'Kuwaiti']],
            ['name' => ['ar' => 'بحريني', 'en' => 'Bahraini']],
            ['name' => ['ar' => 'عماني', 'en' => 'Omani']],
            ['name' => ['ar' => 'يمني', 'en' => 'Yemeni']],
            ['name' => ['ar' => 'عراقي', 'en' => 'Iraqi']],
            ['name' => ['ar' => 'سوري', 'en' => 'Syrian']],
            ['name' => ['ar' => 'لبناني', 'en' => 'Lebanese']],
            ['name' => ['ar' => 'فلسطيني', 'en' => 'Palestinian']],
            ['name' => ['ar' => 'أردني', 'en' => 'Jordanian']],
            ['name' => ['ar' => 'جزائري', 'en' => 'Algerian']],
            ['name' => ['ar' => 'مغربي', 'en' => 'Moroccan']],
            ['name' => ['ar' => 'تونسي', 'en' => 'Tunisian']],
            ['name' => ['ar' => 'ليبي', 'en' => 'Libyan']],
            ['name' => ['ar' => 'سوداني', 'en' => 'Sudanese']],
            ['name' => ['ar' => 'صومالي', 'en' => 'Somali']],
            ['name' => ['ar' => 'جيبوتي', 'en' => 'Djiboutian']],
            ['name' => ['ar' => 'موريتاني', 'en' => 'Mauritanian']],
            ['name' => ['ar' => 'صومالي', 'en' => 'Somali']],
            ['name' => ['ar' => 'جيبوتي', 'en' => 'Djiboutian']],
            ['name' => ['ar' => 'موريتاني', 'en' => 'Mauritanian']],
        ];

        foreach ($data as $item) {
            Nationality::create($item);
        }
    }
};
