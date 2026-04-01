<?php

use App\Models\CompanyType;
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
        Schema::create('company_types', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->string('slug', 191)->nullable()->unique();
            $table->timestamps();
        });

        $this->insertData();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_types');
    }

    public function insertData()
    {
        $data = [

            [
                'name' => ['ar' => 'مؤسسة فردية', 'en' => 'Sole proprietorship'],
                'slug' => 'sole-proprietorship',
            ],
            [
                'name' => ['ar' => 'شركة تضامن', 'en' => 'General partnership'],
                'slug' => 'general-partnership',
            ],
            [
                'name' => ['ar' => 'شركة توصية بسيطة', 'en' => 'Limited partnership'],
                'slug' => 'limited-partnership',
            ],
            [
                'name' => ['ar' => 'شركة ذات مسؤولية محدودة', 'en' => 'Limited liability company'],
                'slug' => 'limited-liability-company',
            ],
            [
                'name' => ['ar' => 'شركة مساهمة', 'en' => 'Joint-stock company'],
                'slug' => 'joint-stock-company',
            ],
            [
                'name' => ['ar' => 'شركة مساهمة مبسطة', 'en' => 'Simplified joint-stock company'],
                'slug' => 'simplified-joint-stock-company',
            ],
            [
                'name' => ['ar' => 'شركة توصية بالأسهم', 'en' => 'Partnership limited by shares'],
                'slug' => 'partnership-limited-by-shares',
            ],
            [
                'name' => ['ar' => 'شركة تعاونية', 'en' => 'Cooperative company'],
                'slug' => 'cooperative-company',
            ],
            [
                'name' => ['ar' => 'شركة مهنية', 'en' => 'Professional company'],
                'slug' => 'professional-company',
            ],
            [
                'name' => ['ar' => 'شركة قابضة', 'en' => 'Holding company'],
                'slug' => 'holding-company',
            ],
        ];

        foreach ($data as $item) {
            CompanyType::create($item);
        }
    }
};
