<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;

    protected $fillable = [
        // Step 1
        'commercial_name', // الاسم التجاري الرسمي
        'commercial_registration_number', // رقم السجل التجاري
        'commercial_registration_number_verified', // التحقق من السجل
        'tax_number', // الرقم الضريبي
        'establishment_date', // تاريخ التأسيس
        'company_type_id', // نوع الشركة
        'company_size', // حجم الشركة
        'legal_representative_name', // اسم المسؤول القانوني
        'representative_national_id', // الرقم القومي للمسؤول
        'representative_nationality', // الجنسية

        // Step 2
        'primary_phone', // رقم الهاتف الرئيسي
        'secondary_phone', // رقم الهاتف الثانوي
        'official_email', // البريد الإلكتروني الرسمي
        'website', // الموقع الإلكتروني
        'governorate_id', // المحافظة
        'city_id', // المدينة
        'address', // العنوان التفصيلي
        'postal_code', // الرمز البريدي

        // Step 4
        'paid_capital', // رأس المال المدفوع
        'annual_sales', // متوسط المبيعات السنوية
        'company_brief', // نبذة مختصرة
    ];

    public function documents(): HasMany
    {
        return $this->hasMany(CompanyDocument::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(CompanyType::class, 'company_type_id')->withDefault([
            'name' => api_trans('not_defined'),
        ]);
    }

    public function governorate(): BelongsTo
    {
        return $this->belongsTo(Governorate::class, 'governorate_id')->withDefault([
            'name' => api_trans('not_defined'),
        ]);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id')->withDefault([
            'name' => api_trans('not_defined'),
        ]);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot('created_at')
            ->orderByPivot('created_at', 'asc');
    }

    public function firstUser(): ?User
    {
        return $this->users()->first();
    }

    public function activities(): BelongsToMany
    {
        return $this->belongsToMany(Activity::class);
    }
}
